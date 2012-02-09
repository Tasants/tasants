<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportLippuFiTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportLippuFi());
        $this->assertEquals(25, sizeof($events));
    }
}
