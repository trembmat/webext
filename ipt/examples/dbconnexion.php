<?
$_SESSION['IPT_VARS_DIR'] = "/home/virtuo/intranet.virtuomeuble.com/ipt/";

include($_SESSION['IPT_VARS_DIR']."_debug.php");
include('inc/header.php');

include($_SESSION['IPT_VARS_DIR']."dblink.php");



?>
<pre>
<h2>Exemple #1:</h2>
<code>

$x = new  iptDbLink("localhost","myusername","mypassword","dbname");
print_r($x->DbObject());

</code>
<h3>Résultat:</h3>
<?

$x = new  iptDbLink("localhost","cmb_test","Yvq7zp!tr9","cmb_test");
print_r($x->DbObject());


  
?>

</pre>

<?
include('inc/footer.php');

?>
