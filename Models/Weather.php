<?php

class Weather
{
    protected $_name, $_temperature;

    public function __construct()
    {
        if (isset($_POST["location"])) {
            $weatherGet = "";
            $weatherGet .= "http://api.openweathermap.org/data/2.5/weather?";
            $weatherGet .= "q=".$_POST["location"];
            $weatherGet .= "&appid=61ca5ce44d69d3c0db1fd1d606bd6eb0";
            $json = @file_get_contents($weatherGet);
            $obj = json_decode($json);
            if (!isset($obj->cod)) {
                $this->_name = "Location Not Found";
                $this->_temperature = "0";
            }
            else {
                //http://api.openweathermap.org/data/2.5/weather?lat=2&lon=13&appid=61ca5ce44d69d3c0db1fd1d606bd6eb0
                //echo $weatherGet;
                $this->_temperature = $obj->main->temp;
                $this->_temperature = $this->_temperature - 273;
                $this->_name = $obj->name;
                setcookie("longitude", $obj->coord->lon, time() + (86400000 * 30), "/"); // 86400 = 1 day
                setcookie("latitude", $obj->coord->lat, time() + (86400000 * 30), "/"); // 86400 = 1 day
            }
        }

        else {
            if (isset($_COOKIE["latitude"]) && $_COOKIE["longitude"]) {
                //http://api.openweathermap.org/data/2.5/weather?lat=2&lon=13&appid=61ca5ce44d69d3c0db1fd1d606bd6eb0
                $weatherGet = "";
                $weatherGet .= "http://api.openweathermap.org/data/2.5/weather?";
                $weatherGet .= "lat=" . $_COOKIE["latitude"];
                $weatherGet .= "&";
                $weatherGet .= "lon=" . $_COOKIE["longitude"];
                $weatherGet .= "&appid=61ca5ce44d69d3c0db1fd1d606bd6eb0";

                //echo $weatherGet;
                $json = @file_get_contents($weatherGet);
                $obj = json_decode($json);
                $this->_temperature = $obj->main->temp;
                $this->_temperature = $this->_temperature - 273;
                $this->_name = $obj->name;
            }
        }
    }

    public function getName() {
        return $this->_name;
    }

    public function getTemperature() {
        return $this->_temperature;
    }

}