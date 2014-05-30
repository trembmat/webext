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

$tmp_req="select * from gco_utilisateur";

$rs2 = new iptDbQuery();
$rs2->Open($tmp_req,$active_db);     
print $rs2->RowCount();

</code>
<h3>Résultat:</h3>
<?

$db_link = new  iptDbLink("localhost","virtuo","Krt69!3z2c");
$active_db = new iptDb($db_link,"virtuo");


$tmp_req="select * from gco_utilisateur";

$rs2 = new iptDbQuery();
$rs2->Open($tmp_req,$active_db);     
print $rs2->RowCount();


      
  
?>
<h2>Exemple #2:</h2>
<code>

$db_link = new  iptDbLink("localhost","myusername","mypassword","dbname");
$active_db = new iptDb($db_link,"dbname");

$tmp_req="select * from gco_utilisateur";

$rs2 = new iptDbQuery();
$rs2->Open($tmp_req,$active_db);     

for($i=0;$i<$rs2->RowCount();$i++) {
      for($i2=0;$i2<$rs2->FieldsCount();$i2++) {
           print $rs2->GetValue($i2,$i)."\t";
      }
      print "\n";
}   



</code>
<h3>Résultat:</h3>
<?

$db_link = new  iptDbLink("localhost","virtuo","Krt69!3z2c");
$active_db = new iptDb($db_link,"virtuo");


$tmp_req="select * from gco_utilisateur";

$rs2 = new iptDbQuery();
$rs2->Open($tmp_req,$active_db);     

for($i=0;$i<$rs2->RowCount();$i++) {
      for($i2=0;$i2<$rs2->FieldsCount();$i2++) {
           print $rs2->GetValue($i2,$i)."\t";
      }
      print "\n";
}   



      
  
?>
</pre>

<?
include('inc/footer.php');

?>
