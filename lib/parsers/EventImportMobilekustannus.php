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
        $data = $cache->FetchWithCache($url);
        $data = $this->Part($data, 'class="events"', 1);
        $dates = explode('class="date"', $data);
        array_shift($dates);
        $events = array();
        foreach ($dates as $row) {
            $tokens2 = explode('class="event"', $row);
            $date_info = array_shift($tokens2);
            $date = preg_replace(',.*<b>.*<br>(.*)</b.*,', '$1', $date_info) . '' . date('Y');
            foreach ($tokens2 as $event) {
                $tokens3 = explode("<span", $event);
                if (!isset($tokens3[3])) {
                    //var_dump($tokens3);
                    break;
                    throw new Exception("Bad name: " . $event);
                }
                $place = trim(preg_replace(',.*paikka/.*">(.*)</a>.*,i', '$1', $tokens3[1]));
                $event_rows = explode("\n", $tokens3[2]);
                $coordinates = explode(",", preg_replace(',.*map="(.*)" desc=".*,', '$1', $event_rows[0]));
                $latitude = isset($coordinates[0]) ? $coordinates[0] : null;
                $longitude = isset($coordinates[1]) ? $coordinates[1] : null;
                $address = preg_replace(',.* desc=.*">(.*)</a>.*,', '$1', $event_rows[0]);
                $name_tokens = explode(".", preg_replace(',.*class="text">(.*)</span>.*,', '$1', $tokens3[3]));
                $name = htmlspecialchars_decode(array_shift($name_tokens));
                $description = htmlspecialchars_decode(trim(implode(".", $name_tokens)));
                $city = 'Turku';
                $event = new EventData();
                $event->SetDate($date);
                $event->SetName($name);
                $event->SetDescription($description);
                $event->SetCity($city);
                $event->SetPlace($place);
                $event->SetAddress($address);
                $event->SetLatitude($latitude);
                $event->SetLongitude($latitude);
                $events[] = $event;
            }
        }
        return $events;
    }
}