<?


include_once($_SESSION['IPT_VARS_DIR']."_vars.php");


/*
Source: ipt/dbstructure.php
Créer le: 2013-06-26
Par: Mathieu Tremblay

Tous droits réservés. 




Exemple d'utilisation (structure de base de données IPT par défaut):

$x = new  iptDbLink("localhost","myusername","mypassword","dbname");
print_r($x->DbObject());





*/



class iptDbLink {


  var $ipt_DBL_db;
  var $ipt_DBF_location;
  var $ipt_DBF_username;
  var $ipt_DBF_dbname;
  var $ipt_DBF_password;
  var $ipt_DBF_type;
  
  
  
  
  
  function iptDbLink($p_location=null,$p_username="",$p_password="",$p_dbname="",$p_type=IPT_DB_TYPE_MYSQL) {
      
    
      
      $this->ipt_DBF_location = $p_location;
      $this->ipt_DBF_username = $p_username;
      $this->ipt_DBF_password = $p_password;
      $this->ipt_DBF_dbname = $p_dbname;
      $this->ipt_DBF_type = $p_type;
      
    
  
      $this->TestDbLink();
      

      

       
      
    
  
  }
   function GetDbName() {
    return $this->ipt_DBF_dbname;
    
  }   
  
   function SetDbName($p_name) {
    $this->ipt_DBF_dbname=$p_name;
    
  } 
  
    
  function GetType() {
    return $this->ipt_DBF_type;
    
  }  
  function TestDbLink() {
  
      //On devrait tester la connection ici??
      if(!$this->ipt_DBL_db)  {
        $this->Connect(); 
      }   
      
      if($this->ipt_DBL_db) {
        return true;
      } else {
        return false;
      }
        
          
          
  
  }
  
  function Connect() {
  
    if (!$this->ipt_DBL_db) {
    
    
    
      if($this->ipt_DBF_type==IPT_DB_TYPE_MYSQL)  {
        //print $this->ipt_DBF_location.", ".$this->ipt_DBF_username.", ".$this->ipt_DBF_password;
        $this->ipt_DBL_db = mysql_connect($this->ipt_DBF_location, $this->ipt_DBF_username, $this->ipt_DBF_password);
        if (!$this->ipt_DBL_db) {
            print "#1300012  Connexion impossible : ".mysql_error();
        } else {
            //print "Connexion réussie!";
        }
      
      
      } else {
        print "#1300013  Désolé, ce type de base de données n'est pas reconnu actuellement.";
      
      }
      
      
      
      
    } else {
        //Déja Connecté
    } 
  
  }
  
  function Close() {   
  
      if($this->ipt_DBL_db) {
        mysql_close($this->ipt_DBL_db);
      }
         
  }
  
  
  function DbObject() {
      return $this->ipt_DBL_db; 
  }

  
 function CreateDatabase($pName) {
       
        
        
         $sql="CREATE DATABASE ".$pName;
          if (mysqli_query($this->ipt_DBL_db,$sql))
            {
            //echo "Database my_db created successfully";
            return true;
            }
          else
            {
            //echo "Error creating database: " . mysqli_error($this->ipt_DBL_db);
            return false;
            }
                 
        
         
  }
  
  
}


?>