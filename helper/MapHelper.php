<?php
    namespace kab\helper;

    class MapHelper
    {
        //https://developer.mapquest.com/documentation/open/nominatim-search/search/
        private $MapQuestKey = 'WfbYABnHiYlB5G6B3UMKz8aAAMKS2Yoi';

        function calculateDistance($latSource, $longSource, $latDestination, $lonDestination): float
        {
            $EarthRadius = 6371;
            $dLat = deg2rad($latSource - $latDestination);
            $dLon = deg2rad($longSource - $lonDestination);
            $a = pow(sin($dLat/2),2) + cos(deg2rad($latSource)) * cos(deg2rad($latDestination)) * pow(sin($dLon/2),2);
            $b = 2 * atan2(sqrt($a), sqrt(1-$a));
            $c = $EarthRadius * $b;
            return $c;
        }

        function geocodeAddress($address) : ? object
        {
            $data = array(
                'key' => $this->MapQuestKey,
                'q' => $address,
                'format' => 'json'
            );

            $url = "http://open.mapquestapi.com/nominatim/v1/search.php";

            $json = $this->callAPI("GET", $url, $data);
            $array = json_decode($json);
            if($array != null && count($array) > 0)
                return $array[0];
            else
                return null;
        }

        private function callAPI($method, $url, $data = false) : string
        {
            $curl = curl_init();

            switch ($method)
            {
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);

                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                case "PUT":
                    curl_setopt($curl, CURLOPT_PUT, 1);
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
            }

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_URL, $url);            
            
            $result = curl_exec($curl);

            curl_close($curl);

            return $result;
        }
        
    }