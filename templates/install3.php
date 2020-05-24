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
        
            <h3>Dragon Scourge :: Installation (Step 3)</h3>
            <ol>
                <li>Verify Settings</li>
                <li>Install Database</li>
                <li><b>Primary Game Settings</b></li>
                <li>Create Admin User</li>
            </ol>
            
            <form action="install.php?page=four" method="post">
            <table cellspacing="0" cellpadding="5" width="98%">
            <tr><td width="25%">Game Name</td><td><input type="text" name="gamename" size="20" maxlength="50" value="Dragon Scourge" /><br /><span class="grey">The name of your game. Used in page titles and when sending email to new users.</span><br /><br /></td></tr>
            <tr><td width="25%">Game Path</td><td><input type="text" name="gamepath" size="40" maxlength="200" value="$gamepath" /><br /><span class="grey">The full server path to your game. If you don't know this, please ask your host for assistance.</span><br /><br /></td></tr>
            <tr><td width="25%">Game URL</td><td><input type="text" name="gameurl" size="40" maxlength="200" value="$gameurl" /><br /><span class="grey">The full URL to your game.</span><br /><br /></td></tr>
            <tr><td width="25%">Forum URL</td><td><input type="text" name="forumurl" size="40" maxlength="200" value="" /><br /><span class="grey">If you have a support forum for your game, enter its URL here - otherwise leave blank to disable this link.</span><br /><br /></td></tr>
            <tr><td width="25%">Avatar Path</td><td><input type="text" name="avatarpath" size="40" maxlength="200" value="$avatarpath" /><br /><span class="grey">The full server path to your avatar uploads folder.</span><br /><br /></td></tr>
            <tr><td width="25%">Avatar URL</td><td><input type="text" name="avatarurl" size="40" maxlength="200" value="$avatarurl" /><br /><span class="grey">The full URL to your avatar uploads folder.</span><br /><br /></td></tr>
            <tr><td width="25%">Avatar Max Filesize</td><td><input type="text" name="avatarmaxsize" size="10" maxlength="10" value="15000" /><br /><span class="grey">Enter the maximum file size (in bytes) for uploaded avatars.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Show Babblebox?</td><td><input type="checkbox" name="showshout" value="1" /> Yes<br /><span class="grey">Enables the Babblebox iframe in the right panel.</span><br /><br /></td></tr>
            <tr><td width="25%">Show Who's Online?</td><td><input type="checkbox" name="showonline" value="1" /> Yes<br /><span class="grey">Enables the Who's Online listing in the right panel.</span><br /><br /></td></tr>
            <tr><td width="25%">Show SigBot URL?</td><td><input type="checkbox" name="showsigbot" value="1" /> Yes<br /><span class="grey">The SigBot allows users to display their character stats in forum signature images. This setting only controls whether SigBot URLs are displayed on the Characters page. To disable SigBot completely, remove the file <b>.htaccess</b> from your game installation folder.</span><br /><br /></td></tr>
            <tr><td width="25%">Admin's Email</td><td><input type="text" name="adminemail" size="20" maxlength="200" value="" /><br /><span class="grey">This is the game owner's email address, used when sending email to new users.</span><br /><br /></td></tr>
            <tr><td width="25%">Enable Email Functions?</td><td><input type="checkbox" name="verifyemail" value="1" /> Yes<br /><span class="grey">Sends a verification letter to anyone who registers an account, to enforce valid email addresses. Also allows users to request new passwords if they lose/forget theirs.<br /><b>NOTE:</b> Some Windows servers may have issues if their php.ini settings are improperly configured. If you're on a Windows host and get a lot of email sending errors, disable this setting or contact your host for more information.</b></span><br /><br /></td></tr>
            <tr><td width="25%">Enable Debug Info?</td><td><input type="checkbox" name="debug" value="1" /> Yes<br /><span class="grey">Displays extra information (query count & page generation time) in the footer, and displays full MySQL query errors if they occur.</span><br /><br /></td></tr>
            <tr><td width="25%">Bot Check</td><td><input type="text" name="botcheck" size="10" maxlength="10" value="255" /><br /><span class="grey">Bot Check ensures that players are human by displaying a CAPTCHA challenge form every so often (random 1 in <i>n</i> chance) during exploring. Higher numbers show the Bot Check less often, but may not be as secure. Lower numbers will show the bot check more often, but may annoy some users. Enter 0 to disable the bot check completely.<br />Range: 0 to 4294967295.<br />Recommended: 255.</span><br /><br /></td></tr>
            <tr><td width="25%">PVP Refresh Time</td><td><input type="text" name="pvprefresh" size="10" maxlength="10" value="15" /><br /><span class="grey">The amount of time (in seconds) the mini PVP frame should wait before refreshing itself to check for new data. Low numbers may cause strain on your server if you have a lot of concurrent users.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">PVP Timeout Limit</td><td><input type="text" name="pvptimeout" size="10" maxlength="10" value="45" /><br /><span class="grey">The amount of time (in seconds) it takes for someone to remain inactive and cause the PVP battle to close.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Guild Startup Cost</td><td><input type="text" name="guildstartup" size="10" maxlength="10" value="100000" /><br /><span class="grey">The amount of gold it takes for a player to start their own Guild.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Guild Start Level</td><td><input type="text" name="guildstartlvl" size="10" maxlength="10" value="35" /><br /><span class="grey">The minimum level a player must reach before being allowed to start a Guild.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Guild Join Level</td><td><input type="text" name="guildjoinlvl" size="10" maxlength="10" value="10" /><br /><span class="grey">The minimum level a player must reach before being allowed to join a Guild.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td width="25%">Guild Update Time</td><td><input type="text" name="guildupdate" size="10" maxlength="10" value="24" /><br /><span class="grey">The amount of time (in hours) before automatically recalculating Guild Honor Points.<br />Range: 0 to 4294967295.</span><br /><br /></td></tr>
            <tr><td colspan="2" style="border-top: solid 2px black;"><center>
            <input type="submit" name="submit" value="Continue to Step Four: Create Admin User" /><br />
            </center></td></tr>
            </table>
            </form>
        
        </div>
    
THEVERYENDOFYOU;

?>