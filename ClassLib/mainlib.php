<?php


class mainClass{


    public function homeHeaders($apiName){

        
        // Initiate curl session in a variable (resource)
        $curl_handle = curl_init();
        
        $url = "https://mcgnapp.test/api/".$apiName;
        
        // Set the curl URL option
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        
        // This option will return data as a string instead of direct output
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        
        // Execute curl & store data in a variable
        $curl_data = curl_exec($curl_handle);
        
        curl_close($curl_handle);
        
        // Decode JSON into PHP array
        $response_data = json_decode($curl_data);

        return $response_data;
        
            }

    
    public function postAPI($apiName, $data){
            
        // $url = 'http://domain-name/endpoint-path';
        // $url = "https://mcgnapp.test/api/".$apiName;

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => $url,
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'POST',
        //   CURLOPT_POSTFIELDS => $data,
        //   CURLOPT_HTTPHEADER => array(
        //     'Accept: "application/json"'
        //   ),
        // ));
        
        // $response = curl_exec($curl);
        
        // curl_close($curl);
        // $response_data = json_decode($response);

        // return $response_data;

        






        
        // curl connection
        $ch = curl_init();
        // set curl url connection
        $curl_url = "https://mcgnapp.test/api/".$apiName;
        // pass curl url
        curl_setopt($ch, CURLOPT_URL,$curl_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        // image upload Post Fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
        // set CURL ETURN TRANSFER type
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_result = curl_exec($ch);
        curl_close($ch);
        echo $server_result;
        exit;
                }





                function callAPI($apiName, $method, $data){
                    $url = "https://mcgnapp.test/api/".$apiName;
                    $curl = curl_init();
                    switch ($method){
                       case "POST":
                          curl_setopt($curl, CURLOPT_POST, 1);
                          if ($data)
                             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                          break;
                       case "PUT":
                          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                          if ($data)
                             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                          break;
                       default:
                          if ($data)
                             $url = sprintf("%s?%s", $url, http_build_query($data));
                    }
                    // OPTIONS:
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                       'APIKEY: 111111111111111111111',
                       'Content-Type: application/json',
                    ));
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    // EXECUTE:
                    $result = curl_exec($curl);
                    if(!$result){die("Connection Failure");}
                    curl_close($curl);
                    return $result;
                 }


}