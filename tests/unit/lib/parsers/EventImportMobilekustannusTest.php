<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportMobilekustannusTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportMobilekustannus());
        $this->assertEquals(155, sizeof($events));

        $event = $events[8];
        /* @var $event EventData */
        $this->assertEquals("KOLO (1. krs): Carlings presents Friday Frenzy: dj Sammy", $event->Name());
        $this->assertEquals("Klubi", $event->Place());
        $this->assertEquals("Humalistonkatu 8 a", $event->Address());


        $event = $events[54];
        /* @var $event EventData */
        $this->assertEquals("Pianisti Olli Törmä", $event->Name());
        $this->assertEquals("Bryssel", $event->Place());
        $this->assertEquals("Linnankatu 18", $event->Address());
        $this->assertEquals("60.448774", $event->Latitude());
        $this->assertEquals("22.265983", $event->Longitude());

        $event = $events[56];
        /* @var $event EventData */
        $this->assertEquals("DJ Urho Tulitukka", $event->Name());
        $this->assertEquals("Dynamo", $event->Place());
        $this->assertEquals("Linnankatu 7", $event->Address());
    }
}
