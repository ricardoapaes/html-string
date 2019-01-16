<?php

/**
 * @author Ricardo Paes
 * @since 16/01/2019 às 15:50
 */

namespace Like\Util\HtmlString\Tests;

use Like\Util\HtmlString;

class WordwrapTest extends \PHPUnit_Framework_TestCase {

	public function testWordwrapCutFalse1() {
		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(48,true);
		$this->assertEquals(2, count($wordWrapArray));
		$this->assertEquals(["<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CATUPIRY</e> -- CALABRESA -- B</h></d></b>","<b><d><h>orda</h> CHOCOLATE PRETO NO BRANCO R$ 8,90</d></b>"], $wordWrapArray);

		$this->assertEquals("<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CATUPIRY</e> -- CALABRESA -- B</h></d></b>\n<b><d><h>orda</h> CHOCOLATE PRETO NO BRANCO R$ 8,90</d></b>", HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrap(48,"\n",true));
	}

	public function testWordwrapCutFalse2() {
		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(24,true);
		$this->assertEquals(4, count($wordWrapArray));
		$this->assertEquals([
			"<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CA</e></h></d></b>",
			"<e>TUPIRY</e> -- CALABRESA -- B",
			"<h>orda</h> CHOCOLATE PRETO NO ",
			"<b><d>BRANCO R$ 8,90</d></b>"
		], $wordWrapArray);

		$this->assertEquals("<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CA</e></h></d></b>\n" .
			"<e>TUPIRY</e> -- CALABRESA -- B\n" .
			"<h>orda</h> CHOCOLATE PRETO NO \n" .
			"<b><d>BRANCO R$ 8,90</d></b>", HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrap(24,"\n",true));
	}

	public function testWordwrapCutFalse3() {
		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(10,true);
		$this->assertEquals(9, count($wordWrapArray));
		$this->assertEquals([
			"<b><d>Pizza <h>Metr</h></d></b>",
			"o -- <b>FRANG</b>",
			"<b>O</b> <e>CATUPIRY</e>",
			"<e></e> -- CALABR",
			"ESA -- Bor",
			"<h>da</h> CHOCOLA",
			"TE PRETO N",
			"O BRANCO R",
			"<b><d>$ 8,90</d></b>"
		], $wordWrapArray);

		$this->assertEquals("<b><d>Pizza <h>Metr</h></d></b>\n" .
			"o -- <b>FRANG</b>\n" .
			"<b>O</b> <e>CATUPIRY</e>\n" .
			"<e></e> -- CALABR\n" .
			"ESA -- Bor\n" .
			"<h>da</h> CHOCOLA\n" .
			"TE PRETO N\n" .
			"O BRANCO R\n" .
			"<b><d>$ 8,90</d></b>", HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrap(10,"\n",true));
	}

	public function testWordwrapCutFalse4() {
		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(255,true);
		$this->assertEquals(1, count($wordWrapArray));
		$this->assertEquals([HtmlStringTest::EXEMPLO], $wordWrapArray);
		$this->assertEquals(HtmlStringTest::EXEMPLO, HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrap(255,"\n",true));
	}

}
