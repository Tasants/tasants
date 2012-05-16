<?php

class EventImportRockCafeCz implements IEventParser {
    public function Name() {
        return 'rockcafe.cz';
    }
    public function Url() {
        return "http://www.rockcafe.cz/program/";
    }
    public function Parse(ICache $cache) {
        $tools = new ParsingTools();
        $data = $cache->FetchWithCache($this->Url(), true);
        $data = preg_replace(',.*<div class="events-list">(.*?)<div id="footer">,ms', '$1', $data);
        $tokens = explode('<div class="item', $data);
        array_shift($tokens);
        foreach ($tokens as $one) {
            $date = preg_replace(',.*date_([0-9]+?-[0-9]+?-[0-9]{2}).*,ms', '$1', $one);
            $link = $this->Url() . preg_replace(',.*<h3><a href="/program/(.*?)".*,ms', '$1', $one);
            $name = preg_replace(',.*<h3><a href="/program.*?">(.*?)</a></h3>.*,ms', '$1', $one);
            $description = preg_replace(",\s+,ms", " ", str_replace(array("\n", "\r"), " ", preg_replace(',.*<div class="description">(.*?)</div>.*,ms', '$1', $one)));
            $event = new EventData();
            $event->SetDate($date);
            $event->SetName($name);
            $event->SetDescription($description);
            $event->SetCountry("CZ");
            $event->SetCity('Prague');
            $event->SetPlace('Rock Cafe');
            $event->SetAddress('Národní třída 20, Praha 1, 110 00 Praha, Czech Republic');
            $event->SetLatitude("50.0818481");
            $event->SetLongitude("14.4186401");
            $event->SetTags(array());
            $events[] = $event;
        }
        return $events;
    }
    private function ReplaceThese() {
        return array('mm.', '!', '1. krs');
    }
    private function ReplaceToThese() {
        return array('[mm]', '[!]', '[1krs]');
    }
    private function PreReplace($data) {
        return str_replace($this->ReplaceThese(), $this->ReplaceToThese(), $data);
    }
    private function PostReplace($data) {
        return str_replace($this->ReplaceToThese(), $this->ReplaceThese(), $data);
    }
    private function ReturnIfExists($array, $key) {
        return isset($array[$key]) ? $array[$key] : null;
    }
}