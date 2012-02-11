<?php

class EventImportBluesFinlandCom implements IEventParser {
    public function Name() {
        return "www.blues-finland.com";
    }
    public function Url() {
        return "http://www.blues-finland.com/events.html";
    }
    private function Part($string, $delimiter, $index) {
        $tokens = explode($delimiter, $string);
        return isset($tokens[$index]) ? $tokens[$index] : null;
    }
    public function Parse(ICache $cache) {
        return array_merge(
            $this->ParseFests($cache, $this->Url()),
            array()
        );
    }
    private function ParseFests(ICache $cache, $url) {
        $data = $cache->FetchWithCache($url);
        $tokens = explode('<font color="#0000CC" size="2"><span style="font-size:14px;line-height:18px;">', $data);
        array_shift($tokens);
        foreach ($tokens as $token) {
            preg_match(',(.*?)<br>(.*),ms', $token, $matches);
            $year_month = $matches[1];
            $event_rows = explode('<span style="font-size:10px;line-height:14px;">', $matches[2]);

            array_shift($event_rows);
            while (sizeof($event_rows)) {
                $date_artist = array_shift($event_rows);
                $city_place = array_shift($event_rows);

                preg_match(',([0-9]+?\.[0-9]+?.)(.*)</span>,', $date_artist, $matches);
                if (!isset($matches[1])) {
                    continue;
                }
                $date = $matches[1];
                $name = trim($matches[2]);

                preg_match('/(.*)?,(.*?)<br>/', $city_place, $matches);
                if (!isset($matches[1])) {
                    preg_match('/(.*)?,(.*?)<\/span>/', $city_place, $matches);
                }
                $city = trim($matches[1]);
                $place = trim($matches[2]);

                $event_data = new EventData();
                $event_data->SetDate($this->ResolveDate($year_month, $date));
                $event_data->SetName($this->Decode($name));
                $event_data->SetDescription('');
                $event_data->SetCity($this->Decode($city));
                $event_data->SetPlace($this->Decode($place));
                $event_data->SetTags(array('blues'));
                $events[] = $event_data;
            }
        }
        return $events;
    }
    private function Decode($string) {
        return html_entity_decode($string, null, "utf-8");
    }
    private function ResolveDate($year_month, $date) {
        return $date . preg_replace(',.*([0-9]{4}).*,', '$1', $year_month);
    }

}
