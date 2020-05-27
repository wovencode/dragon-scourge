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
        
            <h3>Dragon Scourge :: Installation (Step 1)</h3>
            <ol>
                <li><b>Verify Settings</b></li>
                <li>Install Database</li>
                <li>Primary Game Settings</li>
                <li>Create Admin User</li>
            </ol>
            
            <table border="1">
                <tr><th colspan="2">Verify Settings</th></tr>
                <tr><td>MySQL Connection</td><td>{{mysqlresult}}</td></tr>
                <tr><td>MySQL Database</td><td>{{dbresult}}</td></tr>
                <tr><td>File Permissions: /images/users/</td><td>{{users}}</td></tr>
                <tr><td>File Permissions: /images/botcheck/</td><td>{{botcheck}}</td></tr>
            </table><br /><br />
            
            If any of the above settings display <span style="color: red;">Fail</span>, please go back and make sure everything is correct.<br /><br />
            For failures on either MySQL Connection or MySQL Database, please ensure that you have inserted the correct values for your server configuration into config.php, and make sure that the database to which you will be installing Dragon Scourge already exists on your server.<br /><br />
            For failures on either of the two File Permissions settings, make sure that the appropriate folders have been CHMODed to 0777 (on Unix/Linux servers), or are not set to read-only (on Windows servers). If you need help with this, <a href="http://www.stadtaus.com/en/tutorials/chmod-ftp-file-permissions.php" target="_new">click here</a> for tutorials on how to do this in several major FTP clients.<br /><br />
            Once you have checked all the appropriate settings, reload this page and make sure that all four tests indicate <span style="color: green;">Pass</span> before continuing.<br /><br />
            Once all tests pass, click the link below to continue to step two.<br /><br />
            
            <a href="install.php?page=two">Continue to Step Two: Install Database</a><br />
            Installing the database may take several seconds. Please click the link only once.
        
        </div>
    
THEVERYENDOFYOU;

?>