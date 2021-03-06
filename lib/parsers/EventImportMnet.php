<?php

class EventImportMnet implements IEventParser {
    public function Name() {
        return "muusikoiden.net";
    }
    public function Url() {
        return "http://muusikoiden.net/keikat/";
    }
    private function Part($string, $delimiter, $index) {
        $tokens = explode($delimiter, $string);
        return isset($tokens[$index]) ? $tokens[$index] : null;
    }
    public function Parse(ICache $cache) {
        $tools = new ParsingTools();

        $data = $cache->FetchWithCache($this->Url());
        $tokens = explode('/keikat/index.php?date=&amp;location=&amp;sort=band', $data);
        $tokens2 = explode('</table>', $tokens[1]);
        $tokens3 = explode('<tr', $tokens2[0]);
        array_shift($tokens3);
        array_shift($tokens3);
        $events = array();
        foreach ($tokens3 as $row) {
            $tds = explode("<td>", $row);
            $date = preg_replace("/.*([0-9]{2}\.[0-9]{1,2}\.[0-9]{1,4}).*/", '$1', $tds[1]);
            //var_dump($tds[1], $date);
            $name = preg_replace("/<a.*>(.*)<\/a>.*/", "$1", $tds[2]);
            $city = preg_replace("/<b>(.*)<\/b>.*/", "$1", $tds[3]);
            $place = preg_replace("/<b>.*<\/b>, (.*)<\/td><td.*/", "$1", $tds[3]);
            $description = '';
            try {
                $event_data = new EventData();
                $event_data->SetDate($date);
                $event_data->SetName($tools->Decode($name));
                $event_data->SetDescription($tools->Decode($description));
                $event_data->SetCountry("FI");
                $event_data->SetCity($tools->CityFix($city));
                $event_data->SetPlace($tools->Decode($place));
                $events[] = $event_data;
            } catch (EInvalidCity $ex) {
                echo "$date, $name, $city, $place" . " " . $ex->getMessage() . "\n";
            } catch (EInvalidDate $ex) {
                echo "$date, $name, $city, $place" . " " . $ex->getMessage() . "\n";
            }
        }
        return $events;
    }
}
