<?php

add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	 add_options_page( 'PgpContactForm options', 'PgpContactForm', 
	 'manage_options', 'PgpContactForm-options', 
	 'PgpContactForm_options' );
}

function PgpContactForm_options() {
if ( !current_user_can( 'manage_options' ) )  {
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
} else{
$url = $urlHere = plugins_url(null, __FILE__);
echo <<<EOT
<script src="$url/sha1.js" type="text/javascript"></script>
<script src="$url/../js_lib/base64.js" type="text/javascript"></script>
<script src="$url/PGpubkey.js" type="text/javascript"></script>

<script src="$url/extractKey.js" type="text/javascript"></script>
    <p>Paste public key block here.</p>
    <!--All this form needs is your public key-->
    <form name="putKey" action="javascript:getkey()">
      <div>
	
	<textarea id="pubkeyBlock" rows=14 cols=90></textarea>
	<br>

	<input type=submit value="Get Public Key Information">
      </div>
    </form>
    
    <!--the public key data will populate the following fields-->
      <div>
	Version: <input size="40" id="vers" readonly>
	<br>
	
	User ID: <input size=40 id="pkUser" readonly>
	<br>
	
	Key ID (8 bytes in hex): <input size=40 id="pKeyid" readonly>
	
	Public Key type: <input size=40 id="pktype" readonly>
	<br>
	
	Public Key value:<input size=100 id="pkey" readonly>

	<p>
	  If everything looks right, paste this info into config.js in
	  this file's directory. 
	</p>
      </div>
EOT;
}
}
?>