<?
$_SESSION['IPT_VARS_DIR'] = "/home/virtuo/intranet.virtuomeuble.com/ipt/";

include($_SESSION['IPT_VARS_DIR']."_debug.php");
include('inc/header.php');

include($_SESSION['IPT_VARS_DIR']."db.php");
include($_SESSION['IPT_VARS_DIR']."dbquery.php");


?>
<pre>
<h2>Exemple #1:</h2>
<code>

$db_link = new  iptDbLink("localhost","myusername","mypassword","dbname");
$active_db = new iptDb($db_link,"dbname");


      
  
?>

<h3>Résultat:</h3>
<?

$db_link = new  iptDbLink("localhost","virtuo","Krt69!3z2c");
$active_db = new iptDb($db_link,"virtuo");


      
  
?>
</pre>

<?
include('inc/footer.php');

?>
