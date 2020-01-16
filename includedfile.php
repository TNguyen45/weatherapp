<?php

    $weather = '';
    $error = '';

    if ($_GET['city']) {

        $urlContents = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='.urlencode($_GET["city"]).'&appid=your_api_key');

        $weatherArray = json_decode($urlContents, true);

        if ($weatherArray['cod'] == 200) {

            $cityUpCase = ucwords($_GET['city']);

            $weather = "The weather in ".$cityUpCase." is currently '".$weatherArray['weather'][0]['description']."'. ";

            $tempInCelsius = round(($weatherArray['main']['temp'] - 273) * (9/5) + 32);

            $windSpeedMPH = round(($weatherArray['wind']['speed'] * 2.237), 2);

            $weather .= " The temperature is ".$tempInCelsius."&deg;F and the wind speed is ".$windSpeedMPH."mph.";

        } else {

            $error = "Could not find city - please try again.";

        }

    }

?>
