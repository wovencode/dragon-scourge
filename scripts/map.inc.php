<?php

include_once("core.php");


// ---------------------------------------------------------------------------------------
// latToY
// ---------------------------------------------------------------------------------------
function latToY($lat, $worldsize, $perpix) : int
{
	$y = 0;
	
	if ($lat >= 0) {
		$y = ceil(($worldsize - $lat) * $perpix);
	} else {
		$y = ($worldsize/2) + ceil(($lat * -1) * $perpix);
	}
	
	return $y;
}

// ---------------------------------------------------------------------------------------
// lonToX
// ---------------------------------------------------------------------------------------
function lonToX($lon, $worldsize, $perpix) : int
{
	$x = 0;
	
	if ($lon >= 0) {
		$x = ($worldsize/2) + ceil($lon * $perpix);
	} else {
		$x = ceil(($worldsize + $lon) * $perpix);
	}
	
	return $x;
}

// ---------------------------------------------------------------------------------------
// draw_map
// minimap size = 100
// map size = 250
// ---------------------------------------------------------------------------------------
function draw_map($size=500) : string
{
	
	global $worldrow, $userrow;
	
	$html = "";
	$worldsize = $worldrow["size"];
	$perpix = $size / ($worldsize * 2);
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// PLAYER
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	$lat = $userrow["latitude"];
	$lon = $userrow["longitude"];
	$x = lonToX($lon, $worldsize, $perpix);
	$y = latToY($lat, $worldsize, $perpix);
	$html .= "<img style=\"z-index: 3; position: relative; width:".$perpix."px; height:".$perpix."px; left:".($x*$perpix)."px; top:".($y*$perpix).";\" src=\"images/map/ping_blue.png\">";
	
	if ($size >= 500)
		$html .= "<div class=\"label\" style=\"z-index: 4; position: relative; left:".($x*$perpix)."px; top:".($y*$perpix).";\">".$userrow["charname"]."</div>";
		
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// MAIN QUEST
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if ($userrow["story"] > 0)
	{
		$story = dorow(doquery("SELECT * FROM <<story>> WHERE id='".$userrow["story"]."' LIMIT 1"));
		
		$lat = $story["latitude"];
		$lon = $story["longitude"];
		$x = lonToX($lon, $worldsize, $perpix);
		$y = latToY($lat, $worldsize, $perpix);
		$html .= "<img style=\"z-index: 3; position: relative; width:".$perpix."px; height:".$perpix."px; left:".($x*$perpix)."px; top:".($y*$perpix).";\" src=\"images/map/ping_purple.png\">";
		
		if ($size >= 500)
			$html .= "<div class=\"label\" style=\"z-index: 4; position: relative; left:".($x*$perpix)."px; top:".($y*$perpix).";\">".$story["title"]."</div>";
		
	}
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// TOWNS
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	$towns = dorow(doquery("SELECT * FROM <<towns>> WHERE world='".$worldrow["id"]."'"));
	
	foreach ($towns as $town)
	{
		$lat = $town["latitude"];
    	$lon = $town["longitude"];
		$x = lonToX($lon, $worldsize, $perpix);
		$y = latToY($lat, $worldsize, $perpix);
		$html .= "<img style=\"z-index: 3; position: relative; width:".$perpix."px; height:".$perpix."px; left:".($x*$perpix)."px; top:".($y*$perpix).";\" src=\"images/map/ping_town.png\">";
		
		if ($size >= 500)
			$html .= "<div class=\"label\" style=\"z-index: 4; position: relative; left:".($x*$perpix)."px; top:".($y*$perpix).";\">".$town["name"]."</div>";
	}
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// OTHER PLAYERS
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	$users = dorow(doquery("SELECT * FROM <<users>> WHERE world='".$worldrow["id"]."' AND UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."' AND id != '".$userrow["id"]."'"), "id");
	
	if (!empty($users))
	{
		foreach ($users as $user)
		{
			$lat = $user["latitude"];
			$lon = $user["longitude"];
			$x = lonToX($lon, $worldsize, $perpix);
			$y = latToY($lat, $worldsize, $perpix);	
			$html .= "<img style=\"z-index: 3; position: relative; width:".$perpix."px; height:".$perpix."px; left:".($x*$perpix)."px; top:".($y*$perpix).";\" src=\"images/map/ping_town.png\">";
			
			if ($size >= 500)
				$html .= "<div class=\"label\" style=\"z-index: 4; position: relative; left:".($x*$perpix)."px; top:".($y*$perpix).";\">".$user["charname"]."</div>";
		}

	}
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// MAP LAYOUT
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	
	$html = "<div style=\"position: relative; width:".$size."px; height:".$size."px; background-image: url(images/background.jpg); background-repeat: repeat; \">" . $html . "</div>";
	
	return $html;

}