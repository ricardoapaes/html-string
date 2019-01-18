<?php

/**
 * @author Ricardo Paes
 * @since 18/01/2019 às 15:56
 */

namespace Like\Util\HtmlString\Tests;

use Like\Util\HtmlString;
use PHPUnit_Framework_TestCase;

class StrPadTest extends PHPUnit_Framework_TestCase {

	public function testLeft() {
		$string = "LIKE SISTEMAS";
		$this->assertEquals("        {$string}", str_pad($string,21," ",STR_PAD_LEFT));
		$this->assertEquals("        {$string}", HtmlString::get($string)->str_pad(21," ",STR_PAD_LEFT));
		$this->assertEquals("        <b>{$string}</b>", HtmlString::get("<b>$string</b>")->str_pad(21," ",STR_PAD_LEFT));
	}

	public function testBoth() {
		$string = "LIKE SISTEMAS";
		$this->assertEquals("    {$string}    ", str_pad($string,21," ", STR_PAD_BOTH));
		$this->assertEquals("    {$string}    ", HtmlString::get($string)->str_pad(21," ", STR_PAD_BOTH));
		$this->assertEquals("    <b>{$string}</b>    ", HtmlString::get("<b>$string</b>")->str_pad(21," ", STR_PAD_BOTH));
	}

	public function testRight() {
		$string = "LIKE SISTEMAS";
		$this->assertEquals("{$string}        ", str_pad($string,21," ",STR_PAD_RIGHT));
		$this->assertEquals("{$string}        ", HtmlString::get($string)->str_pad(21," ",STR_PAD_RIGHT));
		$this->assertEquals("<b>{$string}</b>        ", HtmlString::get("<b>$string</b>")->str_pad(21," ",STR_PAD_RIGHT));
	}

}
