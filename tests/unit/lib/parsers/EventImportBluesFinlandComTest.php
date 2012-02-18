<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportBluesFinlandComTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportBluesFinlandCom());

        $this->assertEquals(89, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Hämeenlinna", $event->City());
        $this->assertEquals("18.2.2012", $event->Date());
        $this->assertEquals("Suistoklubi", $event->Place());
        $this->assertEquals("Diz Watson, Tony Uter & Groovy Eyes", $event->Name());

        $event = $events[10];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Helsinki", $event->City());
        $this->assertEquals("24.2.2012", $event->Date());
        $this->assertEquals("Storyville", $event->Place());
        $this->assertEquals("Tortilla Flat, Pekka Helin Hipsters", $event->Name());

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
