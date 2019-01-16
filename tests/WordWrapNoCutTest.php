<?php

/**
 * @author Ricardo Paes
 * @since 16/01/2019 às 15:56
 */

namespace Like\Util\HtmlString\Tests;

use Like\Util\HtmlString;
use PHPUnit_Framework_TestCase;

class WordWrapNoCutTest extends PHPUnit_Framework_TestCase {

	public function testWordwrapCut1() {
		$this->assertEquals("Pizza Metro -- FRANGO CATUPIRY -- CALABRESA --\nBorda CHOCOLATE PRETO NO BRANCO R$ 8,90", wordwrap(HtmlStringTest::EXEMPLO_LIMPO,48,"\n",false));

		$wordWrapArray = HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrapArray(48,true);
		$this->assertEquals(2, count($wordWrapArray));
		$this->assertEquals(["<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CATUPIRY</e> -- CALABRESA --</h></d></b>","<b><d><h>Borda</h> CHOCOLATE PRETO NO BRANCO R$ 8,90</d></b>"], $wordWrapArray);

		$this->assertEquals("<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CATUPIRY</e> -- CALABRESA --</h></d></b>\n<b><d><h>Borda</h> CHOCOLATE PRETO NO BRANCO R$ 8,90</d></b>", HtmlString::get(HtmlStringTest::EXEMPLO)->wordwrap(48,"\n",false));
	}

}
