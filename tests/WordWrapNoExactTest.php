<?php

/**
 * @author Ricardo Paes
 * @since 16/01/2019 às 15:56
 */

namespace Like\Util\HtmlString\Tests;

use Like\Util\HtmlString;
use PHPUnit_Framework_TestCase;

class WordWrapNoExactTest extends PHPUnit_Framework_TestCase {

	public function testWordwrap1() {
		$this->assertEquals("Pizza Metro -- FRANGO CATUPIRY -- CALABRESA --\nBorda CHOCOLATE PRETO NO BRANCO R$ 8,90", wordwrap(HtmlStringTest::EXEMPLO_LIMPO,48,"\n",false));

		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(48,false);
		$this->assertEquals(2, count($wordWrapArray));
		$this->assertEquals([
			"<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CATUPIRY</e> -- CALABRESA --</h></d></b>",
			"<b><d><h>Borda</h> CHOCOLATE PRETO NO BRANCO R$ 8,90</d></b>"
		], $wordWrapArray);
	}

	public function testWordwrap2() {
		$this->assertEquals("Pizza Metro -- FRANGO\nCATUPIRY -- CALABRESA --\nBorda CHOCOLATE PRETO NO\nBRANCO R$ 8,90", wordwrap(HtmlStringTest::EXEMPLO_LIMPO,24,"\n",false));

		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(24,false);
		$this->assertEquals(4, count($wordWrapArray));
		$this->assertEquals([
			"<b><d>Pizza <h>Metro -- <b>FRANGO</b></h></d></b>",
			"<b><d><h><e>CATUPIRY</e> -- CALABRESA --</h></d></b>",
			"<b><d><h> Borda</h> CHOCOLATE PRETO</d></b>",
			"<b><d>NO BRANCO R$ 8,90</d></b>"
		], $wordWrapArray);
	}

	public function testWordwrap3() {
		$this->assertEquals("Pizza\nMetro --\nFRANGO\nCATUPIRY\n--\nCALABRESA\n-- Borda\nCHOCOLATE\nPRETO NO\nBRANCO R$\n8,90", wordwrap(HtmlStringTest::EXEMPLO_LIMPO,10,"\n",false));
		$this->assertEquals([
			"<b><d>Pizza</d></b>",
			"<b><d><h>Metro --</h></d></b>",
			"<b><d><h><b>FRANGO</b></h></d></b>",
			"<b><d><h><e>CATUPIRY</e></h></d></b>",
			"<b><d><h>--</h></d></b>",
			"<b><d><h>CALABRESA</h></d></b>",
			"<b><d><h>-- Borda</h></d></b>",
			"<b><d>CHOCOLATE</d></b>",
			"<b><d>PRETO NO</d></b>",
			"<b><d>BRANCO R$</d></b>",
			"<b><d>8,90</d></b>"
		], HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(10,false));
	}

}
