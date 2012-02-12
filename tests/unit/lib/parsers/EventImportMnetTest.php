<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportMnetTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportMnet());
        $this->assertEquals(568, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("Afrocola", $event->Name());
        $this->assertEquals("ravintola juttutupa", $event->Place());
        $this->assertEquals("Helsinki", $event->City());
        $this->assertEquals("11.02.2012", $event->Date());

        $event = $events[1];
        /* @var $event EventData */
        $this->assertEquals("Antero Lindgren", $event->Name());
        $this->assertEquals("Bar Loose", $event->Place());
        $this->assertEquals("Helsinki", $event->City());
        $this->assertEquals("11.02.2012", $event->Date());

        $event = $events[567];
        /* @var $event EventData */
        $this->assertEquals("Grazy Mama & The Sidekicks", $event->Name());
        $this->assertEquals("Ravintola Rubiini", $event->Place());
        $this->assertEquals("Helsinki", $event->City());
        $this->assertEquals("25.05.2012", $event->Date());

        $event = $events[66];
        /* @var $event EventData */
        $this->assertEquals("DJ’s Lovroc & Anna S.", $event->Name());
        $this->assertEquals("Virgin Oil Co.", $event->Place());
        $this->assertEquals("Helsinki", $event->City());
        $this->assertEquals("12.02.2012", $event->Date());

    }
}
