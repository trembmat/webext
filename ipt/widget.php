<?


include_once($_SESSION['IPT_VARS_DIR']."_vars.php");
include_once($_SESSION['IPT_VARS_DIR']."template.php");


/*
Source: ipt/widget.php
Créer le: 2013-06-27
Par: Mathieu Tremblay

Tous droits réservés. 




Exemple d'utilisation (structure de base de données IPT par défaut):




$x = new iptWidget();
$x->Init($my_template_file,$my_rs);





*/



class iptWidget {



  var $ipt_WID_template_src;
  var $ipt_WID_recordset;
  var $ipt_WID_html;
  var $ipt_WID_js_mode;

  function iptWidget($p_template, $p_rs=null,$p_js_mode=false) {
        
        $this->ipt_WID_js_mode =$p_js_mode; 
        $this->ipt_WID_html="";
        
        if($p_template!="" && $p_rs) {
              $this->Init($p_template, $p_rs);
        }
        
        
        
  }
  
  function Init($p_template, $p_rs , $p_title="row") {
  
         //$this->ipt_WID_recordset=$p_rs;
         $tmp_template = new iptTemplate($p_template);         
         $this->ipt_WID_template = $tmp_template;
         $this->ipt_WID_recordset = $p_rs;
         
         $this->ParseData($p_title,$p_rs);
        
         
        //
  
  
  }
  
  
  function ParseData($p_string="row",$p_rs=null) {
  
      
      
      if($p_rs) { 
  
        $this->ipt_WID_recordset=$p_rs;
       
      }
     $rs2 = $this->ipt_WID_recordset; 
       
      
      $this->ipt_WID_template->Activate("<!--".$p_string."-->","<!--/".$p_string."-->");
      $this->ipt_WID_template->Explode("<!--".$p_string."-->","<!--/".$p_string."-->",$rs2->RowCount());
      
      for($i2=0;$i2<$rs2->RowCount();$i2++) {
      
           //print "Parse data ".$p_string." (".$i2.")<br>"; 
     
           $this->ParseRow($i2,$p_string);
      }   

     
      
      
  }

                
  function ParseRow($p_row,$p_string="row") {
  
      $rs2 = $this->ipt_WID_recordset;

      
      
      for($i2=0;$i2<$rs2->FieldsCount();$i2++) {
           $this->ipt_WID_template->Activate("<!--".$p_string."--><!--".$p_row."-->","<!--/".$p_row."--><!--/".$p_string."-->");
           $tmp_fieldname = $rs2->GetFieldName($i2);
           
            // print "Checking #".$i2." -FN: ".$rs2->GetFieldName($i2)." -FT: ".$rs2->GetFieldType($i2)." -FL:".$rs2->GetFieldLength($i2)."<br>\n";
            
            $my_val = $rs2->GetValue($tmp_fieldname,$p_row);
            if($rs2->GetFieldType($i2)=="string" && $rs2->GetFieldLength($i2)==8 && strlen($my_val)==8) {
                  $my_val = substr($my_val,6,2)."/".substr($my_val,4,2)."/".substr($my_val,0,4); 
            }
           $this->ipt_WID_template->Replace("<!--col-->{".$tmp_fieldname."}<!--/col-->",$my_val);
           
          
           
           //print "Row ".$p_row." Trying to replace ".$tmp_fieldname." with ".$rs2->GetValue($i2,$p_row);
      }   
      
      
      
     
  
           
             
      //$this->ipt_WID_template->Apply();
         
  }
  
  
  
  function GetHTML() {
  
    $mycontent = $this->ipt_WID_template->GetContent();
  
     if($this->ipt_WID_js_mode==true) {
        $rs2 = $this->ipt_WID_recordset;
      
  
        //$mycontent = str_replace("!--row--","",$mycontent);
        for($i2=0;$i2<$rs2->RowCount();$i2++) {
             
            
            $mycontent = str_replace("<!--row--><!--".$i2."--><!--row-->","",$mycontent); 
            $mycontent = str_replace("<!--/".$i2."--><!--/row-->","",$mycontent);  
            
        }   
  
       } 
   
       
  
    return  $mycontent; 
         
  }
  
  

  

     
}


?>