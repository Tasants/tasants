<?php

class EventImportVagonCz  implements IEventParser {
    public function Name() {
        return "vagon.cz";
    }
    public function Url() {
        return "http://www.vagon.cz/dnes.html";
    }
    public function Parse(ICache $cache) {
        $tools = new ParsingTools();
        $data = $cache->FetchWithCache($this->Url(), true);
        return array();
    }
}