<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportTurkuFiTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportTurkuFi());
        $this->assertEquals(160, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Turku", $event->City());
        $this->assertEquals("11.4.2012", $event->Date());
        $this->assertEquals("Puutarhakatu 1:n auditorio", $event->Place());
        $this->assertEquals("Suomalaisen elokuvan festivaali", $event->Name());

        $event = $events[100];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Turku", $event->City());
        $this->assertEquals("8.2.2012", $event->Date());
        $this->assertEquals("Sibelius-museo", $event->Place());
        $this->assertEquals("Sibelius-museon kevään 2012 konserttisarja", $event->Name());

    }
}
