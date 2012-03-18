<?php

class EventData {
    private $date;
    private $end_date;
    private $name;
    private $description;
    private $country;
    private $city;
    private $place;
    private $address;
    private $latitude;
    private $longitude;
    private $link;
    private $tags = array();
    public function Date() {
        return $this->date;
    }
    public function SetDate($date) {
        $this->date = $date;
    }
    public function EndDate() {
        return $this->end_date;
    }
    public function SetEndDate($date) {
        $this->end_date = $date;
    }
    public function Name() {
        return $this->name;
    }
    public function SetName($name) {
        $name = trim($name);
        if (mb_strlen($name) == 0) {
            var_dump($this);
            throw new Exception("Give name");
        }
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
    public function Country() {
        return $this->country;
    }
    public function SetCountry($country) {
        if (mb_strlen($country) <> 2) {
            throw new Exception("Country code must be exactly to characters, like FI, SV, ... You have: " . $country);
        }
        $this->country = $country;
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
        $place = trim($place);
        if (mb_strlen($place) == "") {
            var_dump($this);
            throw new Exception("Give place.");
        }
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
    public function SetLongitude($longitude) {
        $this->longitude = $longitude;
    }
    public function Tags() {
        return $this->tags ?: array();
    }
    public function SetTags(array $tags) {
        $this->tags = $tags;
    }
    public function Link() {
        return $this->link;
    }
    public function SetLink($link) {
        $this->link = $link;
    }
}
