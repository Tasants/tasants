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
        $this->name = $name;
    }
    public function Description() {
        return $this->description;
    }
    public function SetDescription($description) {
        $this->description = $description;
    }
    public function City() {
        return $this->city;
    }
    public function SetCity($city) {
        $this->city = $city;
    }
    public function Place() {
        return $this->place;
    }
    public function SetPlace($place) {
        $this->place = $place;
    }
    public function Address() {
        return $this->address;
    }
    public function SetAddress($address) {
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
