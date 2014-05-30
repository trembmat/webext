<?

include_once($_SESSION['IPT_VARS_DIR']."_vars.php");
include_once($_SESSION['IPT_VARS_DIR']."dbtable.php");
include_once($_SESSION['IPT_VARS_DIR']."dbfield.php");
include_once($_SESSION['IPT_VARS_DIR']."dblink.php");

/*
Source: ipt/db.php
Cr�er le: 2013-06-26
Par: Mathieu Tremblay

Tous droits r�serv�s. 




Exemple d'utilisation (structure de base de donn�es IPT par d�faut):


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
        
           //Le lien vers la base de donn�es n'est pas actif
         
           print "#1300005  Erreur.... le nom de la base de donn�es n'a pas �t� sp�cifi�!";
         
        
        
      } elseif(!$this->DbObject()) {
      
          //Le lien vers la base de donn�es n'est pas actif
          print "#1300006  Erreur.... le lien vers la base de donn�es est inactif!";
          
      }  else {
      
          //On cr�er la db                                                               
          if($this->ipt_DB_link->ipt_DBF_type==IPT_DB_TYPE_MYSQL)  {
          
              if( !$this->Connect()) {
      
                  // Create database
                  $tmp_query="CREATE DATABASE ".$this->ipt_DB_name;
                  if (mysql_query($tmp_query,$this->DbObject())) {      
                    //echo "La base de donn�es � �t� cr�er avec succ�s";
                    
                    
                   // $tmp_query2="grant all privileges on ".$this->ipt_DB_name.".* to ".$this->ipt_DB_link->ipt_DBF_username."@localhost";
                   // mysql_query($tmp_query2,$this->DbObject());
                    
                  //  print $tmp_query2;            
                  } else {
                    echo "#1300007  Une erreur est survenue lors de la cr�ation de la base de donn�es: " . mysql_error($this->DbObject())."<br>".$tmp_query;
                  }  
                  
                  
                    
               
               
                // die ('Impossible de s�lectionner la base de donn�es : ' . mysql_error());
              } else {
              //  print "La base de donn�es existe d�ja...";
              }
              
              
              $this->ipt_DB_link->SetDbName($this->ipt_DB_name);
              
              return true;
              
           } else {
            print "#1300008  D�sol�, ce format de base de donn�es n'est pas support�...";
           
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