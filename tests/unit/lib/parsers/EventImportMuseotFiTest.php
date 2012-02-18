<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportMuseotFiTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportMuseotFi());
        $this->assertEquals(242, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("Keskitalven uni (15.1. - 26.2.2012)", $event->Name());
        $this->assertEquals("Nelimarkka-museo, Etelä-Pohjanmaan aluetaidemuseo ja Nelimarkka-residenssi", $event->Place());
        $this->assertEquals("Alajärvi", $event->City());
        $this->assertEquals("15.1.2012", $event->Date());
    }
}
