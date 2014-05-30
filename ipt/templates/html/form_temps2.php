



<script src="ipt/templates/widgets/js/ipt.time.js"></script>
<script src="ipt/templates/widgets/js/ipt.subtable.number.js"></script>


<!--row-->
<link rel="stylesheet" type="text/css" media="screen" href="ipt/templates/html/css/forms.css">
<form id="form1" method="post"  style="display:block;">

<p style="font-size:14px;">

<input type="hidden" name="id" value="<!--col-->{id}<!--/col-->">


  


<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="jquery/jquery.ui.datepicker-fr.js"></script>
 
 <script>
 $(function() {
$( "#dinscrit" ).datepicker({
regional: "fr",
dateFormat: "dd/mm/yy"
});
});
</script>


                           

<label>Date: <input type="text" name="dinscrit" id="dinscrit" value="<!--col-->{dinscrit}<!--/col-->"></label> 

<label>Utilisateur: <input type="hidden" id="kgco_utilisateur" name="kgco_utilisateur" value="<!--col-->{kgco_utilisateur}<!--/col-->">
[--combo_utilisateur--]
</label>


   <div style="clear:both;padding-bottom:30px;"></div>

                  
<label >Projet: <input type="hidden" id="kgpj_projet" name="kgpj_projet" value="<!--col-->{kgpj_projet}<!--/col-->">
[--combo_projets_actifs--]
</label>
<div style="float:left"><a href="projets_budget.php?id=<!--col-->{kgpj_projet}<!--/col-->">Voir le budget du projet</a></div>


          
     


<label>Activité: <input type="hidden" id="kgpr_activites" name="kgpr_activites" value="<!--col-->{kgpr_activites}<!--/col-->">
[--combo_activites--]
</label>
    
            
    
<div style="clear:both;padding-bottom:30px;"></div>

<label>Début: 

<input type="text" name="hrdeb" id="hrdeb" value="<!--col-->{hrdeb}<!--/col-->" ></label>



<label>Fin: 


<input type="text" name="hrfin" id="hrfin"  value="<!--col-->{hrfin}<!--/col-->" onchange="document.getElementById('lblnbhre').style.visibility='hidden'"></label>




<label id="lblnbhre">Nb.Hre: <input type="text" name="nbhre" value="<!--col-->{nbhre}<!--/col-->" disabled></label>


    
    
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
