<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportMuseotFiTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportMuseotFi());
        $this->assertEquals(271, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("Kyllikki Haavisto: Found - Founded - Disappeared (20.6. - 2.9.2012)", $event->Name());
        $this->assertEquals("Nelimarkka-museo, Etelä-Pohjanmaan aluetaidemuseo ja Nelimarkka-residenssi", $event->Place());
        $this->assertEquals("Alajärvi", $event->City());
        $this->assertEquals("20.6.2012", $event->Date());
    }
}
