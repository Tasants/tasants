<?php

class ParsingTools {
    public function Decode($string) {
        return html_entity_decode($string, null, "UTF-8");
    }
    public function UcFirst($string) {
        // @todo mb?
        return ucfirst(mb_convert_case($string, MB_CASE_LOWER));
    }
    public function CityFix($city) {
        $change = array(
                'Siikalatva' => 'Rantsila',
                'Mänttä-Vilppula' => 'Vilppula'
        );
        return (isset($change[$city])) ? $change[$city] : $city;
    }


}