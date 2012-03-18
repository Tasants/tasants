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
        $tools = new ParsingTools();

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
                preg_match(',.*?paikka/.*?">(.*?)</a>.*,ms', $event, $matches);
                $place = $matches[1];
                $coordinates = explode(",", preg_replace(',.*map="(.*)" desc=".*,ms', '$1', $event));
                $latitude = isset($coordinates[0]) ? $coordinates[0] : null;
                $longitude = isset($coordinates[1]) ? $coordinates[1] : null;
                preg_match(',.*?paikka/.*?">.*desc.*>(.*)">(.*?)</a></span>,ms', $event, $matches);
                $address = isset($matches[1]) ? $matches[1] : '';

                $type = '';
                if (preg_match(',.*<span class="text"><span class="typelabel">(.*?)</span>(.*?)</span>,ms', $event, $matches)) {
                    $type = $matches[1];
                    $name = $matches[2];
                } else if (preg_match(',.*<span class="text">(.*?)</span>.*,ms', $event, $matches)) {
                    $name = $matches[1];
                } else {
                    throw new Exception("No match: " . $event);
                }
                if (preg_match(',<a,', $name)) {
                    var_dump($name, $type);
                    throw new Exception("" . $event);
                }
                $name_tokens = explode(".", $name);
                $name = array_shift($name_tokens);
                $description = htmlspecialchars_decode(trim(implode(".", $name_tokens)));
                $city = 'Turku';
                $event = new EventData();
                $event->SetDate($date);
                $event->SetName($tools->Decode($this->PostReplace($name)));
                $event->SetDescription($tools->Decode($this->PostReplace($description)));
                $event->SetCountry("FI");
                $event->SetCity($city);
                $event->SetPlace($tools->Decode($this->PostReplace($place)));
                $event->SetAddress($address);
                $event->SetLatitude($latitude);
                $event->SetLongitude($longitude);
                $event->SetTags(array($type));
                $events[] = $event;
            }
        }
        return $events;
    }
    private function PreReplace($data) {
        return str_replace(array('mm.', '!'), array('[mm]', '[!].'), $data);
    }
    private function PostReplace($data) {
        return str_replace(array('[mm]', '[!]'), array('mm.', '!'), $data);
    }
}