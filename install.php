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

include_once("config/config.php");
include_once("scripts/db.inc.php");
include_once("scripts/panels.inc.php");
include_once("scripts/tpl.inc.php");

$page = "one";

if (isset($_GET["page"]))
{
	$page = $_GET["page"];
}

switch ($page)
{
    case "one": one(); break;
    case "two": two(); break;
    case "three": three(); break;
    case "four": four(); break;
    case "five": five(); break;
    default: one(); break;
}

// ---------------------------------------------------------------------------------------
// 
// ---------------------------------------------------------------------------------------
function one() {
    
    // Test file permissions.
    $botcheck = false;
    $f = fopen("images/botcheck/note.txt", "a");
    if ($f) { 
        if (fwrite($f,"note")) {
            $botcheck = true;
            fclose($f);
            unlink("images/botcheck/note.txt");
        }
    }
    $users = false;
    $f = fopen("images/users/test.txt", "a");
    if ($f) { 
        if (fwrite($f,"test")) {
            $users = true;
            fclose($f);
            unlink("images/users/test.txt");
        }
    }
    
    // Display status.
    if ($botcheck) { $botcheck = "<span style=\"color: Green;\">Pass</span>"; } else { $botcheck = "<span style=\"color: red;\">Fail</span>"; }
    if ($users) { $users = "<span style=\"color: Green;\">Pass</span>"; } else { $users = "<span style=\"color: red;\">Fail</span>"; }
    if (connectDatabase()) { $mysqlresult = "<span style=\"color: Green;\">Pass</span>"; } else { $mysqlresult = "<span style=\"color: red;\">Fail</span>"; }
    if (selectDatabase()) { $dbresult = "<span style=\"color: Green;\">Pass</span>"; } else { $dbresult = "<span style=\"color: red;\">Fail</span>"; }
    
 	display(gettemplate("install1"), false);

}

// ---------------------------------------------------------------------------------------
// 
// ---------------------------------------------------------------------------------------
function two() {
    
    $installsql = file_get_contents("install.sql");
    $status = dobatch($installsql);
    
display(gettemplate("install2"), false);

}

// ---------------------------------------------------------------------------------------
// 
// ---------------------------------------------------------------------------------------
function three() {
    
    // Path stuff. Easy.
    $gamepath = str_replace("install.php","",__FILE__);
    $gamepath = str_replace("\\","/",$gamepath);
    $avatarpath = $gamepath . "images/users/";
    $gameurl = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];
    $gameurl = str_replace("install.php","",$gameurl);
    $avatarurl = $gameurl . "images/users/";
    
display(gettemplate("install3"), false);

}

// ---------------------------------------------------------------------------------------
// 
// ---------------------------------------------------------------------------------------
function four() {
    
    // Check for errors.
    $requires = array("gamename","gamepath","gameurl","avatarpath","avatarurl","avatarmaxsize","adminemail","botcheck","pvprefresh","pvptimeout","guildstartup","guildstartlvl","guildjoinlvl","guildupdate");
    $numerics = array("avatarmaxsize","botcheck","pvprefresh","pvptimeout","guildstartup","guildstartlvl","guildjoinlvl","guildupdate");
    $toggles = array("showshout","showonline","showsigbot","verifyemail","debug");
    $errors = "";
    foreach($requires as $a => $b) {
        if (!isset($_POST[$b]) || trim($_POST[$b])=="") { $errors .= "$b field is required.<br />"; }
    }
    foreach($numerics as $a => $b) {
        if (!is_numeric($_POST[$b])) { $errors .= "$b field must contain numbers only.<br />"; }
    }
    if ($errors != "") { die("The following errors occurred. Please go back and correct these errors before continuing.<br /><br />$errors"); }
    
    // Check toggles.
    foreach($toggles as $a => $b) {
        if (!isset($_POST[$b])) { $_POST[$b] = "0"; }
    }
    
    // No errors, so set up the table.
    extract($_POST);
    doquery("INSERT INTO <<control>> SET 
        id='1',
        gamename='$gamename',
        gameopen='1',
        gamepath='$gamepath',
        gameurl='$gameurl',
        forumurl='$forumurl',
        avatarpath='$avatarpath',
        avatarurl='$avatarurl',
        avatarmaxsize='$avatarmaxsize',
        cookiename='scourge',
        cookiedomain='',
        showshout='$showshout',
        showonline='$showonline',
        showsigbot='$showsigbot',
        adminemail='$adminemail',
        verifyemail='$verifyemail',
        debug='$debug',
        botcheck='$botcheck',
        pvprefresh='$pvprefresh',
        pvptimeout='$pvptimeout',
        guildstartup='$guildstartup',
        guildstartlvl='$guildstartlvl',
        guildjoinlvl='$guildjoinlvl',
        guildupdate='$guildupdate'
        ");
        
	display(gettemplate("install4"), false);
	
}

// ---------------------------------------------------------------------------------------
// 
// ---------------------------------------------------------------------------------------
function five() {
    
    // Check for errors.
    $requires = array("username","password","emailaddress");
    $errors = "";
    foreach($requires as $a => $b) {
        if (!isset($_POST[$b]) || trim($_POST[$b])=="") { $errors .= "$b field is required.<br />"; }
    }
    if ($errors != "") { die("The following errors occurred. Please go back and correct these errors before continuing.<br /><br />$errors"); }
    
    // No errors, so set up the table.
    extract($_POST);
    $password = md5($password);
    
    doquery("INSERT INTO <<accounts>> SET 
        id='1',
        username='$username',
        password='$password',
        emailaddress='$emailaddress',
        verifycode='1',
        regdate=NOW(),
        regip='".$_SERVER["REMOTE_ADDR"]."',
        authlevel='255',
        language='English',
        characters='0',
        activechar='0'
        ");
        
	display(gettemplate("install5"), false);
	
}

?>