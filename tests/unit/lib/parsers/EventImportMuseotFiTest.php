<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportMuseotFiTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportMuseotFi());
        $this->assertEquals(225, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
    }
}
