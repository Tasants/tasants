<?php

class EventImportMuseotFi implements IEventParser {
    public function Name() {
        return "www.museot.fi";
    }
    public function Url() {
        return "http://www.museot.fi/nayttelykalenteri/index.php?x_hakulause=&pva=18&vv_kk=__Y__-__D__&ajanjakso=7&maakunta_id=0&kunta_id=0&nayttelyhaku=1&submit=HAE";
    }
    public function Parse(ICache $cache) {
        if (!preg_match(',(^.*?://.*?)/,ms', $this->Url(), $domain_match)) {
            throw new Exception("Can't resolve domain.");
        }
        $domain = $domain_match[1];
        $y = date('Y');
        $m = date('m');
        $url = str_replace(array('__Y__', '__D__'), array($y, $m), $this->Url());
        $tools = new ParsingTools();

        $data = $cache->FetchWithCache($url);

        preg_match(',<h1>Hakutulos</h1><table width="400">(.*?)</table>,ms', $data, $matches);

        if (!isset($matches[1])) {
            throw new Exception("Can't find table.");
        }
        $rows = explode('<tr', $matches[1]);
        array_shift($rows);
        array_shift($rows);
        $tokens = array();
        $events = array();
        foreach ($rows as $row) {
            preg_match(',<td.*?>(.*?)</td>.*?<td.*?><div.*?><a.*?href="(.*?)".*?>(.*?)</a><br>(.*)?</div>.*?</td>.*?<td.*?>(.*?)</td>.*?<td.*?><div.*?>(.*?)</div></td>.*?,ms', $row, $event_matches);
            array_shift($event_matches);
            $name = $event_matches[2];
            $link = $domain . $event_matches[1];
            $place = $event_matches[3];
            $city = $event_matches[4];
            $start_end_date = $event_matches[5];
            if (preg_match(',(.*?)&#8211;(.*?),ms', $start_end_date, $date_matches)) {
                $start_date = $date_matches[1];
                $end_date = $date_matches[1];
            } else {
                $start_date = $start_end_date;
                $end_date = null;
            }
            $event_data = new EventData();
            $event_data->SetDate($start_date);
            if ($end_date) {
                $event_data->SetEndDate($end_date);
            }
            $event_data->SetLink($link);
            $event_data->SetName($tools->Decode(trim($name)));
            $event_data->SetDescription('');
            $event_data->SetCountry("FI");
            $event_data->SetCity($tools->CityFix(trim($city)));
            $event_data->SetPlace($tools->Decode(trim($place)));
            $event_data->SetTags(array('museo'));
            $events[] = $event_data;
        }
        return $events;
    }
}
