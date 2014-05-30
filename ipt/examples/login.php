<?
$_SESSION['IPT_VARS_DIR'] = "/home/virtuo/intranet.virtuomeuble.com/ipt/";

include($_SESSION['IPT_VARS_DIR']."_debug.php");
include('inc/header.php');

include($_SESSION['IPT_VARS_DIR']."db.php");
include($_SESSION['IPT_VARS_DIR']."dbquery.php");
include($_SESSION['IPT_VARS_DIR']."userauthentification.php");

?>
<pre>
<h2>Exemple #1:</h2>
<code>
 

//Setting db connection
$dlink = new iptDbLink("localhost","myusername","mypassword");
$db = new iptDb($dlink,"dbname");


//Setting db table structure
$table = new iptDbTable("gco_utilisateur");
$y_id= new iptDbField($table,"id",IPT_FIELD_TYPE_AUTOID);
$y_nom= new iptDbField($table,"tnom",IPT_FIELD_TYPE_TEXT);
$y_prenom= new iptDbField($table,"tprenom",IPT_FIELD_TYPE_TEXT);
$y_login= new iptDbField($table,"tnomutilisateur",IPT_FIELD_TYPE_TEXT);
$y_pass= new iptDbField($table,"tmotdepasse",IPT_FIELD_TYPE_TEXT);
$y_active= new iptDbField($table,"bactive",IPT_FIELD_TYPE_INT);



//Setting fields matching
$x = new iptUserAuthentification($db,$table);
$x->AddField($y_id,$_SESSION['id'],IPT_USERAUTH_FIELDS_ID);
$x->AddField($y_login,$_POST['login'],IPT_USERAUTH_FIELDS_USERNAME);
$x->AddField($y_pass,$_POST['pass'],IPT_USERAUTH_FIELDS_PASSWORD);
$x->AddField($y_nom,$_SESSION['nom'],IPT_USERAUTH_FIELDS_EXTRA);
$x->AddField($y_prenom,$_SESSION['prenom'],IPT_USERAUTH_FIELDS_EXTRA);

$default_val= 1;
$x->AddField($y_active,$default_val,IPT_USERAUTH_FIELDS_FILTER);


if ($x->CheckLogin()) {

  //User has login successfully

   print_r($_SESSION);
} else {
  // print_r($_SESSION);
  print "Erreur dauthentification";
  //display login page
  
}


</code>
<h3>Résultat:</h3>


<?

$db_link = new  iptDbLink("localhost","virtuo","Krt69!3z2c");
$db = new iptDb($db_link,"virtuo");

//Setting db table structure
$table = new iptDbTable("gco_utilisateur");
$y_id= new iptDbField($table,"id",IPT_FIELD_TYPE_AUTOID);
$y_nom= new iptDbField($table,"tnom",IPT_FIELD_TYPE_TEXT);
$y_prenom= new iptDbField($table,"tprenom",IPT_FIELD_TYPE_TEXT);
$y_login= new iptDbField($table,"tnomutilisateur",IPT_FIELD_TYPE_TEXT);
$y_pass= new iptDbField($table,"tmotdepasse",IPT_FIELD_TYPE_TEXT);
$y_active= new iptDbField($table,"bactive",IPT_FIELD_TYPE_INT);



$login = "JFVezina";
$pass= "test";


//Setting fields matching
$x = new iptUserAuthentification($db,$table);
$x->AddField($y_id,$_SESSION['id'],IPT_USERAUTH_FIELDS_ID);
$x->AddField($y_login,$login,IPT_USERAUTH_FIELDS_USERNAME);
$x->AddField($y_pass,$pass,IPT_USERAUTH_FIELDS_PASSWORD);
$x->AddField($y_nom,$_SESSION['nom'],IPT_USERAUTH_FIELDS_EXTRA);
$x->AddField($y_prenom,$_SESSION['prenom'],IPT_USERAUTH_FIELDS_EXTRA);

$default_val= 1;
$x->AddField($y_active,$default_val,IPT_USERAUTH_FIELDS_FILTER);


if ($x->CheckLogin()) {

  //User has login successfully

   print_r($_SESSION);
} else {
  // print_r($_SESSION);
  print "Erreur dauthentification";
  //display login page
  
}


      
  
?>