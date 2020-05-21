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

function gettemplate($templatename) {
    
    $filename = "templates/" . $templatename . ".php";
    include("$filename");
    return $template;
    
}

function parsetemplate($template, $array) {
    
    foreach($array as $a => $b) {
        $template = str_replace("{{{$a}}}", $b, $template);
    }
    return $template;
    
}

function display($content, $panels = true) {
    
    global $controlrow, $userrow, $worldrow, $starttime;
    
    if (!isset($controlrow)) {
        $controlrow = dorow(doquery("SELECT * FROM <<control>> WHERE id='1' LIMIT 1"));
    }

    $page = gettemplate("primary");
    
    // Setup for primary page array indexes.
    $row = array();
    $row["gamename"] 	= $controlrow["gamename"];
    $row["pagetitle"] 	= $controlrow["gamename"];
    $row["background"] 	= "background" . $userrow["world"];
    $row["content"] 	= $content;
   
    if ($controlrow["forumurl"] != "") { $row["forumslink"] = "<a href=\"".$controlrow["forumurl"]."\">Support Forums</a>"; } else { $row["forumslink"] = ""; }
    
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
    
    // Finalize control array for output.
    $page = parsetemplate($page, $row); 
    
    echo $page;
    die();
}

?>