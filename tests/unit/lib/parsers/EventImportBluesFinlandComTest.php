<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportBluesFinlandComTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportBluesFinlandCom());

        $this->assertEquals(120, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Helsinki", $event->City());
        $this->assertEquals("10.2.2012", $event->Date());
        $this->assertEquals("Storyville", $event->Place());
        $this->assertEquals("Kat Baloun", $event->Name());

        $event = $events[10];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Kemi", $event->City());
        $this->assertEquals("11.2.2012", $event->Date());
        $this->assertEquals("Taiteiden yö", $event->Place());
        $this->assertEquals("Honey B & The T-Bones, DJ Frankly Jo'", $event->Name());

        $event = $events[50];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Espoo", $event->City());
        $this->assertEquals("25.2.2012", $event->Date());
        $this->assertEquals("Base", $event->Place());
        $this->assertEquals("Antsu Haahtela Trio", $event->Name());

        $event = $events[8];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Pieksämäki", $event->City());
        $this->assertEquals("11.2.2012", $event->Date());
        $this->assertEquals("", $event->Place());
        $this->assertEquals("Savonsolmu Winter Blues Party", $event->Name());

        $event = $events[117];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Oulu", $event->City());
        $this->assertEquals("31.3.2012", $event->Date());
        $this->assertEquals("", $event->Place());
        $this->assertEquals("Oulu Spring Blues", $event->Name());

        foreach ($events as $i => $event) {
            $this->CheckBrs($i, $event);
        }

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
