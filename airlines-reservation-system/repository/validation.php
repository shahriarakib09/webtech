<?php
 
 class validation{
       public function emailValidation($email){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  return false;
            }
            return true;
      }
      public function nameValidation($name){
            if (!preg_match ("/^[a-zA-z]*$/", $name) ){
                  return false;
            }  
            return true;
      }
      public function  numberValidation($number){
            if (!preg_match ("/^[0-9]*$/", $mobileno) ){  
                  return false;
            }  
            return true;
      }
}
 


?>