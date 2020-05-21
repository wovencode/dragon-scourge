<?php

// lib.php :: Common functions used throughout the program.

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


//if (file_exists("install.php")) { die("Please remove the <b>install.php</b> and <b>install.sql</b> files from your game directory before continuing."); }
//if (file_exists("install.sql")) { die("Please remove the install.php file from your game directory before continuing."); }

// Setup for superglobal stuff that can't go in globals.php.

#$link = opendb();
$version = "Beta 5";
$bnumber = "20";
$bname = "Consolation Prize Part Deux";
$bdate = "9.2.2007";
#include("lib2.php");

function gettemplate($templatename) { // SQL query for the template.
    
    $filename = "templates/" . $templatename . ".php";
    include("$filename");
    return $template;
    
}

function parsetemplate($template, $array) { // Replace template with proper content. Also does languages.
    
    foreach($array as $a => $b) {
        $template = str_replace("{{{$a}}}", $b, $template);
    }
    return $template;
    
}

function display($title, $content, $panels = true) { // Finalize page and output to browser.
    
    #include('config.php');
    global $controlrow, $userrow, $worldrow, $starttime, $version, $build;
    
    if (!isset($controlrow)) {
        $controlrow = dorow(doquery("SELECT * FROM <<control>> WHERE id='1' LIMIT 1"));
    }

    // Make page tags for XHTML validation.
    $page = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    $page .= gettemplate("primary");
    
    // Setup for primary page array indexes.
    $row = array();
    $row["gamename"] = $controlrow["gamename"];
    $row["pagetitle"] = $title;
    $row["background"] = "background" . $userrow["world"];
    $row["version"] = $version;
    $row["content"] = $content;
    $row["moddedby"] = $controlrow["moddedby"];
    if ($controlrow["forumurl"] != "") { $row["forumslink"] = "<a href=\"".$controlrow["forumurl"]."\">Support Forums</a>"; } else { $row["forumslink"] = ""; }
    
    if ($row["moddedby"] != "") {
        $row["info"] = $row["moddedby"];
    } else {
        $row["info"] = "Version <a href=\"index.php?do=version\">" . $row["version"] . "</a> ";
    }
    
    // Setup for side panels.
    #include("panels.php");
    if ($panels == true) { 
        $row["leftnav"] = panelleft(); 
        $row["rightnav"] = panelright();
        $row["topnav"] = paneltop(true);
        $row["bottomnav"] = panelbottom();
        $row["middlenav"] = panelmiddle();
    } else { 
        $row["leftnav"] = ""; 
        $row["rightnav"] = "";
        $row["topnav"] = paneltop(false);
        $row["bottomnav"] = "";
    }
    
    $page = rtrim($page, "<-!");
    
$page .= <<<THEVERYENDOFYOU
<table cellspacing="0" cellpadding="3" style="width: 95px; color: #ffffff; border: solid 1px #ffffff; background-color: #000000; margin-top: 2px;">
  <tr>
    <td width="40%">
    {{info}}
    </td>
    <td width="20%" style="text-align: center;">
    {{forumslink}}
    </td>
    <td width="40%" style="text-align:right;">
    <a href="index.php?do=version">Dragon Scourge</a> &copy; by <a href="http://www.renderse7en.com">renderse7en</a>.
    </td>
  </tr>
</table>
</center></body>
</html>
THEVERYENDOFYOU;
    
    // Finalize control array for output.
    $page = parsetemplate($page, $row); 
    
    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();
}

?>