<?php

class EventImportKlub007StrahovCz  implements IEventParser {
    public function Name() {
        return "klub007strahov.cz";
    }
    public function Url() {
        return "http://www.klub007strahov.cz/";
    }
    public function Parse(ICache $cache) {
        $tools = new ParsingTools();
        $data = $cache->FetchWithCache($this->Url(), true);
        return array();
    }
}