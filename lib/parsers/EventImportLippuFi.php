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
            //tku
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show_resulttable=25&nurbuchbar=true&ortId=113&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=113&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=50&nurbuchbar=true&ortId=113&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //hki
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&detailadoc=erdetaila&detailbdoc=evdetailb&nurbuchbar=true&ortId=22&tipps=yes'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index=25&nurbuchbar=true&ortId=22&show=25&sort_by=event_name1&sort_direction=asc'),

            //tampere
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&detailadoc=erdetaila&detailbdoc=evdetailb&nurbuchbar=true&ortId=112&tipps=yes'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index=25&nurbuchbar=true&ortId=112&show=25&sort_by=event_name1&sort_direction=asc'),

            //espoo
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=119&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=119&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=50&nurbuchbar=true&ortId=119&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //jyväskylä
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&detailadoc=erdetaila&detailbdoc=evdetailb&nurbuchbar=true&ortId=114&tipps=yes'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index=25&nurbuchbar=true&ortId=114&show=25&sort_by=event_name1&sort_direction=asc'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=50&nurbuchbar=true&ortId=114&show_resulttable=25&sort_by=event_name1&sort_by_resulttable=event_name1&sort_direction=asc'),

            //kajaani
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=132&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=132&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //kotka
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=139&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=139&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //kouvola
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=140&sort_by=event_datum'),

            //kuopio
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=175&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=175&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //lahti
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=142&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=142&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //lappeenranta
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=143&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=143&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //oulu
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=115&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=115&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //pori
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=116&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=116&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //savonlinna
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=117&sort_by=event_datum'),
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?affiliate=ADV&doc=city&fun=ortsliste&index_resulttable=25&nurbuchbar=true&ortId=117&show_resulttable=25&sort_by=event_datum&sort_by_resulttable=event_datum&sort_direction=asc'),

            //vantaa
            $this->ParseFests($cache, 'http://www.lippu.fi/Lippuja.html?sort_direction=asc&affiliate=ADV&fun=ortsliste&doc=city&show=25&nurbuchbar=true&ortId=118&sort_by=event_datum'),

            array()
        );
    }
    private function ParseFests(ICache $cache, $url) {
        $tools = new ParsingTools();

        $data = $cache->FetchWithCache($url, true);
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

            if (!$tools->Decode($place) || !$tools->Decode($name)) {
                // @todo continue only if only both fails ->improve parsing
                continue;
            }
            $event_data = new EventData();
            $event_data->SetDate($date);
            $event_data->SetDescription('');
            $event_data->SetCountry("FI");
            $event_data->SetCity($tools->Ucfirst($city));
            $event_data->SetPlace($tools->Decode($place));
            $event_data->SetName($tools->Decode($name));
            $events[] = $event_data;


        }
        return $events;
    }
}
