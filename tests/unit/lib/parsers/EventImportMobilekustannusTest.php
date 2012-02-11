<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportMobilekustannusTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportMobilekustannus());
        $this->assertEquals(182, sizeof($events));

        $event = $events[54];
        /* @var $event EventData */
        $this->assertEquals("Monk-spesiaali! 20:30 ovet auki, 21:00 Pepe Willberg Trio", $event->Name());

        $event = $events[56];
        /* @var $event EventData */
        $this->assertEquals("Reggaematic - Jah Vice, Natural Marcus", $event->Name());
    }
}
