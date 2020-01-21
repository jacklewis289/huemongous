<?php

use Phue\Client;
use Phue\Command\SetLightState;
use Phue\Transport\Adapter\Streaming;

class LightData
{
    protected $_light, $_client;

    public function __construct() {
        $this->_client = new Client($_COOKIE["host"], $_COOKIE["username"]);
        $lights = $this->_client->getLights();
        $this->_light = $lights[$_GET["light"]];
    }

    public function getLight() {
        return $this->_light;
    }

    public function getAllLights() {
        return $this->_client->getLights();
    }

    public function setName() {
        $this->_light->setName($_POST["editName"]);
    }

    public function getName() {
        return $this->_light->getName();
    }

    public function getNameMulti($i) {
        $lights = $this->_client->getLights();
        return $lights[$i]->getName();
    }

    public function lightOff() {
        $this->_light->setOn(false);
    }

    public function lightOn() {
        $this->_light->setOn(true);
    }

    public function defaultSettings() {
        $this->_light->setName("Hue Lamp");
        $command = new SetLightState($this->_light);
        $command->hue("0")
                ->saturation("254")
                ->brightness("254");

        // Transition time (in seconds).
        // 0 for "snapping" change
        // Any other value for gradual change between current and new state
        $command->transitionTime(3);

        // Send the command
        $this->_client->sendCommand(
            $command
        );
    }

    public function setTemperatureWeather($temperature) {
        if ($temperature <= 10 ) {
            $command = new SetLightState($this->_light);
            $command->hue("46920")
                ->saturation("255")
                ->brightness("254");
            $command->transitionTime(3);
            $this->_client->sendCommand(
                $command
            );
        }
        elseif ($temperature >= 25) {
            $command = new SetLightState($this->_light);
            $command->hue("0")
                ->saturation("150")
                ->brightness("254");
            $command->transitionTime(3);
            $this->_client->sendCommand(
                $command
            );
        }
        else {
            $hue = 46920 - ((($temperature - 10)/15)*46920);

            $command = new SetLightState($this->_light);
            $command->hue($hue)
                ->saturation("150")
                ->brightness("254");
            $command->transitionTime(3);
            $this->_client->sendCommand(
                $command
            );
        }
    }

    public function testSetTemperatureWeather() {
        $temperature = 10;
        echo '<br><div class="container">';
        echo '<table class="table table-condensed table-striped table-bordered">';
        echo     '<h2>Test Data</h2>';
        echo          '<thead>';
        echo          '<tr>';
        echo              '<th>Temperature</th>';
        echo              '<th>HUE</th>';
        echo          '</tr>';
        echo          '</thead>';
        echo          '<tbody>';
        while ($temperature < 25.5) {
            if ($temperature <= 10 ) {
                echo '<tr>';
                echo     '<td>10</td>';
                echo     '<td>46920</td>';
                echo '</tr>';
            }
            elseif ($temperature >= 25) {
                echo '<tr>';
                echo     '<td>25</td>';
                echo     '<td>0</td>';
                echo '</tr>';
            }
            else {
                $hue = 46920 - ((($temperature - 10)/15)*46920);
                echo '<tr>';
                echo     '<td>'.$temperature.'</td>';
                echo     '<td>'.$hue.'</td>';
                echo '</tr>';
            }
            $temperature += 0.5;
        }
        echo         '</tbody>';
        echo      '</table>';
        echo '</div>';
        echo "Test Successful";
    }

    public function setHue() {
        $command = new SetLightState($this->_light);
        $command->hue($_POST["hue"]);

        // Transition time (in seconds).
        // 0 for "snapping" change
        // Any other value for gradual change between current and new state
        $command->transitionTime(3);

        // Send the command
        $this->_client->sendCommand(
            $command
        );
    }

    public function setBrightness() {
        $command = new SetLightState($this->_light);
        $command->brightness($_POST["brightness"]);

        // Transition time (in seconds).
        // 0 for "snapping" change
        // Any other value for gradual change between current and new state
        $command->transitionTime(3);

        // Send the command
        $this->_client->sendCommand(
            $command
        );
    }

    public function setSaturation() {
        $command = new SetLightState($this->_light);
        $command->saturation($_POST["saturation"]);

        // Transition time (in seconds).
        // 0 for "snapping" change
        // Any other value for gradual change between current and new state
        $command->transitionTime(3);

        // Send the command
        $this->_client->sendCommand(
            $command
        );
    }

    public function setXY() {
        $command = new SetLightState($this->_light);
        $command->xy($_POST["x"], $_POST["y"]);

        // Transition time (in seconds).
        // 0 for "snapping" change
        // Any other value for gradual change between current and new state
        $command->transitionTime(3);

        // Send the command
        $this->_client->sendCommand(
            $command
        );
    }

    public function setRGB() {
        $command = new SetLightState($this->_light);
        $command->rgb($_POST["red"], $_POST["green"], $_POST["blue"]);

        // Transition time (in seconds).
        // 0 for "snapping" change
        // Any other value for gradual change between current and new state
        $command->transitionTime(3);

        // Send the command
        $this->_client->sendCommand(
            $command
        );
    }

    public function quickRed() {
        $command = new SetLightState($this->_light);

        $command->hue("0")
                ->saturation("150")
                ->brightness("254");

        $command->transitionTime(3);

        $this->_client->sendCommand(
            $command
        );
    }

    public function quickGreen() {
        $command = new SetLightState($this->_light);

        $command->hue("23000")
            ->saturation("150")
            ->brightness("254");

        $command->transitionTime(3);

        $this->_client->sendCommand(
            $command
        );
    }

    public function quickBlue() {
        $command = new SetLightState($this->_light);

        $command->hue("46920")
            ->saturation("254§")
            ->brightness("254");

        $command->transitionTime(3);

        $this->_client->sendCommand(
            $command
        );
    }

    public function quickYellow() {
        $command = new SetLightState($this->_light);

        $command->hue("12000")
            ->saturation("150")
            ->brightness("254");

        $command->transitionTime(3);

        $this->_client->sendCommand(
            $command
        );
    }
}