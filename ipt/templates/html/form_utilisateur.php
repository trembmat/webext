<!--row-->
<link rel="stylesheet" type="text/css" media="screen" href="ipt/templates/html/css/forms.css">



<form id="form1" method="post" enctype="multipart/form-data" >



 
<p><a href="#" class="color-1" style="font-size:18px;">Fiche de l'utilisateur</a></p><br>
<p style="font-size:14px;">

<input type="hidden" name="id" value="<!--col-->{id}<!--/col-->">



<img src="img/user_pic.php?id=<!--col-->{id}<!--/col-->" style="border:1px solid black;max-height:150px;max-width:150px;">
<br><br>
<label>Nom: <input type="text" name="nom" value="<!--col-->{nom}<!--/col-->"></label>



<label>Prénom: <input type="text" name="prenom" value="<!--col-->{prenom}<!--/col-->"></label>

<div style="clear:both;padding-bottom:10px;"></div>
<label>Nom d'utilisateur: <input type="text" name="nomutilisateur" value="<!--col-->{nomutilisateur}<!--/col-->"></label>
<label>Mot de passe: <input type="password" name="motdepasse" value="<!--col-->{motdepasse}<!--/col-->"></label>
<label>Actif: <input type="checkbox" name="actif" value="1" <!--col-->{bactif}<!--/col-->></label>
<label>Authentification automatisée: <input type="checkbox" name="autologin" value="1" <!--col-->{bautologin}<!--/col-->></label>

<label>Photo: <input type="file" name="photo"></label>


<div style="clear:both;padding-bottom:10px;"></div>
<input type="submit" class="sendButton" value="Enregistrer">
</p>    
              
</form>
<!--/row-->              