<?php
/**
This is the file with html-encoded form itself.

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

/*
This function takes one parameter: the url to this file. This is
needed so that it can link to the javascript library relative to this
file.
*/
function printTheForm($urlHere){

echo <<<EOT
<!--these are the library js functions-->
<script type="text/javascript" src="$urlHere/js_lib/rsa.js"></script>
<script type="text/javascript" src="$urlHere/js_lib/aes-enc.js"></script>
<script type="text/javascript" src="$urlHere/js_lib/base64.js"></script>
<script type="text/javascript" src="$urlHere/js_lib/mouse.js"></script>
<script type="text/javascript" src="$urlHere/js_lib/PGencode.js"></script>

<!--this is the config file, where you put your pubkey info-->
<script type="text/javascript" src="$urlHere/install/config.js">
</script>

<!--this file does the encryption, and talks to sending server-->
<script type="text/javascript" src="$urlHere/encryptForm.js"></script>

    <noscript>
      <p>You need to turn on javascript. This form is completely
      usesless without it.</p>
    </noscript>

    <p>send me a secure message</p>
    <!--This first form just takes your message and encrypts it.-->
    <form name="encode" action="javascript:encrypt('text')">
      <div>
	
	<!--the message goes here -->
	<textarea id="text" rows=16 cols="90"></textarea>
	<br>
	
	<input type="submit" value="Encrypt Message">
      </div>
    </form>

    <!--
	Once submitted, the plain text will be replaced with cipher
	text. If the user hits the button again, the cipher text will
	be re-encrypted. You might want to put a message discouraging
	this.
      -->
    

    <!--This form actually does the sending, depending on the captcha.-->
    <form name="transmit" action="javascript:send('text','$urlHere'
    ,'send.php','answer')">
      <div>
	<script type="text/javascript">
	  <!--
document.write(
'<img id="siimage" src="$urlHere/secImg/securimage_show.php?sid=' 
+ Math.random()
+'" alt="This is the alt for the captcha: It does not help much.">');
	//-->
	</script>
	<br>

	<input type="text" id="answer"><!--the atttempt goes here-->
	<br>
	
	<input type="submit" value="send">
      </div>
    </form>

    <!--responses from the server will populate this div-->
    <div id="response"></div>

EOT;
}
?>