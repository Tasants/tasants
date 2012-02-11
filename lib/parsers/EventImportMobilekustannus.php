<?php

class EventImportMobilekustannus implements IEventParser {
    public function Name() {
        return 'mobilekustannnus.fi';
    }
    public function Url() {
        return "http://mobilekustannus.fi/tapahtumat/21";
    }
    private function Part($string, $delimiter, $index) {
        $tokens = explode($delimiter, $string);
        return isset($tokens[$index]) ? $tokens[$index] : null;
    }
    public function Parse(ICache $cache) {
        $url = "http://mobilekustannus.fi/tapahtumat/21";
        $data = $this->PreReplace($cache->FetchWithCache($url));
        $data = $this->Part($data, 'class="events"', 1);
        $dates = explode('class="date"', $data);
        $events = array();
        foreach ($dates as $row) {
            $tokens2 = explode('class="event"', $row);
            $date_info = array_shift($tokens2);
            $date = preg_replace(',.*<b>.*<br>(.*)</b.*,', '$1', $date_info) . '' . date('Y');
            foreach ($tokens2 as $event) {
                $place = trim(preg_replace(',.*paikka/.*">(.*)</a>.*,ms', '$1', $event));
                $coordinates = explode(",", preg_replace(',.*map="(.*)" desc=".*,ms', '$1', $event));
                $latitude = isset($coordinates[0]) ? $coordinates[0] : null;
                $longitude = isset($coordinates[1]) ? $coordinates[1] : null;
                $address = preg_replace(',.*paikka/391">(.*?)</a>.*,ms', '$1', $event);
                $type = '';
                if (preg_match(',.*<span class="text"><span class="typelabel">(.*)</span>.*,ms', $event)) {
                    $type = preg_replace(',.*<span class="text"><span class="typelabel">(.*)</span>.*,ms', '$1', $event);
                    $name = preg_replace(',.*<span class="text"><span class="typelabel">.*</span>(.*)</span>.*,ms', '$1', $event);
                } else {
                    $name = preg_replace(',.*<span class="text">(.*)</span>.*,ms', '$1', $event);
                }
                $name_tokens = explode(".", $name);
                $name = array_shift($name_tokens);
                $description = htmlspecialchars_decode(trim(implode(".", $name_tokens)));
                $city = 'Turku';
                $event = new EventData();
                $event->SetDate($date);
                $event->SetName($this->PostReplace($name));
                $event->SetDescription($this->PostReplace($description));
                $event->SetCity($city);
                $event->SetPlace($this->PostReplace($place));
                $event->SetAddress($address);
                $event->SetLatitude($latitude);
                $event->SetLongitude($latitude);
                $event->SetTags(array($type));
                $events[] = $event;
            }
        }
        return $events;
    }
    private function PreReplace($data) {
        return str_replace(array('mm.'), array('[mm]'), $data);
    }
    private function PostReplace($data) {
        return htmlspecialchars_decode(str_replace(array('[mm]'), array('mm.'), $data));
    }
}