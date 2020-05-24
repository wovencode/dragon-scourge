<?php

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 20

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

$template = <<<THEVERYENDOFYOU

        <div class="main" style="width: 100%;">
        
            <h3>Dragon Scourge :: Installation (Step 4)</h3>
            <ol>
                <li>Verify Settings</li>
                <li>Install Database</li>
                <li>Primary Game Settings</li>
                <li><b>Create Admin User</b></li>
            </ol>
            
            <form action="install.php?page=five" method="post">
            <table cellspacing="0" cellpadding="5" width="98%">
            <tr><td width="25%">Username</td><td><input type="text" name="username" size="20" maxlength="30" value="" /><br /><br /></td></tr>
            <tr><td width="25%">Password</td><td><input type="text" name="password" size="20" maxlength="30" value="" /><br /><br /></td></tr>
            <tr><td width="25%">Email Address</td><td><input type="text" name="emailaddress" size="40" maxlength="200" value="$adminemail" /><br /><br /></td></tr>
            <tr><td colspan="2" style="border-top: solid 2px black;"><center>
            <input type="submit" name="submit" value="Create Admin User and Complete Installation" />
            </center></td></tr>
            </table>
            </form>
        
        </div>
   
THEVERYENDOFYOU;

?>