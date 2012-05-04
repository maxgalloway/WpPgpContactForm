/**

This file will parse out your public key's information, and populate
the fields in index.html. (which you will use to fill in config.js

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

var keytyp = -1;
var keyid  = '';
var pubkey = '';

// function that does all the work
function getkey()
{
    // get public key from form
    var pu=new getPublicKey(document.getElementById('pubkeyBlock').value);

    if(pu.vers == -1) return; // fail if something is wrong

    // populate fields in index.html
    document.getElementById('vers').value=pu.vers;
    document.getElementById('pkUser').value=pu.user;
    document.getElementById('pKeyid').value=pu.keyid;

 pubkey = pu.pkey.replace(/\n/g,'');

    document.getElementById('pkey').value=pubkey;

    document.getElementById('pktype').value=pu.type;
}
