

<?


include('../crypt.php');


$mykey = $_POST['key'];
if($mykey=="") {
$mykey="secret";
}

$x = new iptCrypt($mykey);

if($_POST['words']!="") {
 $encrypt =$x->Encrypt($_POST['words']);
 $decrypt =$x->Decrypt($encrypt);

}





?>

<form method="post">
Words: <input type="text" name="words" value="<? print $_POST['words']; ?>"><br>
Key: <input type="text" name="key" value="<? print $mykey; ?>"><br>
Crypted: <input type="text" name="crypted" value="<? print $encrypt; ?>"><br>
DeCrypted: <input type="text" name="decripted" value="<? print $decrypt; ?>"><br>
<input type="submit">
</form>