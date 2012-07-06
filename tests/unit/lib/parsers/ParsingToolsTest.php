<?php
require_once "tests/unit/TasantsTestCase.php";

class ParsingToolsTest extends TasantsTestCase {
    public function testConvertingEntities() {
        $tools = new ParsingTools();
        $this->assertEquals("DJ’s Lovroc & Anna S.", $tools->Decode("DJ&#8217;s Lovroc & Anna S."));
    }
}