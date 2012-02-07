<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportTurkuFiTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportTurkuFi());
        $this->assertEquals(160, sizeof($events));
    }
}
