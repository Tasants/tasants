<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportBluesKlubiNetTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportKlubiNet());

        $this->assertEquals(39, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Tampere", $event->City());
        $this->assertEquals("12.2.2012", $event->Date());
        $this->assertEquals("Klubi", $event->Place());
        $this->assertEquals("Ystävyydellä Cantarelli Liput 15,00", $event->Name());

        $event = $events[10];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Tampere", $event->City());
        $this->assertEquals("22.2.2012", $event->Date());
        $this->assertEquals("Klubi", $event->Place());
        $this->assertEquals("Santalahden sauna (Pakkahuone): AMON AMARTH (SWE) K-15/K-18 Liput 33,00", $event->Name());
    }
    private function CheckBrs($i, EventData $event) {
        if (stristr($event->City(), '<br>')) {
            throw new Exception("i: " . $i);
        }
        if (stristr($event->Place(), '<br>')) {
            throw new Exception("i: " . $i);
        }
        if (stristr($event->Name(), '<br>')) {
            throw new Exception("i: " . $i);
        }
    }
}
