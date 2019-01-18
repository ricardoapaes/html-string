<?php

/**
 * @author Ricardo Paes
 * @since 14/01/2019 às 18:17
 */

namespace Like\Util\HtmlString\Tests;

use Like\Util\HtmlString;
use PHPUnit_Framework_TestCase;

class HtmlStringTest extends PHPUnit_Framework_TestCase {

	const EXEMPLO = '<b><d>Pizza <h>Metro -- <b>FRANGO</b> <e>CATUPIRY</e> -- CALABRESA -- Borda</h> CHOCOLATE PRETO NO BRANCO R$ 8,90</d></b>';
	const EXEMPLO_LIMPO = 'Pizza Metro -- FRANGO CATUPIRY -- CALABRESA -- Borda CHOCOLATE PRETO NO BRANCO R$ 8,90';

	public function testClear() {
		$this->assertEquals("Pizza Metro -- FRANGO CATUPIRY -- CALABRESA -- Borda CHOCOLATE PRETO NO BRANCO R$ 8,90", HtmlString::get(self::EXEMPLO)->clear());
	}

	public function testStrlen() {
		$this->assertEquals(86, HtmlString::get(self::EXEMPLO)->strlen());
	}

}
