<?


define("IMS_FIELD_TYPE_DEFAULT",     0);
define("IMS_FIELD_TYPE_COMBO",     1);
define("IMS_FIELD_TYPE_TEXTAREA",     2);

define("IMS_FIELD_PARAM_NAME",     "name");
define("IMS_FIELD_PARAM_TYPE",     "type");
define("IMS_FIELD_PARAM_HIDDEN",     "hidden");
define("IMS_FIELD_PARAM_DISCARD",     "discard");
define("IMS_FIELD_PARAM_COMBO_QUERY",     "combo_query");
define("IMS_FIELD_PARAM_FORMAT",     "format");
define("IMS_FIELD_PARAM_LABEL",     "label");
define("IMS_FIELD_PARAM_DEFAULT",     "default");


       
class iptMagicScreen {
    
    var $hts_db = null;
    var $hts_class_dir = "";
    var $hts_class_name = "";
    var $hts_class_file = "";
    var $hts_object = "";
    var $hts_base_url = "";
    
    var $hts_template_form = "_custom_form.html";
    var $hts_template_list = "_custom_list.html";
    var $hts_template_dir ="";
    
    var $hts_query_list = null;
    var $hts_query_form = null;
    
    var $hts_fields_list =null;
    var $hts_fields_form =null;
    var $LastUpdatedId=0;
    
    var $hts_form_menu =array();
    
    
    
    
    function  __construct($pDb,$pClassDir,$pClassId) {
    
            //Initialisation des variables
           $this->hts_db=$pDb;
           $this->hts_class_dir=$pClassDir;
           $this->hts_class_id=$pClassId;
           $this->hts_class_file=$pClassDir.$pClassId.".php";    
           $this->hts_base_url=$_SERVER['SCRIPT_NAME'];
           
           
           //Test de la configuration
           $error="";
           if(file_exists($this->hts_class_file)) {
           
              include_once($this->hts_class_file);
              $this->class_name = substr($this->hts_class_id,0,3).strtoupper(substr($this->hts_class_id,4,1)).substr($this->hts_class_id,5);
              $this->hts_object = new $this->class_name($this->hts_db);
              if(!$this->hts_object) {
                 $error="Object ".$this->class_name." couldn't be created.";
              }
              
           } else {
             $error="Class file not found at ".$class_file.".";
           
           
           }

           if($error=="") {
            return true;
           } else {
            print $error;
            return false;
           }

    
    }
    
    
    
    
    function Init($pTemplateDir="html/") {
           global $_GET,$_POST;
           
            $this->hts_template_dir = $pTemplateDir;
             
            if(isset($_POST['id'])) {
              $new_id = $this->Save();
            }
            
            
            $my_html="";
          
            if(isset($_GET['id'])) {
              //   print "form";
              $my_html = $this->ShowForm($this->Get_Form_Template());
              
            } else {
              $_GET['id']=0;
            //print "list";
              $my_html = $this->ShowList($this->Get_List_Template());
              
            }
            
            
            
  
            $my_html = str_replace("[--title--]",$this->hts_object->hts_title,$my_html);    
            
            return $my_html;
    
    }
    
    function GetDefaultListQuery() {
    
                      $req= "";
                   $nb_fields=0;
                   foreach($this->hts_object->hts_db_params as $item => $value) {
                   
                    if($this->hts_object->hts_db_fieldstype[$item]!=IPT_FIELD_TYPE_AUTOID && $nb_fields<6) {
                        if($req!="") {
                          $req = $req." union ";
                        }
                        $req = $req."select '".$value."' as fieldname,
                                          '<!--col-->{".$value."}<!--/col-->' as value,
                        '".$this->hts_base_url."?class=".$this->hts_class_id."&id=<!--col-->{id}<!--/col-->' as turl ";
                        $nb_fields++;      
                    }
                   }
                   return $req;
                   
                   
    }
    function ShowList($pTemplate) {
        
          global $_GET,$_POST;
          
          
              //Si on a pas de requete definie par l'utilisateur on en créer par défaut
            
            if(count($this->hts_query_list)==0) {
                
                //On doit premierement obtenir la liste des colonnes
            
         
                $query_title =$this->GetDefaultListQuery();
              
                $query_data ="select '".$this->hts_base_url."?class=".$this->hts_class_id."' ybaseurl, ".$this->hts_object->hts_db_table.".*
                       from ".$this->hts_object->hts_db_table."
                       order by ".$this->hts_object->hts_db_table.".id desc
                       ";
                       
                $query_menu ="select '".$this->hts_base_url."?class=".$this->hts_class_id."&action=list' turl, 'Liste complète' ttitle union
      			           select '".$this->hts_base_url."?class=".$this->hts_class_id."&id=0' turl, 'Nouveau' ttitle
                       ";
                
                    $this->Add_List_Query($query_title,"row");
                    $this->Add_List_Query($query_title,"row_title");
                    $this->Add_List_Query($query_data,"row_data");
                    $this->Add_List_Query($query_menu,"options");
                     
            
            
            }
            
                  
       /* Liste des entregistrements */                                                                           
             
             //Ensuite on va chercher nos données a affichées
              $x = null;
             
             foreach($this->hts_query_list as $item => $value) {
                  
         //         print   $value['query']."-".$value['mark']."<br>";
                  $rs = new iptDBQuery;
            			$rs->Open($value['query'],$this->hts_db);
                  if(!isset($x)) {
                   $x = new iptWidget($pTemplate,$rs);
                  } else {			
                   $x->ParseData($value['mark'],$rs);
                  }
             
             }
           
      
      
          
            $my_html= $x->GetHTML();
            
            return $my_html;      
          
          
    }
    
    
    function ShowForm($pTemplate) {
       global $_GET,$_POST;
          
           
              $date_fields="";
                  
          $req= "";
          $reqFormat ="";
               foreach($this->hts_object->hts_db_params as $item => $value) {
                        
                if($this->hts_object->hts_db_fieldstype[$item]!=IPT_FIELD_TYPE_AUTOID) {
                
                
                    if($this->Get_Field_Param($item,IMS_FIELD_PARAM_DISCARD)!=true) {
                    
                           $pVisible='block';
                           if($this->Get_Field_Param($item,IMS_FIELD_PARAM_HIDDEN)==true) {
                            $pVisible='none';
                          }
                          
                          
                          $label=$value;
                          if($this->Get_Field_Param($item,IMS_FIELD_PARAM_LABEL)) {
                            $label=$this->Get_Field_Param($item,IMS_FIELD_PARAM_LABEL);
                          }
                           
                           //print $value." -vs- ".$label;
                           
                          if($req!="") {
                            $req = $req." union ";
                          }
                          $req = $req."select 
                                      '".$value."' as fieldname,
                           '<!--col-->{".$value."}<!--/col-->' as value,
                          '".$this->hts_base_url."?class=".$this->hts_class_id."&id=<!--col-->{id}<!--/col-->' as turl,
                          '".$pVisible."' as visibility,
                          '".$label."' as title ";
                          
                                $my_format="";
                          if($pVisible=='block') {
                          
                              $my_format="";
                              
                              if($this->Get_Field_Param($item,IMS_FIELD_PARAM_FORMAT)) {
                                 $my_format= $this->Get_Field_Param($item,IMS_FIELD_PARAM_FORMAT);
                              } else {
                              
                              
                                switch($this->hts_object->hts_db_fieldstype[$item]) {
                                    case  IPT_FIELD_TYPE_FLOAT:
                                       $my_format= "999999.9999";
                                      break;
                                   case  IPT_FIELD_TYPE_INT:
                                       $my_format= "999999";
                                      break;
                                   case  IPT_FIELD_TYPE_DATETIME:    
                                       $my_format= "00/00/0000 00:00:00";
                                       $date_fields = $date_fields.", concat(substr(".$value.",7,2),substr(".$value.",5,2),substr(".$value.",1,4),substr(".$value.",9,2),substr(".$value.",11,2),substr(".$value.",13,2)) as ".$value." ";
                                      break;                                          
                                   case  IPT_FIELD_TYPE_DATE:
                               //      $date_fields = $date_fields.", concat(substr(".$value.",7,2),substr(".$value.",5,2),substr(".$value.",1,4)) as ".$value." ";
                                  $my_format= "00/00/0000";
                                      break;                                          
                                }
                              }
                              //print "\n\nCheck format ".$my_format."<br>\n";
                              
                              if($my_format!="") {
                                    if($reqFormat!="") {
                                      $reqFormat = $reqFormat." union ";
                                    }
                                    
                                    $reqFormat = $reqFormat."select '".$value."' as fieldname,
                                                             '".addslashes($my_format)."' as mask
                                                              ";                                    
                              }
                              
                              
                          }
                          
                    }
                          
                }
               }
        
          //    print $req."<br><br>";
              
                            
              
              $rs = new iptDBQuery;
        			$rs->Open($req,$this->hts_db);
                
              //Ensuite on va chercher nos données a affichées
              if(intval($_GET['id'])==0) {
                  $rs2 = new iptDBQuery;
            
                  $myreq1="select '".$this->hts_base_url."?class=".$this->hts_class_id."' ybaseurl,0 as id";
                                        
                  $default = "";
                  foreach($this->hts_fields_form as $item => $value) {
                    if($this->Get_Field_Param($item,IMS_FIELD_PARAM_NAME)!="") {
                    
                        $default = $this->Get_Field_Param($item,IMS_FIELD_PARAM_DEFAULT);
                        $myreq1=$myreq1.", '".addslashes($default)."' as ".$this->Get_Field_Param($item,IMS_FIELD_PARAM_NAME);
                    
                    }
                  
                      
                  }
                			$rs2->Open($myreq1,$this->hts_db);  
                  
              } else {
                  $rs2 = new iptDBQuery;
                  $req2="select '".$this->hts_base_url."?class=".$this->hts_class_id."' ybaseurl ".$date_fields.", ".$this->hts_object->hts_db_table.".*
                             from ".$this->hts_object->hts_db_table."
                             where  ".$this->hts_object->hts_db_table.".id=".intval($_GET['id'])."
                             order by ".$this->hts_object->hts_db_table.".id desc
                             ";              
            			$rs2->Open($req2,$this->hts_db);
                           
              }
           
              //Puis on bati les options du menu
              
                $myreq1="select '".$this->hts_base_url."?class=".$this->hts_class_id."&action=list' turl, 'Liste complète' ttitle, '' options union
        			           select '".$this->hts_base_url."?class=".$this->hts_class_id."&id=0' turl, 'Nouveau' ttitle, '' options
                         ";
                
              //  print_r($this->hts_form_menu);       
                foreach($this->hts_form_menu as $item => $value) {
                     $myreq1 = $myreq1." union select '".addslashes($value['url'])."' turl, '".addslashes($item)."' ttitle, '".addslashes($value['options'])."' options ";
                }
              //  print $myreq1;
              
              $rs3 = new iptDBQuery;
        			$rs3->Open($myreq1,$this->hts_db);
        
              $rs4 = new iptDBQuery;
        			$rs4->Open($reqFormat,$this->hts_db);          
              //print $reqFormat;
              
               //Puis on bati la liste des combos
//               foreach($item )
             
              
                 
            
              //Generation de l'écran
              $x = new iptWidget($pTemplate,$rs);
            
                // print_r($rs2);
              $x->ParseData("row2",$rs2);
                $this->InitFormTextAreas($x); 
                $x->ParseData("fields_format",$rs4);
               
              $this->InitFormCombos($x);
               
              
              
              $x->ParseData("options",$rs3);
              $my_html= $x->GetHTML();  
              
                           
              $my_html = str_replace("<!--col-->{","",$my_html);
             $my_html = str_replace("}<!--/col-->","",$my_html);
           
                   
          
          
              return $my_html;
          
    }
    
    
    function InitFormCombos(&$pWidget) {
    
          $query_value="";
          $query_fields ="";
          // print_r($this->hts_fields_form);
          $nb=0;
       //  print_r($this->hts_fields_form);
          
      if($this->hts_fields_form) {    
        foreach($this->hts_fields_form as $item => $value) {
       // print "s".$item.":";
       // print $value;
       
      // print "<br>1:".$this->Get_Field_Param($item,IMS_FIELD_PARAM_COMBO_QUERY);
     //  print "<br>2:".$this->Get_Field_Param($item,IMS_FIELD_PARAM_NAME);
           
            
            
            if($this->Get_Field_Param($item,IMS_FIELD_PARAM_COMBO_QUERY)!=null && $this->Get_Field_Param($item,IMS_FIELD_PARAM_NAME)!=null) {
           
                $nb=$nb+1;
           
               // print $this->hts_fields_form[$item][IMS_FIELD_PARAM_NAME]."<br>\nasdijasodji";
                if($query_fields!="") {
                  $query_fields = $query_fields ." union ";
                }
                
               $query_fields = $query_fields."select '".$this->hts_fields_form[$item][IMS_FIELD_PARAM_NAME]."' fieldname";
               
                 if($query_value!="") {
                  $query_value = $query_value ." union ";
                }
                $query_value = $query_value."select '".$this->hts_fields_form[$item][IMS_FIELD_PARAM_NAME]."' fieldname, t".$nb.".* from (".$this->hts_fields_form[$item][IMS_FIELD_PARAM_COMBO_QUERY].")  t".$nb;

             }
             
           
             
        }      
      }                                                                                  
          //print "<br>".$query_fields."<br>";
 //         print $query_value;
              $rs4 = new iptDBQuery;
        			$rs4->Open($query_fields,$this->hts_db);
        			//"select 'kgco_entreprise' fieldname
                         
              //print $query_value;          
              $rs5 = new iptDBQuery;
        			$rs5->Open($query_value,$this->hts_db);
        			
        					
        			
               //"select 'kgco_entreprise' fieldname, id, replace(tnom,\"'\",\"\\\'\") tnom from gco_entreprise   order by 3  asc
                               
         
               
             $pWidget->ParseData("combo_default",$rs4);
             $pWidget->ParseData("combo_data",$rs5);
                              
             
             
    
    }
    
 
    function InitFormTextAreas(&$pWidget) {
    
          $query_txtarea="";
          // print_r($this->hts_fields_form);
          $nb=0;
       //  print_r($this->hts_fields_form);
                      
                  if($this->hts_fields_form) {    
                    foreach($this->hts_fields_form as $item => $value) {
                         
        		//	print "a".$item." (".$this->Get_Field_Param($item,IMS_FIELD_PARAM_TYPE).")<br>";   
                         if($this->Get_Field_Param($item,IMS_FIELD_PARAM_TYPE)==IMS_FIELD_TYPE_TEXTAREA) {
                         
                           
                            if($query_txtarea!="") {
                              $query_txtarea = $query_txtarea ." union ";
                            }                                                                                    
                            
                             
                       //    print_r($pWidget->ipt_WID_recordset);     
                           $query_txtarea = $query_txtarea."select '".$this->hts_fields_form[$item][IMS_FIELD_PARAM_NAME]."' fieldname, '".str_replace("'","\\\'",str_replace(chr(13),"",str_replace(chr(10),"\\\\n",addslashes($pWidget->ipt_WID_recordset->GetValue($this->hts_fields_form[$item][IMS_FIELD_PARAM_NAME],0)))))."' content";
                              
                         
                        }
                        
                       
                         
                       
                         
                    }      
                  }                                                                                  

        			
        	    $rs6 = new iptDBQuery;
        			$rs6->Open($query_txtarea,$this->hts_db);
        					
        			//print "sssssssssss".$query_txtarea;
       
         
                $pWidget->ParseData("txtarea_default",$rs6);
                                
             
             
    
    }
       
    function Save() {
            global $_GET,$_POST;
  
            /* Sauvegarde d'un enregistrement */
            
                $this->hts_object->LoadFromId(intval($_POST['id']));
                
                $to_be_saved =false;
          
                 foreach($this->hts_object->hts_db_params as $item => $value) {
                 
                  if($this->hts_object->hts_db_fieldstype[$item]!=IPT_FIELD_TYPE_AUTOID) {
          
                        if(isset($_POST[$value])) {
                            $newval = $_POST[$value];
                            if($this->hts_object->hts_db_fieldstype[$item]==IPT_FIELD_TYPE_TEXT || $this->hts_object->hts_db_fieldstype[$item]==IPT_FIELD_TYPE_HTML) {
                              $newval = addslashes($newval);
                            }
                            if($this->hts_object->hts_db_fieldstype[$item]==IPT_FIELD_TYPE_DATE ) {
                               if(strlen($newval)==10) {
                               $newval = substr($newval,6,4).substr($newval,3,2).substr($newval,0,2);
                               }
                          
                                
                            
                            }
                            if($this->hts_object->hts_db_fieldstype[$item]==IPT_FIELD_TYPE_DATETIME ) {
                               if(strlen($newval)==16) {
                                    $newval = substr($newval,6,4).substr($newval,3,2).substr($newval,0,2).substr($newval,11,2).substr($newval,14,2)."00";
                                }
                                   if(strlen($newval)==19) {
                                    $newval = substr($newval,6,4).substr($newval,3,2).substr($newval,0,2).substr($newval,11,2).substr($newval,14,2).substr($newval,17,2);
                                }  
                            
                            }                            
                            
                           $this->hts_object->SetParam($item,$newval);
                           $to_be_saved =true;
                        }
                        
                         
                  }
                 }
          
                if($to_be_saved) {  
                    $new_id = $this->hts_object->Save();
                    $this->LastUpdatedId  =$new_id;
                    return $new_id;                                                                       
                
                 } else {
                  return false;
                 }
                     
                           
    }
    
    
    function Set_List_Template($pTemplateFile) {
  //    var $hts_template_form = "_custom_form.html";
          $this->hts_template_list = $pTemplateFile;
  
    }  
    
    
   function Set_Form_Template($pTemplateFile) {
  //    var $hts_template_form = "_custom_form.html";
          $this->hts_template_form = $pTemplateFile;
  
    }      
    
   function Get_Form_Template() {
   
        $pTemplateFile = $this->hts_template_form;
        if(substr($pTemplateFile,0,1)!="/") {
            $pTemplateFile = $this->hts_template_dir.$pTemplateFile;
          }
        
        return   $pTemplateFile;
        
   } 
    
        
  
   function Get_List_Template() {
   
        $pTemplateFile = $this->hts_template_list;
        if(substr($pTemplateFile,0,1)!="/") {
            $pTemplateFile = $this->hts_template_dir.$pTemplateFile;
          }
          
          return   $pTemplateFile;
    
   }                     
   
   function Set_List_Querys($pQuerys) {
   //object $pQuery should be like:
   //
   //  $myQuery  = array(array('select * from table1','row'),array('select * from table2','row2'));
   //
   //
   
       $this->hts_query_list = null;
       //$this->hts_query_form = null;
       foreach($pQuerys as $item=>$value) {
       
          
          //    print_r($value);
         
          if($value[0]!="") {
              $this->Add_List_Query($value[0],$value[1]);        
          }
       }
       
   }
   
   function Add_List_Query($pQuery,$pMark) {
   
      
      $nb = count($this->hts_query_list);
      $this->hts_query_list[$nb]['query'] = $pQuery;
      $this->hts_query_list[$nb]['mark'] = $pMark;
   
    

   }
   
   function Set_Field_Param($pField,$pParam,$pValue) {
      //$pParams = array( IMS_FIELD_PARAM_NAME => '',
      //                  IMS_FIELD_PARAM_TYPE => IMS_FIELD_TYPE_COMBO,
      //                            )
      
      if(!$this->hts_fields_form) {
        $this->hts_fields_form=Array();
      }
      if(array_key_exists($pField,$this->hts_fields_form)) {
      
      } else {
       $this->hts_fields_form[$pField]=Array();
      
      }
      $this->hts_fields_form[$pField][$pParam] = $pValue;
      
   }
          

       
   function Set_Field_Params($pField,$pParams) {
      //$pParams = array( IMS_FIELD_PARAM_NAME => '',
      //                  IMS_FIELD_PARAM_TYPE => IMS_FIELD_TYPE_COMBO,
      //                            )
      
      
      $this->hts_fields_form[$pField] = $pParams;
      
   }
   
   
   function Get_Field_Param($pField,$pParam) {
      //$pParams = array( IMS_FIELD_PARAM_NAME => '',
      //                  IMS_FIELD_PARAM_TYPE => IMS_FIELD_TYPE_COMBO,
      //                            )
     
   //  print "Cjheck:".$pField.";".$pParam.";"; 
      $my_val=null;
      if($this->hts_fields_form) {
        if(array_key_exists($pField,$this->hts_fields_form)) {
         
          $myarr=$this->hts_fields_form[$pField];
            
            if(array_key_exists($pParam,$myarr)) {
            //print "FART2(".$pParam.")";
            //print_r($myarr);
                $my_val=$myarr[$pParam];
            }
        }
      }
      //print ";".$my_val."!";
      return $my_val;
      
   }
   
   
   function Event_ShowList_Before() {
   
   }
      
   
   
     function Add_Form_Menu($pTitle,$pUrl,$pOptions="") {
   
      $this->hts_form_menu[$pTitle] =  array();
      $this->hts_form_menu[$pTitle]['url'] = $pUrl;
      $this->hts_form_menu[$pTitle]['options'] = $pOptions;
   
  

   }
   
   
    
    
}

/***********************


$x = new iptMagicScreen($active_db,$_SESSION['BASE_DIR']."inc/classes/",$_GET['class']);
$my_html = $x->Init($_SESSION['TEMPLATES_DIR']);


**************************/
 
    


                            


 ?>