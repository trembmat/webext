<?
$_SESSION['IPT_VARS_DIR'] = "/home/virtuo/intranet.virtuomeuble.com/ipt/";

include($_SESSION['IPT_VARS_DIR']."_debug.php");
include('inc/header.php');

include($_SESSION['IPT_VARS_DIR']."db.php");



?>
<pre>
<h2>Exemple #1:</h2>
<code>

$dlink = new iptDbLink("localhost","myusername","mypassword");
$db = new iptDb($dlink,"dbname");
$db->Create();

</code>
<h3>Résultat:</h3>
<?
         
$dlink = new  iptDbLink("localhost","cmb_test","Yvq7zp!tr9");
$db = new iptDb($dlink,"cmb_test");
$db->Create();



  
?>


<h2>Exemple #2:</h2>
<code>

$dlink = new iptDbLink("localhost","myusername","mypassword");
$db = new iptDb($dlink);
$db->Create("dbname");

</code>
<h3>Résultat:</h3>
<?                                

$dlink = new  iptDbLink("localhost","cmb_test","Yvq7zp!tr9");
$db = new iptDb($dlink);
$db->Create("dbname");



  
?>

</pre>

<?
include('inc/footer.php');

?>

