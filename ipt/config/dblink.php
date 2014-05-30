<?
//Initialisation de la connexion à la base de donnéees
include_once($_SESSION['IPT_VARS_DIR']."db.php");
include_once($_SESSION['IPT_VARS_DIR']."dbquery.php");
include_once($_SESSION['IPT_VARS_DIR']."dbupdate.php");
$db_link = new  iptDbLink("localhost","mplus","8jsjs0kdj!!bd");
$active_db = new iptDb($db_link,"mplus");
$active_db->Create();


?>