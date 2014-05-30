<!--row-->
<link rel="stylesheet" type="text/css" media="screen" href="ipt/templates/html/css/forms.css">
<form id="form1" method="post">
<p><a href="#" class="color-1" style="font-size:18px;">Fiche du client</a></p><br>
<p style="font-size:14px;">

<input type="hidden" name="id" value="<!--col-->{id}<!--/col-->">

<label>Nom: <input type="text" name="tnom" value="<!--col-->{tnom}<!--/col-->"></label>
<div style="clear:both;padding-bottom:10px;"></div>
<label>Adresse: <input type="text" name="tadresse" value="<!--col-->{tadresse}<!--/col-->"></label>
<label>Ville: <input type="text" name="tville" value="<!--col-->{tville}<!--/col-->"></label>
<label>Code postal: <input type="text" name="tcodepostal" value="<!--col-->{tcodepostal}<!--/col-->"></label>
<label>Province: <input type="text" name="tprovince" value="<!--col-->{tprovince}<!--/col-->"></label>
<div style="clear:both;padding-bottom:10px;"></div>
<label>Téléphone: <input type="text" name="ttelephone" value="<!--col-->{ttelephone}<!--/col-->"></label>
<label>Télécopieur: <input type="text" name="ttelecopieur" value="<!--col-->{ttelecopieur}<!--/col-->"></label>
<label>Site web: <input type="text" name="tsiteweb" value="<!--col-->{tsiteweb}<!--/col-->"></label>

<div style="clear:both;padding-bottom:10px;"></div>
<input type="submit" class="sendButton" value="Enregistrer">
</p>    
              
</form>
<!--/row-->              