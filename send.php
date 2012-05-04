<?php
/**

This is the server-side file that handles input from the client. It
first checks the challenge-response text, and (depending) generates an
email to you.

Copyright (C) 2012 Max Galloway-Carson maxvgc@gmail.com

This file is part of WpPgpContactForm.

WpPgpContactForm is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

// load in your address from config file.
require_once('install/config.php');

// check captcha
if(validateCaptcha($_POST['challenge'])){
  // it's good; send the email
  doSend(); 

} else{
  // it's bad; send the corresponding code to client
  header("HTTP/1.0 403 Forbidden");

}

/*
 function returning a boolean to indicate whether the
 challenge-response text is correct.
*/
function validateCaptcha($captcha){           

  require_once('secImg/securimage.php');
  $securimage = new Securimage();

  return $securimage->check($captcha);
}

/*
Sends the message to you, and success/failure code to client.
*/
function doSend(){

  $result = mail($GLOBALS['recipient']
  	    , 'pgp message for you', $_POST['message']);

  if($result){
    // message sent successfully.
    header("HTTP/1.0 200 OK");

  } else{
   // something went wrong; send generic server-side error code.
   header("HTTP/1.0 500 Internal Server Error");
  }
}
?>