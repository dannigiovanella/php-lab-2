// Aktivera felrapportering
error_reporting(-1);
ini_set("display_errors", 1);


//DATABASANSLUTNING

<?php
//Uppgifter som behövs för att ansluta till databasen
//DESSA ÄR LOKALA. ÄNDRA VID PUBLICERING!!!!!!!

define("DB_HOST", "localhost");
define("DB_NAME", "bucketlist_db");
define("DB_USER", "root");
define("DB_PASS", "");