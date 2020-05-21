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


function opendb()
{

    
    $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT, DB_SOCKET) or die(mysqli_error());
    mysqli_select_db($link, DB_NAME) or die(mysqli_error());
    return $link;

}

function doquery($query) { // Something of a tiny little database abstraction layer.
    
    $link = opendb();
    
    #include('config.php');
    global $controlrow;
    
    $sqlquery = mysqli_query($link, preg_replace('/<<([a-zA-Z0-9_\-]+)>>/', DB_PREFIX .'_$1', $query));

    if ($sqlquery == false) {
        die($_SERVER["SCRIPT_NAME"] . "<br>" . mysqli_error($link) . "<br>" . $query);
    }
    
    return $sqlquery;
    
}

function getInsertId()
{
	$link = opendb();
	return mysqli_insert_id($link);
}

function dorow($sqlquery, $force = "") { // Abstraction layer part deux.
    
    switch (mysqli_num_rows($sqlquery)) {
        
        case 0:
            $row = false;
            break;
        case 1:
            if ($force == "") {
                $row = mysqli_fetch_assoc($sqlquery);
            } else {
                $temprow = mysqli_fetch_assoc($sqlquery);
                $row[$temprow[$force]] = $temprow;
            }
            break;
        default:
            if ($force == "") {
                while ($temprow = mysqli_fetch_assoc($sqlquery)) {
                    $row[] = $temprow;
                }
            } else {
                while ($temprow = mysqli_fetch_assoc($sqlquery)) {
                    $row[$temprow[$force]] = $temprow;
                }
            }
            break;
    
    }
        
    return $row;
    
}


function dobatch($sqlquery) {
    $query_split = preg_split ("/[;]+/", $sqlquery);
    foreach ($query_split as $command_line) {
        $command_line = trim($command_line);
        if ($command_line != '') {
            $query_result = doquery($command_line);
            if ($query_result == 0) {
                break;
            }
        }
    }
    return $query_result;
}

?>