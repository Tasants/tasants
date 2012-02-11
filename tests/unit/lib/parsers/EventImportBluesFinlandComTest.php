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

    }
}
