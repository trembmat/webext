<?

include_once($_SESSION['IPT_VARS_DIR']."_vars.php");
include_once($_SESSION['IPT_VARS_DIR']."dbfield.php");

/*
Source: ipt/dbtable.php
Créer le: 2013-06-26
Par: Mathieu Tremblay

Tous droits réservés. 




Exemple d'utilisation (structure de base de données IPT par défaut):






*/


class iptDbTable {

  var $ipt_DBT_dblink;
  var $ipt_DBT_name;
  var $ipt_DBT_fields;
  
  
  function iptDbTable($p_nom="",&$p_fields=null) {
    $this->Init($p_nom,$p_fields);
   
    
      
    
  }
  
  function GetName() {
    return $this->ipt_DBT_name;
  }
  
  function AddField(&$p_field) {
           $tmp_id = count($this->ipt_DBT_fields);
           $this->ipt_DBT_fields[$tmp_id] = &$p_field;

  
  }
  
  
  
  function Init($p_nom="",&$p_fields=null) {
 
   
         if($p_nom!="") {
          $this->ipt_DBT_name    = $p_nom;
        }
        if($p_fields) {
          foreach($p_fields as &$value) {
               
               $tmp_id = count($this->ipt_DBT_fields);
               $this->ipt_DBT_fields[$tmp_id] = &$value;
               $this->ipt_DBT_fields[$tmp_id]->SetTable($this);
          }
        }
    
       
       
        
  
  
  }
  
   function Create(&$p_db=null) {
     if($p_db) {
        $this->ipt_DBT_dblink    = $p_db;
      }
    $this->CreateTable();
   
    
      
    
  }
  
  
   function CreateTable() {
  




        if( $this->ipt_DBT_name=="") {
            
               //Le lien vers la base de données n'est pas actif
             
               print "#1300004 Erreur.... le nom de la table n'a pas été spécifié!";
             
            
            
          } elseif(!$this->ipt_DBT_dblink) {
          
              //Le lien vers la base de données n'est pas actif
              print "#1300003  Erreur.... le lien vers la base de données est inactif!";
              
          }  else {
          
          
          
              //On créer la db                                                               
              if($this->ipt_DBT_dblink->ipt_DBF_type==IPT_DB_TYPE_MYSQL)  {
              
                  if( !$this->ipt_DBT_dblink->Connect()) {
          
                      // Create database
                      $tmp_query="CREATE TABLE ".$this->ipt_DBT_name. " (\n";
                      foreach($this->ipt_DBT_fields as $field) {
               
                           $tmp_query.= $field->GetName()." ".$field->GetDbFieldType($this->ipt_DBT_dblink->GetType())."";
                           
                           if($field!=$this->ipt_DBT_fields[count($this->ipt_DBT_fields)-1])  {
                             $tmp_query.= ",\n"; 
                           }
           
                           
                      }
                      
                      $tmp_query.=")\n";

        
                      
                      //print $tmp_query;
                      
                           
                      
                      if (mysql_query($tmp_query,$this->ipt_DBT_dblink->DbObject())) {      
                        //echo "La table été créer avec succès";
                      } else {
                        if(mysql_errno($this->ipt_DBT_dblink->DbObject())==1050)  {
                          //La table existe deja, il faut verifier les champs un par un
                          foreach($this->ipt_DBT_fields as $field) {
                                $field->CreateField();
               
                               
                          }                          
                          
                          
                          
                        } else {
                          echo "#1300001  Une erreur est survenue lors de la création de la table... " . mysql_error($this->ipt_DBT_dblink->DbObject())."<br>".$tmp_query;
                        }
                        
                        
                      }  
                 
                   
                   
                    // die ('Impossible de sélectionner la base de données : ' . mysql_error());
                  } else {
                  //  print "La base de données existe déja...";
                  }
               } else {
                print "#1300002  Désolé, ce format de base de données n'est pas supporté...";
               
               }   
                  
            }
    
      
    
  }
  
    
  
}






?>