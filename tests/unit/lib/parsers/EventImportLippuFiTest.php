<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportLippuFiTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportLippuFi());
        $this->assertEquals(731, sizeof($events));
        $event = $events[1];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Turku", $event->City());
        $this->assertEquals("9.2.2012", $event->Date());
        $this->assertEquals("Turun Nuori Teatteri, Ursininkatu 4", $event->Place());
        $this->assertEquals("Puputyttö", $event->Name());

        $event = $events[2];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Turku", $event->City());
        $this->assertEquals("10.2.2012", $event->Date());
        $this->assertEquals("Linnateatteri, Teatterisali 4.krs.", $event->Place());
        $this->assertEquals("Mieletön oopperan historia /Tu...", $event->Name());

        $event = $events[7];
        /* @var $event EventData */
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Turku", $event->City());
        $this->assertEquals("13.2.2012", $event->Date());
        $this->assertEquals("OS/G Areena", $event->Place());
        $this->assertEquals("TUTO HOCKEY - HAASTEKIERROS", $event->Name());

        $event = $events[455];
        /* @var $event EventData */
        /*
        $this->assertEquals("", $event->Address());
        $this->assertEquals("Kuopio", $event->City());
        $this->assertEquals("15.2.2012", $event->Date());
        $this->assertEquals("Kuopion Musiikkikeskus", $event->Place());
        $this->assertEquals("ERJA LYYTINEN", $event->Name());
        */
    }
}
