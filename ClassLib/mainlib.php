<?php

   define('KB', 1024);
   define('MB', 1048576);
   define('GB', 1073741824);
   define('TB', 1099511627776);

class mainClass{


       function processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height){
        // processing image
        
        
        $target_dir = "images/uploads/headers/";
        $datetime = date("Ymdhis");
        $imageName = str_replace(' ', '', basename($name));
        $target_file = $target_dir . $datetime . $imageName;
        $flieLoc = '../../images/uploads/headers/'. $datetime . $imageName;
        $allowedExts = array("png", "PNG", "SVG", "svg,", "JPG", "jpg", "JPEG", "jpeg", "webp");
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $imageLink = 'https://mcgncms.test/'.$target_file;
        
        // if ((($type == "image/svg")
        // || ($type == "image/jpeg") ||($type == "image/png"))
        $max_height = 810;
        $max_width = 1920;
        $min_height = 800;
        $min_width = 800;

      //   DIMENSIONS CHECKER 
        if($image_height <= $max_height && $image_height >= $min_height)
        {
        
        if($size <= 2*MB)
        
          {
            if(in_array($extension, $allowedExts))
            {
          if ($error > 0)
            {
            return $error;
            }
          else
            {  
               $returnArr = array('imageLink' => $imageLink, 'tmp_name' => $tmp_name, 'fileLoc' => $flieLoc);              


            //   move_uploaded_file($tmp_name, $flieLoc);

              return $returnArr;
              
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
        

        // $url = "https://mcgnapp.test/api/".$apiName;
        $url = "http://www.massivecheerfulgiving.com/api/".$apiName;
        
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

    





    public function callAPIwImage($apiName, $method, $data){

        if(!empty(basename($_FILES["slider_img"]["name"])))
        {
        $name = $_FILES["slider_img"]["name"];
        $type = $_FILES["slider_img"]["type"];
        $size = $_FILES["slider_img"]["size"];
        $error = $_FILES["slider_img"]["error"];
        $tmp_name = $_FILES["slider_img"]["tmp_name"];
        $arr = getimagesize($_FILES["slider_img"]["tmp_name"]);

        
          
        $image_width = isset($arr[0]) ? $arr[0] : null;
        $image_height = isset($arr[1]) ? $arr[1] : null;
        $returnArr = $this->processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height);

      //   return $returnArr;

        if($returnArr == 'ext_err')
           {
            $errorMsg = 'Acceptable image extentions are: png, jpeg, jpg, svg & webp';
            return $errorMsg;

           }elseif($returnArr == 'dimension_err')
           {
            $errorMsg = 'Image height must be 810px';
            return $errorMsg;
           }elseif($returnArr == 'size_err')
           {
            $errorMsg = 'Image should not be more than 2MB in size';
            return $errorMsg;
            return $returnArr;
           }

         $data['imageLink'] = $returnArr['imageLink'];
        }

         //   array_push($data, $returnArr['imageLink']);
        
        $url = "http://www.massivecheerfulgiving.com/api/".$apiName;

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

      //   return $response_data->errors;
        if(!isset($response_data->errors)){
         if(isset($returnArr['tmp_name']) && isset($returnArr['fileLoc']))
         {
         move_uploaded_file($returnArr['tmp_name'], $returnArr['fileLoc']);
         }
         $resultArr = array('status' => true, 'message' => $response_data->message); 
         return $resultArr;
        }else{
         $resultArr = array('status' => false, 'message' => $response_data->errors); 
         return $resultArr;
        }
                
      }


      public function deleteHeaderAPI($apiName, $id){

        $url = "http://www.massivecheerfulgiving.com/api/".$apiName."/".$id;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'DELETE',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
      }


      public function APICall($apiName, $verb, $id=false,){

        $url = "http://www.massivecheerfulgiving.com/api/".$apiName."/".$id;
        // return $url;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $verb,
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $response_data = json_decode($response);
        return $response_data;
      }

}