<?php

/**
 * @author Ricardo Paes
 * @since 16/01/2019 às 15:50
 */

namespace Like\Util\HtmlString\Tests;

use Like\Util\HtmlString;

class WordwrapTest extends \PHPUnit_Framework_TestCase {

	public function testWordwrap1() {
		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(48,true);
		$this->assertEquals(2, count($wordWrapArray));
		$this->assertEquals(["<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CATUPIRY</e> -- CALABRESA -- B</h></d></b>","<b><d><h>orda</h> CHOCOLATE PRETO NO BRANCO R$ 8,90</d></b>"], $wordWrapArray);

		$this->assertEquals("<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CATUPIRY</e> -- CALABRESA -- B</h></d></b>\n<b><d><h>orda</h> CHOCOLATE PRETO NO BRANCO R$ 8,90</d></b>", HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrap(48,"\n",true));
	}

	public function testWordwrap2() {
		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(24,true);
		$this->assertEquals(4, count($wordWrapArray));
		$this->assertEquals([
			"<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CA</e></h></d></b>",
			"<b><d><h><e>TUPIRY</e> -- CALABRESA -- B</h></d></b>",
			"<b><d><h>orda</h> CHOCOLATE PRETO NO </d></b>",
			"<b><d>BRANCO R$ 8,90</d></b>"
		], $wordWrapArray);
	}

	public function testWordwrap3() {
		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(10,true);
		$this->assertEquals(9, count($wordWrapArray));
		$this->assertEquals([
			"<b><d>Pizza <h>Metr</h></d></b>",
			"<b><d><h>o -- <b>FRANG</b></h></d></b>",
			"<b><d><h><b>O</b> <e>CATUPIRY</e></h></d></b>",
			"<b><d><h> -- CALABR</h></d></b>",
			"<b><d><h>ESA -- Bor</h></d></b>",
			"<b><d><h>da</h> CHOCOLA</d></b>",
			"<b><d>TE PRETO N</d></b>",
			"<b><d>O BRANCO R</d></b>",
			"<b><d>$ 8,90</d></b>"
		], $wordWrapArray);
	}

	public function testWordwrap4() {
		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(255,true);
		$this->assertEquals(1, count($wordWrapArray));
		$this->assertEquals([HtmlStringTest::EXEMPLO], $wordWrapArray);
		$this->assertEquals(HtmlStringTest::EXEMPLO, HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrap(255,"\n",true));
	}

}
