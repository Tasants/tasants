<?php
interface IEventParser {
    public function Parse(ICache $cache);
    public function Name();
    public function Url();
}
interface ICache {
    public function FetchWithCache($url);
}
class EventImportService implements ICache {
    public function FetchWithCache($url, $skip_enconding = false) {
        $cache = DATA  . rawurlencode($url);
        if (!is_file($cache)) {
            $data = file_get_contents($url);
            file_put_contents($cache, $data);
        }
        if ($skip_enconding) {
            return file_get_contents($cache);
        }
        return iconv("latin1", "utf-8", file_get_contents($cache));
    }
    public function Parse(IEventParser $parser) {
        $events = $parser->Parse($this);
        foreach ($events as $event) {
            if (!$event instanceof EventData) {
                throw new Exception("Excepting EventData");
            }
            try {
                // ok
            } catch (Exception $ex) {
                echo "Error saving:" . $ex->getMessage();
            }
        }
        return $events;
    }
}
