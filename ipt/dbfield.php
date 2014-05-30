<?


include_once($_SESSION['IPT_VARS_DIR']."_vars.php");
include_once($_SESSION['IPT_VARS_DIR']."dbtable.php");


/*
Source: ipt/dbstructure.php
Créer le: 2013-06-26
Par: Mathieu Tremblay

Tous droits réservés. 




Exemple d'utilisation (structure de base de données IPT par défaut):






*/



class iptDbField {


  var $ipt_DBF_table;
  var $ipt_DBF_name;
  var $ipt_DBF_type;
  var $ipt_DBF_length;
  var $ipt_DBF_default;
  
 
  
  function iptDbField(&$p_db_table=null,$p_db_fieldname="",$p_db_fieldtype,$p_length=null,$p_default=null) {
  
      $this->ipt_DBF_table = &$p_db_table;
      $this->ipt_DBF_name = $p_db_fieldname;
      $this->ipt_DBF_type = $p_db_fieldtype;
      $this->ipt_DBF_length = $p_length;
      $this->ipt_DBF_default = $p_default;
      
      if($p_db_table) {
      
        $p_db_table->AddField($this);
      }
      
      
  
  }

  
  function GetName() {
  
     return $this->ipt_DBF_name;
  }
  
  function GetLength() {
     return $this->ipt_DBF_length;
  }
  
    
  function GetType() {
  
     return $this->ipt_DBF_type;
  }
    
 function SetTable(&$p_table) {
  
     $this->ipt_DBF_table=$p_table;
     return true;
  }
 function GetTable() {
  
     return $this->ipt_DBF_table->GetName();
     
  }  
  function GetDbFieldType($p_dbtype=IPT_DB_TYPE_MYSQL,$p_update=false) {
       $tmp_type="";
       $tmp_type2="";
       $tmp_default="";
       
       switch($p_dbtype) {
       
        case IPT_DB_TYPE_MYSQL:
    
        
          switch($this->GetType()) {

                case IPT_FIELD_TYPE_AUTOID:
                  if($p_update) {
                     $tmp_type = "";
                     $tmp_type2="";
                  } else {
                    $tmp_type = "INT NOT NULL AUTO_INCREMENT";
                    $tmp_type2 = "PRIMARY KEY(".$this->GetName().")";
                  }
                  $tmp_default="";
                  break;
                  
                  
                case IPT_FIELD_TYPE_MULTILINE:
                case IPT_FIELD_TYPE_HTML:
                  $tmp_type = "LONGTEXT";
                  $tmp_default = "NOT NULL DEFAULT ''";
                  break;
                  

                  
               case IPT_FIELD_TYPE_DATETIME:
                  $tmp_type = "VARCHAR(14)";
                  $tmp_default = " NOT NULL DEFAULT  ''";
                  break;
                  
                  
               case IPT_FIELD_TYPE_FILE:
               case IPT_FIELD_TYPE_IMAGE:
                  $tmp_type = "LONGBLOB";
                  $tmp_default = "";
                  break;
                   
              case IPT_FIELD_TYPE_INT:
              case IPT_FIELD_TYPE_CHECKBOX:
                  $tmp_type = "INT";
                  $tmp_default = "NOT NULL DEFAULT 0";
                  break;

              case IPT_FIELD_TYPE_FLOAT:
              case IPT_FIELD_TYPE_MONEY:
                  $tmp_type = "FLOAT";
                  $tmp_default = "NOT NULL DEFAULT 0";
                  break;
                  
                              
              case IPT_FIELD_TYPE_DATE:
              case IPT_FIELD_TYPE_DATEPICKER:
                  $tmp_type = "VARCHAR(8)";
                  $tmp_default = " NOT NULL DEFAULT ''";
                  break;
                        
              default:
            
                  $tmp_length = $this->GetLength();
                       
                  if($tmp_length==null) {
                    $tmp_length = 255;
                  }
                  $tmp_default = "NOT NULL DEFAULT ''";
                  $tmp_type = "VARCHAR(".$tmp_length.")";
                  break;
          
          }
       
       }
       
       $tmp_out= $tmp_type;
       if($tmp_default!="") {
        $tmp_out=$tmp_out." ".$tmp_default;
       }
       if($tmp_type2!="") {
        $tmp_out= $tmp_out.", ".$tmp_type2;
       }
       
       
       
       return $tmp_out;
  
  }    
  
  

  
  
   function CreateField() {
      switch($this->ipt_DBF_table->ipt_DBT_dblink->GetType()) {
       
        case IPT_DB_TYPE_MYSQL:
        
              $tmp_query = "SELECT *
                            FROM information_schema.COLUMNS 
                            WHERE 
                                TABLE_SCHEMA = '".$this->ipt_DBF_table->ipt_DBT_dblink->GetDbName()."' 
                            AND TABLE_NAME = '".$this->ipt_DBF_table->GetName()."' 
                            AND COLUMN_NAME = '".$this->GetName()."'";
                            
                            
                $result = mysql_query($tmp_query,$this->ipt_DBF_table->ipt_DBT_dblink->DbObject());
                    // print $tmp_query;       
                if($result) {
                          
                          
                          
                       $tmp_nbrows = mysql_num_rows($result);
                       
                       //print "FOUND (".$tmp_nbrows.") --- ";
                       if($tmp_nbrows==0) {
                          //print "le champ n'existe pas...";
                          
                          $tmp_type = $this->GetDbFieldType($this->ipt_DBF_table->ipt_DBT_dblink->GetType(),false);
                          if($tmp_type) {
                              $tmp_query = "alter table ".$this->ipt_DBF_table->GetName()." add ".$this->GetName()." ".$tmp_type;
                              
                            $tmp_update = mysql_query($tmp_query,$this->ipt_DBF_table->ipt_DBT_dblink->DbObject());
                             if($tmp_update) {
                                //Le champ a été mis a jour
                                // print $tmp_query."\n";
                              } else {
                             
                                echo "#1300011  Une erreur est survenue lors de la connexion a la base de donnees... " . mysql_error($this->ipt_DBF_table->ipt_DBT_dblink->DbObject());
                                
                    
                             }
                          } else {
                            //print "Nous ne sommes pas capable d'updater ce champ.... ";
                          }
                           
                          
                           
                       } else {
                        // print "le champ existe...";
                          $tmp_type = $this->GetDbFieldType($this->ipt_DBF_table->ipt_DBT_dblink->GetType(),true);
                          if($tmp_type) {
                              $tmp_query = "alter table ".$this->ipt_DBF_table->GetName()." modify ".$this->GetName()." ".$tmp_type;
                              
                            $tmp_update = mysql_query($tmp_query,$this->ipt_DBF_table->ipt_DBT_dblink->DbObject());
                             if($tmp_update) {
                                 //print $tmp_query."\n";
                                 //Le champ a été mis a jour
                                 
                                 
                                 
                             } else {
                             
                                echo "#1300009  Une erreur est survenue lors de la connexion a la base de donnees... " . mysql_error($this->ipt_DBF_table->ipt_DBT_dblink->DbObject());
                    
                             }
                          } else {
                            //print "Nous ne sommes pas capable d'updater ce champ.... ";
                          }
                         
                       
                       }            
                            
                } else {
                      echo "#1300010   Une erreur est survenue lors de la connexion a la base de donnees... " . mysql_error($this->ipt_DBF_table->DbObject());
                    
                
                }
               //$data = mysql_result ($this->cRecordset, $pRow ,$pField);
               
     
               

                            
                            
          break;       
       }
   
   
   
   }
   
   
     
}


?>