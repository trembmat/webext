/*

<!-- Exemple de code pour implantation: -->


<script src="ipt/templates/widgets/js/ipt.time.js"></script>

<div id="hrfin_c" style="float:right; border:1px solid black; height:20px; width:60px; text-align:center;" onclick="ShowTimePicker(document.getElementById('hrfin'),document.getElementById('hrfin_c'),'Heure de fin')"><!--col-->{hrfin}<!--/col--></div>
<input type="text" name="hrfin" id="hrfin"  value="<!--col-->{hrfin}<!--/col-->" style="display:none;"></label>



<!-- Code HTML pour la fenêtre de saisie -->

<div id="myFrmTimer" style="display:none;">

<div style="padding:5px;font-size:24px;float:left;" id="curTimerTitle">Heure</div>

<div style="clear:both"></div>


<div style="margin-left:40px;padding:5px;font-size:24px;float:left;" id="curTimerHr" onclick="TimeFocus(1);">00</div>
<div style="padding:5px;font-size:24px;float:left;" id="curTimerSep">:</div>
<div style="padding:5px;font-size:24px;float:left;" id="curTimerMin" onclick="TimeFocus(2);">00</div>

<div style="clear:both"></div>
<br>


<input style="width:50px;height:50px;margin:2px;" type="button" value="1" onclick="TimePickerChr(1)">
<input style="width:50px;height:50px;margin:2px;" type="button" value="2" onclick="TimePickerChr(2)">
<input style="width:50px;height:50px;margin:2px;" type="button" value="3" onclick="TimePickerChr(3)">
<br>
<input style="width:50px;height:50px;margin:2px;" type="button" value="4" onclick="TimePickerChr(4)">
<input style="width:50px;height:50px;margin:2px;" type="button" value="5" onclick="TimePickerChr(5)">
<input style="width:50px;height:50px;margin:2px;" type="button" value="6" onclick="TimePickerChr(6)">
<br>
<input style="width:50px;height:50px;margin:2px;" type="button" value="7" onclick="TimePickerChr(7)">
<input style="width:50px;height:50px;margin:2px;" type="button" value="8" onclick="TimePickerChr(8)">
<input style="width:50px;height:50px;margin:2px;" type="button" value="9" onclick="TimePickerChr(9)">
<br>
<input style="width:50px;height:50px;margin:2px;" type="button" value="X" onclick="HideTimePicker()">
<input style="width:50px;height:50px;margin:2px;" type="button" value="0" onclick="TimePickerChr(0)">
<input style="width:50px;height:50px;margin:2px;" type="button" value="OK" onclick="SetTimePicker()">

</div>


*/


var curLabelField='';
var curValidationField='';
var curValidationId=0;
InitTimePickerHTML(); 

function InitTimePickerHTML() {

  //curTimerHTML = '';
  //Le code original indenté est plus haut en commentaire :)
  var curTimerHTML = '<div id="myFrmTimer" style="display:none;"><div style="padding:5px;font-size:24px;float:left;" id="curTimerTitle">Heure</div><div style="clear:both"></div><div style="margin-left:40px;padding:5px;font-size:24px;float:left;" id="curTimerHr" onclick="TimeFocus(1);">00</div><div style="padding:5px;font-size:24px;float:left;" id="curTimerSep">:</div><div style="padding:5px;font-size:24px;float:left;" id="curTimerMin" onclick="TimeFocus(2);">00</div><div style="clear:both"></div><br><input style="width:50px;height:50px;margin:2px;" type="button" value="1" onclick="TimePickerChr(1)"><input style="width:50px;height:50px;margin:2px;" type="button" value="2" onclick="TimePickerChr(2)"><input style="width:50px;height:50px;margin:2px;" type="button" value="3" onclick="TimePickerChr(3)"><br><input style="width:50px;height:50px;margin:2px;" type="button" value="4" onclick="TimePickerChr(4)"><input style="width:50px;height:50px;margin:2px;" type="button" value="5" onclick="TimePickerChr(5)"><input style="width:50px;height:50px;margin:2px;" type="button" value="6" onclick="TimePickerChr(6)"><br><input style="width:50px;height:50px;margin:2px;" type="button" value="7" onclick="TimePickerChr(7)"><input style="width:50px;height:50px;margin:2px;" type="button" value="8" onclick="TimePickerChr(8)"><input style="width:50px;height:50px;margin:2px;" type="button" value="9" onclick="TimePickerChr(9)"><br><input style="width:50px;height:50px;margin:2px;" type="button" value="X" onclick="HideTimePicker()"><input style="width:50px;height:50px;margin:2px;" type="button" value="0" onclick="TimePickerChr(0)"><input style="width:50px;height:50px;margin:2px;" type="button" value="OK" onclick="SetTimePicker()"></div>';  
  //codePlace.innerHTML = curTimerHTML;
   document.write(curTimerHTML);
  
} 


  


function ShowTimePicker(ctrl,cLabel,title) {
         
 //alert(title);   
 curValidationField = ctrl.id;
 curLabelField = cLabel.id;

  
 //curValidationField = ctrl.value;         
  
  ///curTimerHr
  //curTimerMin
          
 document.getElementById('curTimerTitle').innerHTML=title;
 //document.getElementById('curTimerHr').innerHTML=curValidationField.value; 

 
 document.getElementById('myFrmTimer').style.display='block';
 document.getElementById('form1').style.display='none';
                
                
                
 
 var myStr = '';
 myStr = ctrl.value;
 
 
 if(myStr.length==5) {
    var n=myStr.split(":");
  
    document.getElementById('curTimerHr').innerHTML=n[0];
    document.getElementById('curTimerMin').innerHTML=n[1];
       
    
  
   }
                  
                
 TimeFocus(1);

 
}


function TimeFocus(pId) {

  curValidationId=pId;

  document.getElementById('curTimerHr').style.backgroundColor='';
  document.getElementById('curTimerMin').style.backgroundColor='';
  
  
  var myCtrl;
  
  if(pId==1) {
    //We are working with hours
    myCtrl = document.getElementById('curTimerHr');
  }
  
  if(pId==2) {
    //We are working with minutes
    myCtrl = document.getElementById('curTimerMin');
  }
  if(myCtrl) {
    myCtrl.style.backgroundColor= '#FFCC33';
  
  } else {
    alert('Error...');
  }
  
}

function HideTimePicker() {

 document.getElementById('myFrmTimer').style.display='none';
 document.getElementById('form1').style.display='block'; 
}

function TimePickerChr(pChr) {

    var bDone=false;

  if(curValidationField!='') {

      var tmpUnit ='';
      if(curValidationId==1) {
     
         tmpUnit = document.getElementById('curTimerHr').innerHTML;
       } else if(curValidationId==2) {
          tmpUnit = document.getElementById('curTimerMin').innerHTML;


       } 
       
       
       if(tmpUnit.length==2) {
           tmpUnit = '';
       }
       if(tmpUnit.length==0 && curValidationId==1) {
         //On valide les heures.... si premier char > 2 on ajoute un 0
         if(parseInt(pChr)>2) {
            tmpUnit = '0';
         }
         
         
       }
      
        if(tmpUnit.length==0 && curValidationId==2) {
         //On valide les heures.... si premier char > 5 on ajoute un 0
         if(parseInt(pChr)>5) {
            tmpUnit = '0';
         }
         
         
       }            
         tmpUnit = tmpUnit + pChr;
         
         
       
    
      if(curValidationId==2 && bDone==false) {
        bDone=true;
        document.getElementById('curTimerMin').innerHTML = tmpUnit;
        if(tmpUnit.length==2) {
         // SetTimePicker();
           TimeFocus(1);
        }
      }
      
      
      
      if(curValidationId==1 && bDone==false) {
        bDone=true;
        document.getElementById('curTimerHr').innerHTML = tmpUnit;
        
        if(tmpUnit.length==2) {
          TimeFocus(2);
        }
      
      }
      
      
      
      
      
  }
  


}

function SetTimePicker() {
               //curTimerHr
           
               
    var cValHr = document.getElementById('curTimerHr').innerHTML;
    var cValMin = document.getElementById('curTimerMin').innerHTML;          

    if(cValHr.length==2 && cValMin.length==2) {
    
    
               
               
    document.getElementById(curValidationField).value =cValHr+':'+cValMin;
    document.getElementById(curLabelField).innerHTML =cValHr+':'+cValMin;

    HideTimePicker();
    } else {
    
      alert('Heure invalide....');
    }
    
    
}


