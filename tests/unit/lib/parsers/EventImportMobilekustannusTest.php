<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportMobilekustannusTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportMobilekustannus());
        $this->assertEquals(182, sizeof($events));

        $event = $events[54];
        /* @var $event EventData */
        $this->assertEquals("Monk-spesiaali!", $event->Name());
        $this->assertEquals("Monk", $event->Place());
        $this->assertEquals("Humalistonkatu 3", $event->Address());
        $this->assertEquals("60.449752", $event->Latitude());
        $this->assertEquals("22.260343", $event->Longitude());

        $event = $events[56];
        /* @var $event EventData */
        $this->assertEquals("Reggaematic - Jah Vice, Natural Marcus", $event->Name());
        $this->assertEquals("Pikku-Torre", $event->Place());
        $this->assertEquals("", $event->Address());
    }
}
