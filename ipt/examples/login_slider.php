<?
$_SESSION['IPT_VARS_DIR'] = "/home/virtuo/intranet.virtuomeuble.com/ipt/";

include($_SESSION['IPT_VARS_DIR']."_debug.php");
include('inc/header.php');

include($_SESSION['IPT_VARS_DIR']."db.php");
include($_SESSION['IPT_VARS_DIR']."widget.php");
include($_SESSION['IPT_VARS_DIR']."dbquery.php");


?>
<pre>
<h2>Exemple #1:</h2>
<code>

$db_link = new  iptDbLink("localhost","myusername","mypassword","dbname");
$active_db = new iptDb($db_link,"dbname");

$tmp_req = "select gco_utilisateur.id, gco_utilisateur.tnom, gco_utilisateur.tprenom, gco_utilisateur.tnomutilisateur username,
                   'images/emp/1.jpg' img_url,
                   concat('login.php?id=',gco_utilisateur.id,'') login_url
            from gco_utilisateur
            left outer join gfi_piecejointe on gfi_piecejointe.isource_row=gco_utilisateur.id and  gfi_piecejointe.tsource_table='gco_utilisateur'
            order by gco_utilisateur.id
                ";

$rs2 = new iptDbQuery();
$rs2->Open($tmp_req,$active_db);     

$x = new iptWidget($_SESSION['IPT_VARS_DIR']."templates/widgets/login_slider.php",$rs2);
print $x->GetHTML();

</code>
<h3>Résultat:</h3>
<?

        /*
 
$db_link = new  iptDbLink("localhost","virtuo","Krt69!3z2c");
$active_db = new iptDb($db_link,"virtuo");


$tmp_req = "select gco_utilisateur.id, gco_utilisateur.tnom, gco_utilisateur.tprenom, gco_utilisateur.tnomutilisateur username,
                   'images/emp/1.jpg' img_url,
                   concat('login.php?id=',gco_utilisateur.id,'') login_url
            from gco_utilisateur
            left outer join gfi_piecejointe on gfi_piecejointe.isource_row=gco_utilisateur.id and  gfi_piecejointe.tsource_table='gco_utilisateur'
            order by gco_utilisateur.id
                ";

$rs2 = new iptDbQuery();
$rs2->Open($tmp_req,$active_db);     

$x = new iptWidget($_SESSION['IPT_VARS_DIR']."templates/widgets/login_slider.php",$rs2);
print $x->GetHTML();*/

      


  
?>

</pre>

<?
include('inc/footer.php');

?>
