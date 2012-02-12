<?php

class EventImportKlubiNet implements IEventParser {
    public function Name() {
        return "www.klubi.net";
    }
    public function Url() {
        return "http://www.klubi.net/";
    }
    private function Part($string, $delimiter, $index) {
        $tokens = explode($delimiter, $string);
        return isset($tokens[$index]) ? $tokens[$index] : null;
    }
    public function Parse(ICache $cache) {
        return array_merge(
            $this->ParseFests($cache, 'http://www.klubi.net/event_rss.php?brid=1&lang=0', "Tampere"),
            $this->ParseFests($cache, 'http://www.klubi.net/event_rss.php?brid=2&lang=0', "Turku"),
            array()
        );
    }
    private function ParseFests(ICache $cache, $url, $city) {
        $tools = new ParsingTools();

        $data = $cache->FetchWithCache($url, true);
        $items = explode("<item>", $data);
        array_shift($items);
        foreach($items as $data) {
            preg_match('|<title>([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}) (.*?)</title>.*?<description>(.*?)</description>|ms',  $data, $matches);
		    $date = $matches[1];
		    $name = $matches[2];
		    $description = $matches[3];

		    $name = trim(str_replace("<br>" , " ", $tools->Decode($name .' ' . $description)));
		    $description = '';
		    if (mb_strlen($name) > 256) {
		        $name = mb_substr($name, 0, 256);
		        $desctiption = $name;
		    }


            $event_data = new EventData();
            $event_data->SetDate($date);
            $event_data->SetName($name);
            $event_data->SetDescription($description);
            $event_data->SetCity($city);
            $event_data->SetPlace("Klubi");
            $events[] = $event_data;

        }
        return $events;
    }
}
