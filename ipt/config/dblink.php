<?
//Initialisation de la connexion � la base de donn�ees
include_once($_SESSION['IPT_VARS_DIR']."db.php");
include_once($_SESSION['IPT_VARS_DIR']."dbquery.php");
include_once($_SESSION['IPT_VARS_DIR']."dbupdate.php");
$db_link = new  iptDbLink("localhost","mplus","8jsjs0kdj!!bd");
$active_db = new iptDb($db_link,"mplus");
$active_db->Create();


?>