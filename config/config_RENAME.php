<?php

//	Dragon Scourge
//
//	Program authors: Jamin Blount
//	Copyright (C) 2007 by renderse7en
//	Script Version 1.0 Beta 5 Build 19

//	You may not distribute this program in any manner, modified or
//	otherwise, without the express, written consent from
//	renderse7en.
//
//	You may make modifications, but only for your own use and
//	within the confines of the Dragon Scourge License Agreement
//	(see our website for that).

/*
* Database Config
*/
define("DB_SERVER", 	'localhost');			// MySQL server name. (Usually localhost.)
define("DB_USER", 		'');					// MySQL username.
define("DB_PASSWORD", 	'');					// MySQL password.
define("DB_NAME", 		'');					// MySQL database name.
define("DB_PREFIX", 	'ds');					// Prefix for table names (default ds = dragon scourge).
define("DB_PORT", 		3306);
define("DB_SOCKET", 	null);

/*
* Cookie Config
*/
define("COOKIE_SALT",	'ds');					// Secret word used when hashing information for cookies.
