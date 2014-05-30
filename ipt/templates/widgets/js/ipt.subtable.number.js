/*

<!-- Exemple de code pour implantation: -->


<script src="ipt/templates/widgets/js/ipt.subtable.number.js"></script>


<div id="noprojet_c" style="float:right; border:1px solid black; height:20px; width:60px; text-align:center;" onclick="ShowSNPicker(document.getElementById('hrfin'),document.getElementById('hrfin_c'),'Heure de fin')"><!--col-->{hrfin}<!--/col--></div>
<input type="text" name="kpprojet" id="kpprojet"  value="<!--col-->{kpprojet}<!--/col-->" style="display:none;"></label>







*/

var SNminChr = 4;
var SNmaxChr = 4;
var curSNList = null;
var curSNLabelField='';
var curSNValidationField='';
var curSNValidationId=0;
InitTimePickerHTML(); 

function InitTimePickerHTML() {


  
document.write('<div id="myFrmSN" style="display:none;">');

document.write('<div style="padding:5px;font-size:24px;float:left;" id="curSNTitle">Titre</div>');

document.write('<div style="clear:both"></div>');


document.write('<div style="padding:5px;font-size:24px;margin-top:10px;float:left;" id="curSNSep">#</div>');
document.write('<div style="margin-left:40px; margin-top:10px;height:30px;width:60px;border:1px solid black;padding:5px;font-size:24px;float:left;" id="curSNNumber" onclick="NumberFocus(0);"></div>');
document.write('<div style="margin-left:10px; text-align:center;margin-top:15px;height:20px;width:20px;border:1px solid black;padding:5px;font-size:24px;float:left;"  onclick="SNListLoader();">?</div>');

document.write('<div style="clear:both"></div>');
document.write('<br>');


document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="1" onclick="SNPickerChr(1)">');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="2" onclick="SNPickerChr(2)">');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="3" onclick="SNPickerChr(3)">');
document.write('<br>');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="4" onclick="SNPickerChr(4)">');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="5" onclick="SNPickerChr(5)">');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="6" onclick="SNPickerChr(6)">');
document.write('<br>   ');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="7" onclick="SNPickerChr(7)">');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="8" onclick="SNPickerChr(8)">');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="9" onclick="SNPickerChr(9)">');
document.write('<br>      ');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="X" onclick="HideSNPicker()">');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="0" onclick="SNPickerChr(0)">');
document.write('<input style="width:80px;height:80px;margin:2px;" type="button" value="OK" onclick="SetSNPicker()">');
document.write('</div>');

document.write('<div id="myFrmSNList" style="height:300px; width:100%; overflow:auto;display:none;">');



document.write('</div>');  
} 

function SNReturnFromList(id,numero) {
//alert(numero);
 document.getElementById('curSNNumber').innerHTML=numero;
      document.getElementById('myFrmSN').style.display='block';
      document.getElementById('myFrmSNList').style.display='none';     


}
  
function SNListLoader() {

  var myStr = '<div style="clear:both;margin-bottom:10px;"></div>';   
  
  var nb=0;
  curSNList.forEach(function (val, index, theArray) {
      //do stuff
      
      nb++;
      if(nb==1) {
      myStr = myStr + '<div style="border:2px solid white;overflow:hidden;margin-top:16px;width:225px;height:70px;padding:10px;float:left;cursor:pointer;margin:0px;" onclick="SNReturnFromList('+val['id']+',\''+val['numero']+'\')">'+val['label']+'</div>';
     
     } else {
      myStr = myStr + '<div  style="border:2px solid white;overflow:hidden;width:225px;height:70px;padding:10px;float:left;cursor:pointer;" onclick="SNReturnFromList('+val['id']+',\''+val['numero']+'\')">'+val['label']+'</div>';
     
     }
     // if(val['numero']==pValue) {
     
     //    curV=val;
     // }
      
      
  });


     document.getElementById('myFrmSNList').innerHTML = myStr;

      document.getElementById('myFrmSN').style.display='none';
      document.getElementById('myFrmSNList').style.display='block';



}




function ShowSNPicker(ctrl,cLabel,title,list,pmin,pmax) {

             //alert(2);


  SNminChr =pmin;
  SNmaxChr =pmax; 
document.getElementById('curSNNumber').value='';         
 //alert(title);   
 curSNValidationField = ctrl.id;
 curSNLabelField = cLabel.id; 
 curSNList=list;  
 //alert(list);
 //alert(curSNList);       
          
 document.getElementById('curSNTitle').innerHTML=title;
 //document.getElementById('curTimerHr').innerHTML=curValidationField.value; 

 
 document.getElementById('myFrmSN').style.display='block';
 document.getElementById('form1').style.display='none';





  
 var myStr = '';
 myStr = cLabel.innerHTML;
     var n=myStr.split(" ");
     
     
     if(parseInt(n[0])==0) {
     document.getElementById('curSNNumber').innerHTML='';
     } else {
     document.getElementById('curSNNumber').innerHTML=n[0];
     }
    
    






 SNFocus(1);

 
}


function SNFocus(pId) {

  curSNValidationId=pId;

  document.getElementById('curSNNumber').style.backgroundColor='#FFCC33';
  
   pId=0;
  
  var myCtrl;
  
  if(pId==0) {
    //We are working with integer numbers
    myCtrl = document.getElementById('curSNNumber');
  }
  

  if(myCtrl) {
    myCtrl.style.backgroundColor= '#FFCC33';
  
  } else {
    alert('Error...');
  }
  
}

function HideSNPicker() {

 document.getElementById('myFrmSN').style.display='none';
 document.getElementById('form1').style.display='block'; 
}

function SNPickerChr(pChr) {

    var bDone=false;
 

        tmpUnit = document.getElementById('curSNNumber').innerHTML;
       
            //  alert(tmpUnit);
              
              
       if(tmpUnit.length==SNmaxChr) {
           tmpUnit = '';
       }

      tmpUnit = tmpUnit + pChr;
      
      
      document.getElementById('curSNNumber').innerHTML=tmpUnit;
      
       if(tmpUnit.length>=SNminChr) {
           SetSNPicker();
       }   
         



}

function SetSNPicker() {
               //curTimerHr
           
               
               
    var cVal = document.getElementById('curSNNumber').innerHTML;
               

    if(cVal.length>=SNminChr) {
    
    
        //Ici on devrait valider si le numéro est bon....       


        myRetVal =SNValidateNumberFromList(cVal);
        if(myRetVal) {
        
          
  
           
                 
          document.getElementById(curSNValidationField).value =myRetVal['id'];
          document.getElementById(curSNLabelField).innerHTML =myRetVal['return'];
  
      
          HideSNPicker();
        
        }  else {
          if(cVal.length==SNmaxChr) {
    
            alert('# incorrect...');
          }
          
          
        }

        
    } else {
    
        if(cVal.length==SNmaxChr) {
    
          alert('# invalide....');
        }
    }
    
    
}



function SNValidateNumberFromList(pValue) {

  //alert('Trying to validate....');
  
  var curV = null;
  //element = null;
  
    
  curSNList.forEach(function (val, index, theArray) {
      //do stuff
      if(val['numero']==pValue) {
         curV=val;
      }
      
      
  });


 
  return curV;
  
  
}

