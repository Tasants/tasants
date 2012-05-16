<?php
require_once "tests/unit/TasantsTestCase.php";
class EventImportRockCafeCzTest extends TasantsTestCase {
    public function testParsing() {
        $service = new EventImportService();
        $events = $service->Parse(new EventImportRockCafeCz());
        $this->assertEquals(40, sizeof($events));

        $event = $events[0];
        /* @var $event EventData */
        $this->assertEquals("2012-05-01", $event->Date());
        $this->assertEquals("TotO divadlo Praha: SRDCERVÁČ (Premiéra)", $event->Name());
        $this->assertEquals("TotO divadlo Praha „Zvedá se vítr. Žene před sebou stébla. Honí před sebou listy z loňského podzimu. Vítr žene po silnici prázdný, lehký obal černé kočky, kočky nehmotné a vyschlé. Je pohublá a pomuchlaná jako noviny honěné větrem. Kočičí přízrak se groteskním saltem odpoutává od země a při dopadu se stáčí do klubíčka. Jakmile se dotkne klasů, zelektrizuje se a poletuje sem a tam jako opilý…", $event->Description());
        $this->assertEquals("Národní třída 20, Praha 1, 110 00 Praha, Czech Republic", $event->Address());
        $this->assertEquals("50.0818481", $event->Latitude());
        $this->assertEquals("14.4186401", $event->Longitude());
        $event = $events[39];
        /* @var $event EventData */
        $this->assertEquals("2012-05-31", $event->Date());
        $this->assertEquals("BOB WAYNE & THE OUTLAW CARNIES (USA), THE MOONSHINE HOWLERS, TWISTED ROD", $event->Name());
        $this->assertEquals("BOB WAYNE Bob Wayne je spolu s Hankem III asi nejprofláklejší představitel moderního špinavýho outlaw country. Jeho inspirace je jak ve tvorbě coutnry velikánů jako Johnnyho Cashe či Hanka Williamse i v punku nebo metalu. Tyto vlivy tam jsou nesmírně znát. Bob se svýma Outlaw Carnies šlapou jak rozjetej vlak a nic jim nebrání v cestě. Přijďte se sami přesvědčit! THE MOONSHINE HOWLERS Country…", $event->Description());
    }
}
