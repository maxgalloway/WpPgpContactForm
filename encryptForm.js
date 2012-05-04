/**

This file uses a whole lot of ajax to submit the data to the server,
and interpret the error (or success) codes.

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
This function sends "message" to "server" to be sent if "answer" is
correct. The server will reply with only http status codes, so this
function will also interpret those. Note that "message" and "answer"
are not the actual values, but rather the IDs of the dom elements
containing the relevant info.
*/
    function send(message, server, sender, answer){
    // these two dom elements may be used again, so they are stored.
    var mesg = document.getElementById(message); 
    var ans = document.getElementById(answer); 

    // retrieve data from elements
    var cryptoText = mesg.value;
    var challenge = ans.value;

    // begin the ajax party
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange=function(){

	if (xmlhttp.readyState==4){// response is in...

	    // address each possible response code
	    switch(xmlhttp.status){

	    // captcha is good and message is sent
	    case 200:
		document.getElementById("response").innerHTML
		    ='message sent';

		// reset everything to prevent resubmission
		mesg.value = '';
		ans.value = '';
		reloadCaptcha(server);
		break;

	    // captcha was bad
	    case 403:
		reloadCaptcha(server);
		document.getElementById("response").innerHTML
		    ='incorrect captcha';
		
		// try again on new image
		reloadCaptcha(server);
		ans.value = '';
		break;

	    // captcha is good, but message not sent. (???)
	    default:
		document.getElementById("response").innerHTML
		    ='something went wrong, try again';
	    }
	}
    }
    
    // following code posts ciphertext and challenge to server
    xmlhttp.open("POST", server+'/'+sender, true);
    xmlhttp.setRequestHeader("Content-type",
			     "application/x-www-form-urlencoded");
    xmlhttp.send('message='+encodeURIComponent(cryptoText)
		 +'&challenge='+encodeURIComponent(challenge));
    
}

// encrypt the text from the form, and update it in place
function encrypt(text){
    var plain = document.getElementById(text).value+'\r\n';
    var cipher = doEncrypt(keyid, keytyp, pubkey, plain);
    document.getElementById(text).value = cipher;
}

// generate a new captcha
function reloadCaptcha(whereAreWe)
{
    document.getElementById('siimage').src = whereAreWe +
	'/secImg/securimage_show.php?sid=' + Math.random();
}
