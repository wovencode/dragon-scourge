<?php // misc.php :: Random functions that really don't fit anywhere else.

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

function chatbox() {
    
    global $userrow, $controlrow;
    
    if (isset($_GET["g"])) {
        $guild = $userrow["guild"];
        $g = "WHERE guild='$guild'";
        $g2 = ", guild='$guild'";
        $row["guild"] = "&g=yes";
    } else {
        $g = "WHERE guild='0'";
        $row["guild"] = "";
    }
    
    if (isset($_POST["chat"])) {
        
        // Add new shout.
        if (trim($_POST["chat"]) != "") { 
            $insert = doquery("INSERT INTO <<chatbox>> SET id='', posttime=NOW(), charid='".$userrow["id"]."', charname='".$userrow["charname"]."', content='".$_POST["chat"]."' $g2");
        }
        
        // Only keep 20 shouts in DB at any one time.
        $check = doquery("SELECT * FROM <<chatbox>> $g");
        if (mysqli_num_rows($check) > 20) {
            $delete1 = dorow(doquery("SELECT id FROM <<chatbox>> $g ORDER BY id LIMIT 1"));
            $delete2 = doquery("DELETE FROM <<chatbox>> WHERE id='".$delete1["id"]."' LIMIT 1");
        }
        
        // And we're done.
        die(header("Location: index.php?do=chatbox".$row["guild"]));
        
    }
    
    $shouts = dorow(doquery("SELECT * FROM <<chatbox>> $g ORDER BY id LIMIT 20"), "id");
    $row["shouts"] = "";
    $background = 1;
    if ($shouts != false) {
        foreach ($shouts as $a => $b) {
            $row["shouts"] .= "<div class=\"chat$background\">[<a href=\"users.php?do=profile&uid=".$b["charid"]."\" target=\"_parent\">".$b["charname"]."</a>] ".$b["content"]."</div>\n";
            if ($background == 1) { $background = 2; } else { $background = 1; }
        }
    } else {
        $row["shouts"] = "<div class=\"chat$background\">No shouts.</div>";
    }

    $page = parsetemplate(gettemplate("misc_chatbox"),$row);
    
    echo $page;
    die();
    
}

function showmap() { 
    
    global $controlrow;
    
    $page = gettemplate("misc_showmap");
    
    echo $page;
    die();

}
    

?>