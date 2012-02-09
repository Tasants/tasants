<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportMobilekustannusTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportMobilekustannus());
        $this->assertEquals(143, sizeof($events));
    }
}
