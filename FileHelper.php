<?php

require_once 'DatabaseController.php';

class FileHelper extends DatabaseController {

      // supported image extensions
      $supported_image = array(
          'gif',
          'jpg',
          'jpeg',
          'png'
      );
      public static function writeFile($file){
            // get the file extension
            $extension=$file->getClientOriginalExtension();
            // make it lowercase
            $extension=strtolower($extension);
            // check if it is valid
            if(!$in_array($extension,$supported_image)){
                  // if is not valid, return an error
                  $obj = new stdClass();
                  $obj->success = false;
                  $obj->error = $extension." is not an valid image type!";
                  return $obj;
            }
            // add extension to name
            $name = $name.'.'.$extension;
            // create the file
            $file->move(__DIR__.'/images', $name);
            // return an success message
            $obj = new stdClass();
            $obj->success=true;
            $obj->message="Image successfully uploaded!";
            $obj->imagePath=$name;
            return obj;
      }

      public static function generateRandomString($length) {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;
    }

}
?>
