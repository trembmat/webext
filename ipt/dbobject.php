<?
//10-04-2014 Now we keep the recorset  
define("HTS_PARAM_NAME",                   2001);
 
 
// YOU NEED TO CHANGE YOU CLASS NAME
class iptDbObject {



    var $hts_title   = "Non défini";

  
  // YOU NEED TO CHANGE THE DB TABLE NAME AND FIELDS MAPPING
   var $hts_db_table = "hts_table";
   var $hts_db_params = array (HTS_PARAM_NAME => 'tfield');
  
  

  // THESE ARE DEFAULTS VALUE FOR YOUR CLASS
  // DO NOT CHANGE THEM
  var $Recordset=null;
  
  var $hts_db = null;
  var $hts_id = 0;
  var $hts_params = null;
  
  var $hts_table = null;
  var $hts_querys = null;
  

  // YOU NEED TO CHANGE THIS FUNCTION NAME ONLY
  function __construct($pDb=null,$pId=0) {
  
     $this->LoadQuerys();
     $this->LoadFieldsConfig();    
     if($pDb!=null) {
        $this->Init($pDb,$pId);
     }
  
  }

  function Init($pDb,$pId=0) {
  

    $this->hts_db=$pDb;
    $this->CheckDBStructure();

    if($pId==0){ 

  
    } else {
    
      $this->LoadFromId($pId);
    
    }  
    
    
    
  }
  
  function LoadFromId($pId) {

      $tmp_req = "select *
                  from ".$this->hts_db_table."
                  where id = ".intval($pId)."
                  limit 1";
      
      //print $tmp_req;
                    
      $rs2 = new iptDbQuery();
      $rs2->Open($tmp_req,$this->hts_db);
      
      if($rs2->RowCount()>0) {
      
        $this->hts_id = $rs2->GetValue("id",0,IPT_FIELD_TYPE_INT);
        
        $this->LoadValuesFromRS($rs2);
        
      $this->Recordset =$rs2; 
       //$this->SetParam(HTS_TEAM_NAME,$rs2->GetValue("tnom",0,IPT_FIELD_TYPE_TEXT));
        
        return true;
        
      } else {
      
 
        $this->ResetValues();
        return false;
      }
      
      
      
      
      
         
  }
  
  function ResetValues() {
  
        $this->hts_id=0;
        $this->hts_params=null;
  
  }
  
  
  function LoadValuesFromRS($pRS) {
  
    foreach($this->hts_db_params as $item => $value) {
   
      $this->SetParam($item,$pRS->GetValue($value,0,IPT_FIELD_TYPE_TEXT));
      // print $value;

    }
  
  
  }
  
  
  
  function SetDBValues(&$pRS) {
  
    foreach($this->hts_db_params as $item => $value) {
   
      //$this->SetParam($item,$pRS->GetValue($value,0,IPT_FIELD_TYPE_TEXT));
      // print $value;
       // print "Checking...!".$value;
        
        if(substr($this->GetParam($item),0,8)=="{%file%}") {
         // print "Houston we have a file here!";
          if(substr($this->GetParam($item),8)!="") {
            $pRS->SetValue($value,substr($this->GetParam($item),8),IPT_FIELD_TYPE_FILE);
          }
        
        } else {
          $pRS->SetValue($value,$this->GetParam($item),IPT_FIELD_TYPE_TEXT);
        }
        
        
    }
  
  
  }
    
  
  
  function Save () {
  
      $this->Event_Save_Before($this->hts_id);
      
      $rs2 = new iptDbUpdate();
      $rs2->Begin($this->hts_db_table,"id",intval($this->hts_id),$this->hts_db);
      
      $this->SetDBValues($rs2);
      
//      $rs2->SetValue("tnom",$this->GetParam(HTS_TEAM_NAME),IPT_FIELD_TYPE_TEXT);
      
      
      
      $newid = $rs2->Update();
      
      if(intval($this->hts_id)==0) {
        $this->hts_id = $newid;
        
      }      
      //print  $this->hts_id;
      $this->Event_Save_After($this->hts_id);
      return $this->hts_id;
       
  
  }
  
  function Event_Save_Before($pId) {
  
  
  
  }
  
  function Event_Save_After($pId) {
        
  
  }
  
  
  
  function Delete () {
  
        if(intval($this->hts_id)>0) {

          $rs2 = new iptDbUpdate();
          $rs2->Begin($this->hts_db_table,"id",intval($this->hts_id),$this->hts_db);
          $rs2->Delete($this->hts_id); 

          $this->ResetValues();
          
          return true;

        } else {
          return false;
        }
        
          
  }
 
  
  function GetParam($pParam) {
 
     $param = $pParam;
     $value="";   
     if(isset($this->hts_params[$param])) {
      $value = $this->hts_params[$param];
    }
     
     return $value;
  
  } 

          
  
  function SetParam($pParam,$pValue,$pIsFile=false) {
  
     $param = $pParam;
      
      if($pIsFile==true) {
        $this->hts_params[$param]="{%file%}".$pValue;
      } else {
        $this->hts_params[$param]=$pValue;
      }
       //print $param.":".$pValue;
       
     
  
  }   
  
  
  


  function CheckDBStructure($pForce=false) {

      global $_SESSION;    
      
       if(!isset($_SESSION[$this->hts_db_table."_DBVERSION"])) { 
       
            $_SESSION[$this->hts_db_table."_DBVERSION"]=""; 
            
      }
         //print "HOMER"; 
      if(isset($this->hts_db_fieldstype)) {
      
            $cur_db_version = $this->hts_db_version;
            
                                
            
            if($_SESSION[$this->hts_db_table."_DBVERSION"]!=$cur_db_version || $pForce) {
                
                $db_link=$this->hts_db->ipt_DB_link;
      
                 //On doit vérifier dans notre db
                                
                 $myversion = $this->GetTableVersion($this->hts_db_table,$this->hts_db);
                 if($myversion!=$cur_db_version) {          
                                    
                      $table = new iptDbTable($this->hts_db_table);
                      $fields=null;
                                   
                      foreach($this->hts_db_fieldstype as $item => $value) {
                        $fields[count($fields)]= new iptDbField($table,$this->hts_db_params[$item],$value);
                      
                      }
      
                      $table->Create($db_link);
                     //******************************************************************************
            
            
            
                      $this->hts_table=$table;
                       $this->SetTableVersion($this->hts_db_table,$this->hts_db,$cur_db_version);    
                     
                }      
                
                
                
                
                $_SESSION[$this->hts_db_table."_DBVERSION"]=$cur_db_version;
                
                
            
                  
      
                
            }    
      
       }
       
       //print "ddddd".$_SESSION[$this->hts_db_table."_DBVERSION"]."dd";
       
  }
  
  function GetTableVersion($pTable,$pDb) {
                $z = $pDb->DbObject();

             mysql_query("CREATE TABLE IF NOT EXISTS `ipt_tables` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `tname` varchar(200) NOT NULL,
                                  `tversion` varchar(50) NOT NULL,
                                  PRIMARY KEY (`id`)
                                ) AUTO_INCREMENT=1 ;",$z);
                                        
             $rs = new iptDbQuery();
             $rs->Open("select tversion from ipt_tables where tname ='".addslashes($pTable)."'",$pDb);
        
            if($rs->RowCount()==0) {
            
                  
                    mysql_query("insert into `ipt_tables` (`tname` ,`tversion`)
                              values ('".addslashes($pTable)."','')",$z);     
                  return "";        
             
             } else {
         
                return  $rs->GetValue("tversion",0);
             }                   
                    
                                
                                
                                

  }
  
  

  function SetTableVersion($pTable,$pDb,$pVersion) {
                $z = $pDb->DbObject();

          
                                        
             $rs = new iptDbQuery();
             $rs->Open("select tversion from ipt_tables where tname ='".addslashes($pTable)."'",$pDb);
   
            if($rs->RowCount()==0) {
            
                  
                    mysql_query("insert into `ipt_tables` (`tname` ,`tversion`)
                              values ('".addslashes($pTable)."','".addslashes($pVersion)."')",$z);     
                    
             
             } else {
         
            
                    mysql_query("update `ipt_tables` set `tversion`=  '".addslashes($pVersion)."'
                              where tname = '".addslashes($pTable)."'",$z);     
                    
             }                   
                    
                                
                                
                                

  }
    
  function SetParamsFromArray($pValues) {
  
       
       foreach($pValues as $item => $value ) {
          $this->SetParam($item,$value);
       }
      
   
      
  }
  
  
  
  function AddQuery($pName,$pQuery) {
  
    if(!$this->hts_querys) {
      
       $this->hts_querys = array($pName => $pQuery);
       
    }  else {
       $this->hts_querys[$pName] = $pQuery;
    
    }
  }
  
  
  function GetQuery($pName) {
  
  
      return $this->hts_querys[$pName];
    
  }
  
   
  function LoadQuerys() {
  
  
  }
  
  function LoadFieldsConfig() {
  
  }
    

}




?>