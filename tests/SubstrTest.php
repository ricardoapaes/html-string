<?php

/**
 * @author Ricardo Paes
 * @since 16/01/2019 às 15:47
 */

namespace Like\Util\HtmlString\Tests;

use Like\Util\HtmlString;
use PHPUnit_Framework_TestCase;

class SubstrTest extends PHPUnit_Framework_TestCase {

	public function testSubstr1() {
		$this->assertEquals("Pizza Metro", substr(HtmlStringTest::EXEMPLO_LIMPO,0,11));
		$this->assertEquals("<b><d>Pizza <h>Metro</h></d></b>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(0, 11));
	}

	public function testSubstr2() {
		$this->assertEquals("Pizza Metro -- FRANGO", substr(HtmlStringTest::EXEMPLO_LIMPO,0,21));
		$this->assertEquals("<b><d>Pizza <h>Metro -- <b>FRANGO</b></h></d></b>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(0, 21));
	}

	public function testSubstr3() {
		$this->assertEquals(" Met", substr(HtmlStringTest::EXEMPLO_LIMPO,5,4));
		$this->assertEquals(" <h>Met</h>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(5,4));
	}

	public function testSubstr4() {
		$this->assertEquals(" Metro -- FRANG", substr(HtmlStringTest::EXEMPLO_LIMPO,5,15));
		$this->assertEquals(" <h>Metro -- <b>FRANG</b></h>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(5,15));
	}

	public function testSubstr5() {
		$this->assertEquals("FRANGO", substr(HtmlStringTest::EXEMPLO_LIMPO,15,6));
		$this->assertEquals("FRANGO", HtmlString::get(HtmlStringTest::EXEMPLO_LIMPO)->substr(15,6));
		$this->assertEquals("<b>FRANGO</b>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(15,6));
	}

	public function testSubstr6() {
		$this->assertEquals("- FRA", substr(HtmlStringTest::EXEMPLO_LIMPO,13,5));
		$this->assertEquals("- FRA", HtmlString::get(HtmlStringTest::EXEMPLO_LIMPO)->substr(13,5));
		$this->assertEquals("- <b>FRA</b>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(13,5));
	}

	public function testSubstr7() {
		$this->assertEquals("ESA -- Bor", substr(HtmlStringTest::EXEMPLO_LIMPO,40,10));
		$this->assertEquals("ESA -- Bor", HtmlString::get(HtmlStringTest::EXEMPLO_LIMPO)->substr(40,10));
		$this->assertEquals("ESA -- Bor", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(40,10));
	}

	public function testSubstr8() {
		$this->assertEquals("O CATUPIRY", substr(HtmlStringTest::EXEMPLO_LIMPO,20,10));
		$this->assertEquals("O CATUPIRY", HtmlString::get(HtmlStringTest::EXEMPLO_LIMPO)->substr(20,10));
		$this->assertEquals("<b>O</b> <e>CATUPIRY</e>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(20,10));
	}

	public function testSubstr9() {
		$this->assertEquals(" -- CALABR", substr(HtmlStringTest::EXEMPLO_LIMPO,30,10));
		$this->assertEquals(" -- CALABR", HtmlString::get(HtmlStringTest::EXEMPLO_LIMPO)->substr(30,10));
		$this->assertEquals(" -- CALABR", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(30,10));
	}

	public function testSubstrNoExact1() {
		$this->assertEquals("<b><d>Pizza</d></b>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(0,8,false));
	}

	public function testSubstrNoExact2() {
		$diffLength = null;
		$this->assertEquals("<h>Metro -- <b>FRANGO</b></h>", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(6,20,false,$diffLength));
		$this->assertEquals(4, $diffLength);
	}

	public function testSubstrNoExact3() {
		$this->assertEquals("ESA --", HtmlString::get(HtmlStringTest::EXEMPLO_LIMPO)->substr(40,10,false));

		$diffLength = null;
		$this->assertEquals("ESA --", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(40,10,false,$diffLength));
		$this->assertEquals(3, $diffLength);
	}

	public function testSubstrNoExact4() {
		$this->assertEquals("Borda CHOCOLATE PRETO NO", HtmlString::get(HtmlStringTest::EXEMPLO_LIMPO)->substr(47,24,false));
		$this->assertEquals("<h>Borda</h> CHOCOLATE PRETO NO", HtmlString::get(HtmlStringTest::EXEMPLO)->substr(47,24,false));
	}

}
