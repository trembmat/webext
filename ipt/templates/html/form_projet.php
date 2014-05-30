<!--row-->
<link rel="stylesheet" type="text/css" media="screen" href="ipt/templates/html/css/forms.css">
<form id="form1" method="post">
<p><a href="#" class="color-1" style="font-size:18px;">Fiche du projet</a></p><br>
<p style="font-size:14px;">

<input type="hidden" name="id" value="<!--col-->{id}<!--/col-->">

<label>Numéro: <input type="text" name="numero" value="<!--col-->{numero}<!--/col-->"></label>
<label>Client: <input type="hidden" id="kgco_entreprise" name="kgco_entreprise" value="<!--col-->{kgco_entreprise}<!--/col-->">
[--combo_entreprise--]
</label>
<label>Statut: <input type="hidden" id="kgpj_statut" name="kgpj_statut" value="<!--col-->{kgpj_statut}<!--/col-->">
[--combo_statutp--]
</label>

<div style="clear:both;padding-bottom:10px;"></div>
<label>Titre: <input type="text" name="titre" value="<!--col-->{titre}<!--/col-->"></label>
<label>Résumé: <input type="text" name="resume" value="<!--col-->{resume}<!--/col-->"></label>
<div style="clear:both;padding-bottom:10px;"></div>
<label>R1: <input type="text" name="tremarque1" value="<!--col-->{tremarque1}<!--/col-->"></label>
<label>R2: <input type="text" name="tremarque2" value="<!--col-->{tremarque2}<!--/col-->"></label>
<label>R3: <input type="text" name="tremarque3" value="<!--col-->{tremarque3}<!--/col-->"></label>
<label>R4: <input type="text" name="tremarque4" value="<!--col-->{tremarque4}<!--/col-->"></label>
<label>R5: <input type="text" name="tremarque5" value="<!--col-->{tremarque5}<!--/col-->"></label>

<label>Actif: <input type="checkbox" name="bactif" value="1" <!--col-->{actif}<!--/col-->></label>

<input type="submit" class="sendButton" value="Enregistrer">
</p>    

<br><br>

<input type="button" class="sendButton" value="Voir le budget" onclick="document.location='projets_budget.php?id=<!--col-->{id}<!--/col-->'">
              
</form>
<!--/row-->              