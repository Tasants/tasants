<?php

class EventImportTurkuFi implements IEventParser {
    public function Name() {
        return "www.turku.fi";
    }
    public function Url() {
        return "http://www.turku.fi/tapahtumat/";
    }
    private function Part($string, $delimiter, $index) {
        $tokens = explode($delimiter, $string);
        return isset($tokens[$index]) ? $tokens[$index] : null;
    }
    public function Parse(ICache $cache) {
        return array_merge(
            //$this->ParseToday($cache),
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=9874'), // festivaalit
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=9885'),  // musiikki
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=9884'),  // museot
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=10573'),  // galleriat
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=9897'),  // pop, rock
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=9896'),  // klassinen
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=9895'),  // kirkko
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=9898'),  // tanssit
            //FIXME: errors on dates
            $this->ParseFests($cache, 'http://www.turku.fi/tapahtumat/?nodeid=9899'),  // viihde



            array()
        );
    }
    private function ParseFests(ICache $cache, $url) {
        $data = $cache->FetchWithCache($url);
        $tokens = explode('<div id="lists">', $data);
        $lis = explode("<li>", $tokens[1]);
        $events = array();
        foreach($lis as $data) {
            if (!preg_match("/<a/", $data)) {
                //no event continue
                continue;
            }
            $date = preg_replace("/.*?([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}).*/ms", '$1', $lis[1]);
            $name = trim(preg_replace("/<a.*>(.*)<\/a>.*/ms", "$1", $lis[1]));
            $tag = trim(preg_replace("/<a.*>.*<\/a>.*\((.*)\).*/ms", "$1", $lis[1]));
            $place = trim(preg_replace("/<a.*>.*<\/a>.*\(.*\).*<br \/>(.*)<span.*/ms", "$1", $lis[1]));
            $place_tokens = explode("\n", $place);
            $place = trim($place_tokens[1]);
            $event_data = new EventData();
            $event_data->SetDate($date);
            $event_data->SetName($name);
            $event_data->SetDescription('');
            $event_data->SetCity("Turku");
            $event_data->SetPlace($place);
            $events[] = $event_data;


        }
        return $events;
    }
    private function ParseToday(ICache $cache) {
        $data = $cache->FetchWithCache($this->Url());
        $tokens = explode('Tapahtuu tänään Turussa ja Turun seudulla', $data);
        $tokens = explode('<table', $tokens[1]);
        $tokens2 = explode('</table>', $tokens[1]);
        $tokens3 = explode('<tr', $tokens2[0]);
        array_shift($tokens3);
        $events = array();
        foreach ($tokens3 as $row) {
            $lis = explode("<li>", $row);
            $date = preg_replace("/.*([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}).*/ms", '$1', $lis[1]);
            $name = trim(preg_replace("/<a.*>(.*)<\/a>.*/ms", "$1", $lis[1]));
            $tag = trim(preg_replace("/<a.*>.*<\/a>.*\((.*)\).*/ms", "$1", $lis[1]));
            $place = trim(preg_replace("/<a.*>.*<\/a>.*\(.*\).*,(.*)<span.*/ms", "$1", $lis[1]));

            $event_data = new EventData();
            $event_data->SetDate($date);
            $event_data->SetName($this->PostReplace($name));
            $event_data->SetDescription('');
            $event_data->SetCity("Turku");
            $event_data->SetPlace($this->PostReplace($place));

            $events[] = $event_data;

        }
        return $events;
    }
    private function PostReplace($data) {
        return htmlspecialchars_decode(str_replace(array('[mm]'), array('mm.'), $data));
    }

}
