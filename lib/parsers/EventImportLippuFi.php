<?php

class EventImportLippuFi implements IEventParser {
    public function Name() {
        return "www.lippu.fi";
    }
    public function Url() {
        return "http://www.lippu.fi/";
    }
    private function Part($string, $delimiter, $index) {
        $tokens = explode($delimiter, $string);
        return isset($tokens[$index]) ? $tokens[$index] : null;
    }
    public function Parse(ICache $cache) {
        return array_merge(
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show_resulttable=25&nurbuchbar=true&ortId=113&sort_by=event_datum'),
            array()
        );
    }
    private function ParseFests(ICache $cache, $url) {
        $data = $cache->FetchWithCache($url);
        $tokens = explode('<table id="taEventList"', $data);
        $tds = explode('<td class="taEvent">', $tokens[1]);
        $events = array();
        $counter=0;
        foreach($tds as $data) {
            if (!preg_match('/<h4 class="summary">/', $data)) {
                //no event continue
                continue;
            }
            $date = preg_replace("/.*?([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}).*/ms", '$1', $data);
            $name = trim(preg_replace('/<h4 class="summary">.*<span>(.*)<\/span>.*<\/h4>.*/ms', "$1", $data));
            //$tag = trim(preg_replace("/<a.*>.*<\/a>.*\((.*)\).*/ms", "$1", $lis[1]));
            $place_x = trim(preg_replace('/.*<dl class="place location">(.*?)<\/dl>.*/ms', "$1", $data));
            $place = trim(preg_replace('/.*<dt>(.*?)<\/dt>.*/ms', "$1", $place_x));
            $city = trim(preg_replace('/.*<dd>(.*?)<\/dd>.*/ms', "$1", $place_x));
            $event_data = new EventData();
            $event_data->SetDate($date);
            $event_data->SetName($this->Decode($name));
            $event_data->SetDescription('');
            $event_data->SetCity("Turku");
            $event_data->SetPlace($this->Decode($place));
            $events[] = $event_data;


        }
        return $events;
    }
    private function Decode($string) {
        return html_entity_decode($string, null, "UTF-8");
    }

}
