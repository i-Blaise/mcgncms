<?php

   define('KB', 1024);
   define('MB', 1048576);
   define('GB', 1073741824);
   define('TB', 1099511627776);

class mainClass{


       function processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height){
        // processing image
        
        
        $target_dir = "images/uploads/";
        $datetime = date("Ymdhis");
        $imageName = str_replace(' ', '', basename($name));
        $target_file = $target_dir . $datetime . $imageName;
        $flieLoc = '../images/uploads/'. $datetime . $imageName;
        $allowedExts = array("png", "PNG", "SVG", "svg,", "JPG", "jpg", "JPEG", "jpeg", "webp");
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        // $imageLink = 'http://localhost/dosh-cms/'.$target_file;
        $imageLink = 'http://dosh.interactivedigital.com.gh/admin/'.$target_file;
        
        // if ((($type == "image/svg")
        // || ($type == "image/jpeg") ||($type == "image/png"))
        $max_height = 1080;
        $max_width = 1920;
        $min_height = 500;
        $min_width = 800;

        if(($image_height <= $max_height && $image_height >= $min_height) && ($image_width <= $max_width && $image_width >= $min_width))
        {
        
        if($size <= 1*MB)
        
          {
            if(in_array($extension, $allowedExts))
            {
          if ($error > 0)
            {
            return $error;
            }
          else
            {                
              move_uploaded_file($tmp_name, $flieLoc);

              return $imageLink;
            //   $uploadStatus = $this->uploadHomepageSliders($data, $imageLink);
            //   if($uploadStatus == 'good'){
            //     return 'good';
            //   }else{
            //     return 'formerror';
            //   }
            // echo "Upload: " . $_FILES["slide-1"]["name"] . "<br />";
            // echo "Type: " . $_FILES["slide-1"]["type"] . "<br />";
            // echo "Size: " . ($_FILES["slide-1"]["size"] / 1024) . " Kb<br />";
            // echo "Temp file: " . $_FILES["slide-1"]["tmp_name"] . "<br />";
        
              // echo "Stored in: " . "../images/uploads/" . $_FILES["slide-1"]["name"];
              
            }
        }else{
            return "ext_err";
        }
          }
        else
          {
          return "size_err";
          // PRINT_R($_FILES["file"]["size"]);
          }
        }else{
            return "dimension_err";
        }
        

      }







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

    
    public function callAPI($apiName, $method, $data){
        $name = $_FILES["slider_img"]["name"];
        $type = $_FILES["slider_img"]["type"];
        $size = $_FILES["slider_img"]["size"];
        $error = $_FILES["slider_img"]["error"];
        $tmp_name = $_FILES["slider_img"]["tmp_name"];
        $arr = getimagesize($_FILES["slider_img"]["tmp_name"]);

        $image_width = $arr[0];
        $image_height = $arr[1];
        $slider_img_link = $this->processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height);

        if($slider_img_link == 'ext_err')
           {
             $data['slider_image'] =  $slider_img_link;
           }elseif($slider_img_link == 'file_err')
           {
              $data['slider_image'] =  $slider_img_link;
           }elseif($slider_img_link == 'dimension_err')
           {
              $data['slider_image'] =  $slider_img_link;
           }

        
        $url = "https://mcgnapp.test/api/".$apiName;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            'Accept: "application/json"'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $response_data = json_decode($response);

        return $response;
                }





               //  function callAPI($apiName, $method, $data){
               //    $name = $_FILES["slider_img"]["name"];
               //    $type = $_FILES["slider_img"]["type"];
               //    $size = $_FILES["slider_img"]["size"];
               //    $error = $_FILES["slider_img"]["error"];
               //    $tmp_name = $_FILES["slider_img"]["tmp_name"];
               //    $arr = getimagesize($_FILES["slider_img"]["tmp_name"]);
  
               //    $image_width = $arr[0];
               //    $image_height = $arr[1];
               //    $slider_img_link = $this->processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height);

               //    if($slider_img_link == 'ext_err')
               //       {
               //         $data['slider_image'] =  $slider_img_link;
               //       }elseif($slider_img_link == 'file_err')
               //       {
               //          $data['slider_image'] =  $slider_img_link;
               //       }elseif($slider_img_link == 'dimension_err')
               //       {
               //          $data['slider_image'] =  $slider_img_link;
               //       }

               //      $url = "https://mcgnapp.test/api/".$apiName;
               //      $curl = curl_init();
               //      switch ($method){
               //         case "POST":
               //            curl_setopt($curl, CURLOPT_POST, 1);
               //            if ($data)
               //               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               //            break;
               //         case "PUT":
               //            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
               //            if ($data)
               //               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
               //            break;
               //         default:
               //            if ($data)
               //               $url = sprintf("%s?%s", $url, http_build_query($data));
               //      }
               //      // OPTIONS:
               //      curl_setopt($curl, CURLOPT_URL, $url);
               //      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
               //         'APIKEY: 111111111111111111111',
               //         'Content-Type: application/json',
               //      ));
               //      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               //      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
               //      // EXECUTE:
               //      $result = curl_exec($curl);
               //      if(!$result){die("Connection Failure");}
               //      curl_close($curl);
               //      return $result;
               //   }


}