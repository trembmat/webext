<?
$_SESSION['IPT_VARS_DIR'] = "/home/virtuo/intranet.virtuomeuble.com/ipt/";

include($_SESSION['IPT_VARS_DIR']."_debug.php");
include('inc/header.php');

include_once($_SESSION['IPT_VARS_DIR']."db.php");
//include_once($_SESSION['IPT_VARS_DIR']."db.php");
   

?>
<pre>
<h2>Exemple #1:</h2>
<code>
   

$dlink = new iptDbLink("localhost","myusername","mypassword");
$db = new iptDb($dlink,"dbname");
$db->Create();


$table = new iptDbTable("gco_contact");
$fields[count($fields)]= new iptDbField($table,"id",IPT_FIELD_TYPE_AUTOID);
$fields[count($fields)]= new iptDbField($table,"nom",IPT_FIELD_TYPE_TEXT);
$fields[count($fields)]= new iptDbField($table,"prenom",IPT_FIELD_TYPE_TEXT);
$table->Create($dlink);


</code>
<h3>Résultat:</h3>
<?

   

$dlink = new  iptDbLink("localhost","cmb_test","Yvq7zp!tr9");
$db = new iptDb($dlink,"cmb_test");
$db->Create();

$fields=null;
$table=null;



$table = new iptDbTable("gco_contact");
//$db->AddTable($table);
$fields[count($fields)]= new iptDbField($table,"id",IPT_FIELD_TYPE_AUTOID);
$fields[count($fields)]= new iptDbField($table,"nom",IPT_FIELD_TYPE_TEXT);
$fields[count($fields)]= new iptDbField($table,"prenom",IPT_FIELD_TYPE_TEXT);
$table->Create($dlink);



 
?>

<h2>Exemple #2:</h2>
<code>


$dlink = new iptDbLink("localhost","myusername","mypassword");
$db = new iptDb($dlink,"dbname");
$db->Create();

$table = new iptDbTable("gco_contact");
$x= new iptDbField($table,"id",IPT_FIELD_TYPE_AUTOID);
$x= new iptDbField($table,"nom",IPT_FIELD_TYPE_TEXT);
$x= new iptDbField($table,"prenom",IPT_FIELD_TYPE_TEXT);
$table->Create($dlink);


  


</code> 
<h3>Résultat:</h3>
<? 

$dlink = new  iptDbLink("localhost","cmb_test","Yvq7zp!tr9");
$db = new iptDb($dlink,"cmb_test");
$db->Create();
 
$table=null;
$x=null;  
 
$table = new iptDbTable("gco_contact");
$x= new iptDbField($table,"id",IPT_FIELD_TYPE_AUTOID);
$x= new iptDbField($table,"nom",IPT_FIELD_TYPE_TEXT);
$x= new iptDbField($table,"prenom",IPT_FIELD_TYPE_TEXT);
$table->Create($dlink);



  
  
  
//$db->AddTable($table);



?>

</pre>

<?
include('inc/footer.php');

?>
