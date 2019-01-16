<?php

/**
 * @author Ricardo Paes
 * @since 14/01/2019 às 18:14
 */

namespace Like\Util;

class HtmlString {

	/**
	 * @var string
	 */
	private $string;

	/**
	 * @param string $string
	 */
	private function __construct($string) { $this->string = $string; }

	public function clear() {
		return preg_replace('/<.*?>/', '', $this->string);
	}

	public function strlen() {
		return strlen($this->clear());
	}

	/**
	 * @param int $width
	 * @param string $break
	 * @param bool $exact
	 * @return string
	 */
	public function wordwrap($width, $break="\n", $exact=true) {
		return join($break, $this->wordwrapArray($width, $exact));
	}

	/**
	 * @param int $width
	 * @param bool $exact
	 * @return array
	 */
	public function wordwrapArray($width, $exact=true) {
		$linhas = [];

		$nrLinhas = ceil($this->strlen() / $width);
		$range = range(0, $nrLinhas-1);
		$diff = 0;

		foreach($range as $linha) {
			$start = $linha > 0 ? ($linha * $width) : 0;
			if($diff > 0) {
				$start -= $diff;
			}

			$linhas[] = $this->substr($start, $width, $exact,$diff);
		}

		return $linhas;
	}

	/**
	 * @param int $start
	 * @param int $length
	 * @param bool $exact
	 * @param int $diffLength
	 * @return string
	 */
	public function substr($start, $length, $exact=true, &$diffLength=null) {
		if(!$exact) {
			$clean_text = $this->clear();
			$clean_text_exact = substr($clean_text,$start,$length);
			$clean_text_wrapped = explode("\n", wordwrap(substr($clean_text,$start), $length, "\n"))[0];

			if( strlen($clean_text_exact) > strlen($clean_text_wrapped) ) {
				$diffLength = strlen($clean_text_exact) - strlen($clean_text_wrapped);
				$length = $length - $diffLength;

				$strDiff = substr($clean_text,$start+$length, $diffLength);
				$strDiffNoSpaces = str_replace(" ","", $strDiff);

				if(strlen($strDiff) > strlen($strDiffNoSpaces)) {
					$diffLength -= strlen($strDiff) - strlen($strDiffNoSpaces);
				}
			} else {
				$diffLength = 0;
			}
		}

		// if the plain text is shorter than the maximum length, return the whole text
		if ($this->strlen() <= $length) {
			return $this->string;
		}
		// splits all html-tags to scanable lines
		preg_match_all('/(<.+?>)?([^<>]*)/s', $this->string, $lines, PREG_SET_ORDER);
		$length += $start;
		$total_length = 0;
		$start_length = 0;
		$open_tags = array();
		$closed_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			// if there is any html-tag in this line, handle it and add it (uncounted) to the output
			if (!empty($line_matchings[1]) && $total_length >= $start ) {
				// if it's an "empty element" with or without xhtml-conform closing slash
				if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					// delete tag from $open_tags list
					$pos = array_search($tag_matchings[1], $open_tags);
					if ($pos !== false) {
						unset($open_tags[$pos]);
					} else {
						$closed_tags[] = $tag_matchings[1];
					}
					// if tag is an opening tag
				} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					// add tag to the beginning of $open_tags list
					array_unshift($open_tags, strtolower($tag_matchings[1]));
				}
				// add html-tag to $truncate'd text
				$truncate .= $line_matchings[1];
			}
			// calculate the length of the plain text part of the line; handle entities as one character
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			$content_available = $total_length+$content_length;
			if($content_available < $start) {
				$content_available = $content_available - $start;
			}

			if($content_available > $length) {
				// the number of characters which are left
				$leftStart = $total_length > $start ? 0 : $start-$total_length;
				$left = ($length-$start) - $start_length;
				$entities_length = 0;
				// search for html entities
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					// calculate the real length of all entities in the legal range
					foreach ($entities[0] as $entity) {
						if ($entity[1]+1-$entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							// no more characters left
							break;
						}
					}
				}
				$truncate .= substr($line_matchings[2], $leftStart,$left+$entities_length);
				// maximum lenght is reached, so get off the loop
				break;
			} else {
				if($total_length+$content_length >= $start) {
					$line_available = $line_matchings[2];
					if($total_length < $start) {
						$line_available = substr($line_available,$start - $total_length);
					}

					if($line_available) {
						$truncate .= $line_available;
						$start_length += strlen($line_available);
					}
				}

				$total_length += $content_length;
			}
			// if the maximum length is reached, get off the loop
			if($start_length>= $length) {
				break;
			}
		}

		// open all closed html-tags
		foreach($closed_tags as $tag) {
			$truncate = '<' . $tag . '>' . $truncate;
		}

		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
			$truncate .= '</' . $tag . '>';
		}

		return $truncate;
	}

	public static function get($string) {
		return new self($string);
	}

}