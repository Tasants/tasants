<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportNightClubFiTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportNightClubFi());
        $this->assertEquals(15, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("Perjantain Bileet!", $event->Name());
        $this->assertEquals("Prima", $event->Place());
        $this->assertEquals("Turku", $event->City());
        $this->assertEquals("24.02.2012", $event->Date());

        $event = $events[1];
        /* @var $event EventData */
        $this->assertEquals("Rockbusters (SWE)!", $event->Name());
        $this->assertEquals("Apollo", $event->Place());
        $this->assertEquals("Turku", $event->City());
        $this->assertEquals("24.02.2012", $event->Date());
    }
}
