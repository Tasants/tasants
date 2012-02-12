<?php

class EventData {
    private $date;
    private $name;
    private $description;
    private $city;
    private $place;
    private $address;
    private $latitude;
    private $longitude;
    private $tags = array();
    public function Date() {
        return $this->date;
    }
    public function SetDate($date) {
        $this->date = $date;
    }
    public function Name() {
        return $this->name;
    }
    public function SetName($name) {
        if (mb_strlen($name) > 256) {
            throw new Exception("Name too long: " . mb_strlen($name) . ". Max length is 256: " . $name);
        }
        if ($name <> strip_tags($name)) {
            throw new Exception("Name contains html: " . $name);
        }
        $this->name = $name;
    }
    public function Description() {
        return $this->description;
    }
    public function SetDescription($description) {
        if (mb_strlen($description) > 3000) {
            throw new Exception("Description too long: " . mb_strlen($description) . ". Max length is 3000: " . $description);
        }
        $this->description = $description;
    }
    public function City() {
        return $this->city;
    }
    public function SetCity($city) {
        if (mb_strlen($city) > 128) {
            throw new Exception("City too long: " . mb_strlen($city) . ". Max length is 128: " . $city);
        }
        $this->city = $city;
    }
    public function Place() {
        return $this->place;
    }
    public function SetPlace($place) {
        if (mb_strlen($place) > 128) {
            throw new Exception("Place too long: " . mb_strlen($place) . ". Max length is 128: " . $place);
        }
        $this->place = $place;
    }
    public function Address() {
        return $this->address;
    }
    public function SetAddress($address) {
        if (mb_strlen($address) > 128) {
            throw new Exception("Place too long: " . mb_strlen($address) . ". Max length is 128: " . $address);
        }
        $this->address = $address;
    }
    public function Latitude() {
        return $this->latitude;
    }
    public function SetLatitude($latitude) {
        $this->latitude = $latitude;
    }
    public function Longitude() {
        return $this->longitude;
    }
    public function SetLongitude($latitude) {
        $this->longitude = $latitude;
    }
    public function Tags() {
        return $this->tags;
    }
    public function SetTags(array $tags) {
        $this->tags = $tags;
    }
}
