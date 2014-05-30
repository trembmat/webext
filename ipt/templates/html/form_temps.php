


<script>

[--liste_projets_actifs_js--]

[--liste_activites_actives_js--]
</script>

<script src="ipt/templates/widgets/js/ipt.time.js"></script>
<script src="ipt/templates/widgets/js/ipt.subtable.number.js"></script>


<!--row-->
<link rel="stylesheet" type="text/css" media="screen" href="ipt/templates/html/css/forms.css">
<form id="form1" method="post"  style="display:block;">

<p style="font-size:14px;">

<input type="hidden" name="id" value="<!--col-->{id}<!--/col-->">


<label style="margin-top:10px;" >Projet : </label>
<div id="noprojet_c" style="position:relative;float:left;margin-left:80px; margin-top:-25px;border:1px solid black; height:15px;padding:5px; width:210px; text-align:center;" onclick="ShowSNPicker(document.getElementById('kgpj_projet'),document.getElementById('noprojet_c'),'Numéro du projet',lstProjetsActifs,4,4)"><!--col-->{noprojet}<!--/col--> - <!--col-->{titreprojet}<!--/col--></div>
<input type="text" name="kgpj_projet" id="kgpj_projet"  value="<!--col-->{kgpj_projet}<!--/col-->" style="display:none;"></label>
<div style="clear:both"></div>
     

<label style="margin-top:10px;">Activité : </label>
<div id="noactivite_c" style="position:relative;float:left;margin-left:80px; margin-top:-25px;border:1px solid black; height:15px;padding:5px; width:210px; text-align:center;" onclick="ShowSNPicker(document.getElementById('kgpr_activites'),document.getElementById('noactivite_c'),'Code d\'activité',lstActivitesActives,2,2)"><!--col-->{noactivite}<!--/col--> - <!--col-->{titreactivite}<!--/col--></div>
<input type="text" name="kgpr_activites" id="kgpr_activites"  value="<!--col-->{kgpr_activites}<!--/col-->" style="display:none;"></label>
<div style="clear:both"></div>








<label style="visibility:hidden;">Date: <input type="text" name="dinscrit" value="<!--col-->{dinscrit}<!--/col-->"></label>
<label>Début: 

<input type="button"  onclick="SetHr(1)" style="margin-left:10px;width:40px;height:25px;margin-top:-5px;" class="sendButton" value=">">
<div id="hrdeb_c" style="margin-top:-3px;float:right; border:1px solid black; height:20px;width:60px; text-align:center;" onclick="ShowTimePicker(document.getElementById('hrdeb'),document.getElementById('hrdeb_c'),'Heure de début')"><!--col-->{hrdeb}<!--/col--></div>
<input type="text" name="hrdeb" id="hrdeb" value="<!--col-->{hrdeb}<!--/col-->" style="display:none;"></label>



<label>Fin: 
<input type="button" onclick="SetHr(2)" style="margin-left:10px;width:40px;height:25px;" class="sendButton" value=">">
<div id="hrfin_c" style="margin-top:2px;float:right; border:1px solid black; height:20px; width:60px; text-align:center;" onclick="ShowTimePicker(document.getElementById('hrfin'),document.getElementById('hrfin_c'),'Heure de fin')"><!--col-->{hrfin}<!--/col--></div>
<input type="text" name="hrfin" id="hrfin"  value="<!--col-->{hrfin}<!--/col-->" style="display:none;"></label>



       
<label >Notes:<br>

<textarea name="remarque" style="width:300px;border:1px solid #d0d0d0"><!--col-->{tremarque}<!--/col--></textarea>
  </label>
 <div style="clear:both;padding-bottom:30px;"></div>


<label style="display:none;">Nb.Hre: <input type="text" name="nbhre" value="<!--col-->{nbhre}<!--/col-->"></label>


<label style="display:none;">Utilisateur: <input type="hidden" id="kgco_utilisateur" name="kgco_utilisateur" value="<!--col-->{kgco_utilisateur}<!--/col-->">
[--combo_utilisateur--]
</label>
   

    
<div style="clear:both;padding-bottom:30px;"></div>

<input type="submit" class="sendButton" style="margin-right:200px;padding:10px;height:40px;" value="Enregistrer">
<div style="clear:both;padding-bottom:30px;"></div>
</p>    


              
</form>
<!--/row-->              

<script>



function SetHr(type) {
     var todayDate=new Date();

var hours=todayDate.getHours();
var minutes=todayDate.getMinutes();


if (hours   < 10) { hours = '0'+hours; }  
if (minutes < 10){
    minutes = '0' + minutes;
}


   if(type==1) {
      document.getElementById('hrdeb').value= hours+':'+minutes;
      document.getElementById('hrdeb_c').innerHTML= hours+':'+minutes;
     
   } else {
      document.getElementById('hrfin').value= hours+':'+minutes;
      document.getElementById('hrfin_c').innerHTML= hours+':'+minutes;
      
    }
}





</script>
