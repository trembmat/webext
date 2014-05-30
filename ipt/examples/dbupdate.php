<?
$_SESSION['IPT_VARS_DIR'] = "/home/virtuo/intranet.virtuomeuble.com/ipt/";

include($_SESSION['IPT_VARS_DIR']."_debug.php");
include('inc/header.php');

include($_SESSION['IPT_VARS_DIR']."db.php");
include($_SESSION['IPT_VARS_DIR']."dbupdate.php");


?>
<pre>
<h2>Exemple #1:</h2>
<code>

$db_link = new  iptDbLink("localhost","myusername","mypassword","dbname");
$active_db = new iptDb($db_link,"dbname");


$rs2 = new iptDbUpdate();
$rs2->Begin("gco_utilisateur","id",$_POST['id'],$active_db);

$rs2->SetValue("tprenom",$_POST['prenom'],IPT_FIELD_TYPE_TEXT);
$rs2->SetValue("tnom",$_POST['nom'],IPT_FIELD_TYPE_TEXT);
$rs2->SetValue("tnomutilisateur",$_POST['prenom'],IPT_FIELD_TYPE_TEXT);
$rs2->SetValue("bactive",$_POST['actif'],IPT_FIELD_TYPE_INT);

$rs2->Update();
      
  
?>

<h3>Résultat:</h3>
<?

$db_link = new  iptDbLink("localhost","myusername","mypassword","dbname");
$active_db = new iptDb($db_link,"dbname");


$rs2 = new iptDbUpdate();
$rs2->Begin("gco_utilisateur","id",$_POST['id'],$active_db);

$rs2->SetValue("tprenom",$_POST['prenom'],IPT_FIELD_TYPE_TEXT);
$rs2->SetValue("tnom",$_POST['nom'],IPT_FIELD_TYPE_TEXT);
$rs2->SetValue("tnomutilisateur",$_POST['prenom'],IPT_FIELD_TYPE_TEXT);
$rs2->SetValue("bactive",$_POST['actif'],IPT_FIELD_TYPE_INT);

$rs2->Update();
      
  
?>
</pre>

<?
include('inc/footer.php');

?>
