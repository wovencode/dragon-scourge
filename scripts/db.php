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



function opendb() { // Open database connection.

    include("config.php");
    extract($dbsettings);
    $link = mysql_connect($server, $user, $pass) or err(mysql_error(),true);
    mysql_select_db($name) or err(mysql_error(),true);
    return $link;

}

function doquery($query) { // Something of a tiny little database abstraction layer.
    
    include('config.php');
    global $controlrow;
    $sqlquery = mysql_query(preg_replace('/<<([a-zA-Z0-9_\-]+)>>/', $dbsettings["prefix"].'_$1', $query));

    if ($sqlquery == false) {
        if ($controlrow["debug"] == 1) { die(mysql_error() . "<br /><br />" . $query); } else { die("A MySQL query error occurred. Please contact the game administrator for more help."); }
    }
    
    return $sqlquery;
    
}

function dorow($sqlquery, $force = "") { // Abstraction layer part deux.
    
    switch (mysql_num_rows($sqlquery)) {
        
        case 0:
            $row = false;
            break;
        case 1:
            if ($force == "") {
                $row = mysql_fetch_assoc($sqlquery);
            } else {
                $temprow = mysql_fetch_assoc($sqlquery);
                $row[$temprow[$force]] = $temprow;
            }
            break;
        default:
            if ($force == "") {
                while ($temprow = mysql_fetch_assoc($sqlquery)) {
                    $row[] = $temprow;
                }
            } else {
                while ($temprow = mysql_fetch_assoc($sqlquery)) {
                    $row[$temprow[$force]] = $temprow;
                }
            }
            break;
    
    }
        
    return $row;
    
}

?>