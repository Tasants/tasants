<?php

class EventImportNightClubFi implements IEventParser {
    public function Name() {
        return "www.nightclub.fi";
    }
    public function Url() {
        return "http://www.nightclub.fi/tapahtumat";
    }
    public function Parse(ICache $cache) {
        $data = $cache->FetchWithCache($this->Url());
        preg_match(',<h1>Tapahtumat</h1>(.*?)<div id="content_footer">,ms', $data, $matches);

        if (!isset($matches[1])) {
            throw new Exception("Can't find table.");
        }
        $tools = new ParsingTools();
        $tables = explode('<table', $matches[1]);
        array_shift($tables);
        $tokens = array();
        $events = array();
        foreach ($tables as $table) {
            $event_matches = array();
            if (!preg_match(',<td.*?>.*?<b>.*([0-9]{2}?.[0-9]{2}?.[0-9]{4}?).?@(.*?)</b><span.*?>(.*?)</span>(.*?)</td>,ms', $table, $event_matches)) {
                var_dump($table);
                exit;
            }
            array_shift($event_matches);

            $date = $event_matches[0];
            $place = $event_matches[1];
            $name = $event_matches[2];
            $description = $event_matches[3];
            $city = 'Turku';

            $event_data = new EventData();
            $event_data->SetDate($date);
            $event_data->SetLink($this->Url());
            $event_data->SetName($tools->Decode(trim($name)));
            $event_data->SetDescription('');
            $event_data->SetCountry("FI");
            $event_data->SetCity($tools->CityFix(trim($city)));
            $event_data->SetPlace($tools->Decode(trim($place)));
            $event_data->SetTags(array('nightlife'));
            $events[] = $event_data;
        }
        return $events;
    }
}
