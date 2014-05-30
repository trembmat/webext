<?

include_once($_SESSION['IPT_VARS_DIR']."_vars.php");
include_once($_SESSION['IPT_VARS_DIR']."dbtable.php");
include_once($_SESSION['IPT_VARS_DIR']."dbfield.php");
include_once($_SESSION['IPT_VARS_DIR']."dblink.php");

/*
Source: ipt/db.php
Créer le: 2013-06-26
Par: Mathieu Tremblay

Tous droits réservés. 




Exemple d'utilisation (structure de base de données IPT par défaut):


$dlink = new iptDbLink("localhost","myusername","mypassword","dbname");
$db = new iptDb($dlink);

$table = new iptDbTable("gco_contact");
$x= new iptDbField($table,"id",IPT_FIELD_TYPE_AUTOID);
$x= new iptDbField($table,"nom",IPT_FIELD_TYPE_TEXT);
$x= new iptDbField($table,"prenom",IPT_FIELD_TYPE_TEXT);
$table->UpdateDbStructure($my_db);

$db->AddTable($table);

$db->Create();



*/



class iptDb {


  var $ipt_DB_link;
  var $ipt_DB_name;
  var $ipt_DB_tables;

  function iptDb(&$p_dblink=null,$p_dbname="") {
  
      $this->ipt_DB_name = $p_dbname;
      $this->ipt_DB_link = $p_dblink;
      if($p_dbname!="") {
        $this->Connect();
      }

  }          

  
  function AddTable(&$p_table) {
           $tmp_id = count($this->ipt_DB_tables);
           $this->ipt_DB_tables[$tmp_id] = &$p_table;
           //$this->ipt_DB_tables[$tmp_id]->SetDb($this);
           
           
  }
  
  function ListTables() {
      //On sort la liste des tables de la db
  
  
  
  }
  
  function Create($p_dbname="") {
  
      if($p_dbname!="") {
     
        $this->ipt_DB_name = $p_dbname;
         
      }

      $this->CreateDb();
      
      
      
      
  
  }
  
  function CreateDb(){
      if( $this->ipt_DB_name=="") {
        
           //Le lien vers la base de données n'est pas actif
         
           print "#1300005  Erreur.... le nom de la base de données n'a pas été spécifié!";
         
        
        
      } elseif(!$this->DbObject()) {
      
          //Le lien vers la base de données n'est pas actif
          print "#1300006  Erreur.... le lien vers la base de données est inactif!";
          
      }  else {
      
          //On créer la db                                                               
          if($this->ipt_DB_link->ipt_DBF_type==IPT_DB_TYPE_MYSQL)  {
          
              if( !$this->Connect()) {
      
                  // Create database
                  $tmp_query="CREATE DATABASE ".$this->ipt_DB_name;
                  if (mysql_query($tmp_query,$this->DbObject())) {      
                    //echo "La base de données à été créer avec succès";
                    
                    
                   // $tmp_query2="grant all privileges on ".$this->ipt_DB_name.".* to ".$this->ipt_DB_link->ipt_DBF_username."@localhost";
                   // mysql_query($tmp_query2,$this->DbObject());
                    
                  //  print $tmp_query2;            
                  } else {
                    echo "#1300007  Une erreur est survenue lors de la création de la base de données: " . mysql_error($this->DbObject())."<br>".$tmp_query;
                  }  
                  
                  
                    
               
               
                // die ('Impossible de sélectionner la base de données : ' . mysql_error());
              } else {
              //  print "La base de données existe déja...";
              }
              
              
              $this->ipt_DB_link->SetDbName($this->ipt_DB_name);
              
              return true;
              
           } else {
            print "#1300008  Désolé, ce format de base de données n'est pas supporté...";
           
           }   
              
        }
      
  }
  
  

  
  function DbObject() {
    return $this->ipt_DB_link->DbObject();
  }
  
  function Connect($p_dbname="") {

      if($p_dbname!="") {
     
        $this->ipt_DB_name = $p_dbname;
         
      }  
    
   // print "ddd";
    return mysql_select_db($this->ipt_DB_name, $this->DbObject());
    
    
    
  } 

  
 function SwitchDb($p_dbname) {

  
     
        $this->ipt_DB_name = $p_dbname;
         

    
   // print "ddd";
    return mysql_select_db($this->ipt_DB_name, $this->DbObject());
    
    
    
  } 
  

 function CreateDatabase($pName) {
                                            
        
        
      $this->ipt_DB_name=$pName;
      return $this->CreateDb();
      
                 
        
         
  }  
  
}

?>