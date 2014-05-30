<?
/*
Source: ipt/login.php
Créer le: 2013-06-21
Par: Mathieu Tremblay

Tous droits réservés. 




Exemple d'utilisation (structure de base de données IPT par défaut):

$x = new iptUserAuthentification($my_db);
$x->Login($_POST['user'],$_POST['pass']);





Exemple d'utilisation (structure de base de données personnalisée):




//Setting db connection
$dlink = new iptDbLink("localhost","myusername","mypassword");
$db = new iptDb($dlink,"dbname");

//Setting db table structure
$table = new iptDbTable("gco_utilisateur");
$y_id= new iptDbField($table,"id",IPT_FIELD_TYPE_AUTOID);
$y_nom= new iptDbField($table,"tnom",IPT_FIELD_TYPE_TEXT);
$y_prenom= new iptDbField($table,"tprenom",IPT_FIELD_TYPE_TEXT);
$y_login= new iptDbField($table,"tnomutilisateur",IPT_FIELD_TYPE_TEXT);
$y_pass= new iptDbField($table,"tmotdepasse",IPT_FIELD_TYPE_TEXT);


//Setting fields matching
$x = new iptUserAuthentification($db,$table);
$x->SetField($y_id,$_POST['login'],IPT_USERAUTH_FIELDS_ID);
$x->SetField($y_login,$_POST['login'],IPT_USERAUTH_FIELDS_USERNAME);
$x->SetField($y_pass,$_POST['password'],IPT_USERAUTH_FIELDS_PASSWORD);
$x->SetField($y_nom,$_SESSION['nom'],IPT_USERAUTH_FIELDS_EXTRA);
$x->SetField($y_prenom,$_SESSION['prenom'],IPT_USERAUTH_FIELDS_EXTRA);

if ($x->CheckLogin()) {

  //User has login successfully


} else {

  //display login page
  
}



*/                     
include_once($_SESSION['IPT_VARS_DIR']."dbquery.php");
include_once($_SESSION['IPT_VARS_DIR']."_vars.php");
include_once($_SESSION['IPT_VARS_DIR']."db.php");

class iptUserAuthentification {

  var $ipt_UA_db;
  var $ipt_UA_table;  
  var $ipt_UA_fields; 
  
  var $ipt_UA_force_login; 
  var $ipt_UA_dont_use_password;
  
                                                             
  function iptUserAuthentification(&$p_db,$p_table) {
  
      $this->ipt_UA_db=$p_db;
      $this->ipt_UA_table=$p_table;
      $this->ipt_UA_fields=null;
      $this->ipt_UA_force_login=false;
      $this->ipt_UA_dont_use_password=false;
  }
  
  function AddField($p_dbfield,&$p_value,$p_type)  {
  
      $newid="";
      $newid= count($this->ipt_UA_fields);
      $this->ipt_UA_fields[$newid]['db']=$p_dbfield;
      $this->ipt_UA_fields[$newid]['php']=&$p_value;
      $this->ipt_UA_fields[$newid]['type']=$p_type;

  }
  
  
  function GetQueryLogin() {
    $bparam1 = false;
    $bparam2 = false;
    $bparam3 = false;
    $f_extras="";
    $f_id= null;
     $f_user= null;
     $f_pass= null;
      $f_where ="";
  
    
       
    foreach($this->ipt_UA_fields as $item) {
        
     //  print $item['type']."-";
     //  print IPT_USERAUTH_FIELDS_ID;
      // print "-<br>";

   //   print $item['db']->GetTable().":::";
      // print $this->ipt_UA_table->GetName()."<br>";
        if($item['db']->GetTable()==$this->ipt_UA_table->GetName()) {
        
        
          if($item['type']==IPT_USERAUTH_FIELDS_ID) {
            $bparam1 = true;
            $f_id = $item;
          }
          if($item['type']==IPT_USERAUTH_FIELDS_USERNAME) {
            $bparam2 = true;
            $f_user = $item;
          }
          if($item['type']==IPT_USERAUTH_FIELDS_PASSWORD) {
            $bparam3 = true;
            $f_pass = $item;
          }
          
          
          if($item['type']==IPT_USERAUTH_FIELDS_EXTRA) {
            $f_extras .= ",".$item['db']->GetName();
          }
          if($item['type']==IPT_USERAUTH_FIELDS_FILTER) {
            $f_where .= " and ".$item['db']->GetName()."='".addslashes($item['php'])."' ";
          }
        }  
                

        
    } 
      
    if($bparam1==true && $bparam2==true && $bparam3==true) {

        $req = "select ".$f_id['db']->GetName().", ".$f_user['db']->GetName().", ".$f_pass['db']->GetName()." ".$f_extras."
                from ".$this->ipt_UA_table->GetName()."
                where ".$f_user['db']->GetName()." = '".addslashes($f_user['php'])."'";


          if($this->ipt_UA_force_login!=true) {
             
             
              if($this->ipt_UA_dont_use_password==true) {
                            $req = $req."
                and  ".$f_pass['db']->GetName()." = '".addslashes($f_pass['php'])."'  ";
              } else {
              $req = $req."
                and  ".$f_pass['db']->GetName()." = password('".addslashes($f_pass['php'])."')  ";              
              }

                
                

          } 

                
         $req = $req."
                ".$f_where."
                limit 1";
                
                
    
        return $req;
    
    
     
    }  else {
      
       
   //   print "Erreur...";
    }
  
  }
  
  function CheckLogin() {
           
      $query = $this->GetQueryLogin();
      //print "d ".$query;
      $blogin = false;
      
        if($query!="") {

        //print_r($this->ipt_UA_db);
         			$rs = new iptDBQuery;
      				$rs->Open($query,$this->ipt_UA_db);
      				

                if($rs->RowCount()>0) {
                	
                	   $blogin = true; 
                	   
                	/*
                  $this->c_opt->UpdateSession($this->cPrefixe."_kguser",$rs->GetValue("id",0,DB_DATA_TYPE_INT));
                  $this->c_opt->UpdateSession($this->cPrefixe."_guser_name",$rs->GetValue("tname",0,DB_DATA_TYPE_TEXT));
                  $this->c_opt->UpdateSession($this->cPrefixe."_guser_login",$rs->GetValue("tlogin",0,DB_DATA_TYPE_TEXT));          
                    */
                       
                    foreach($this->ipt_UA_fields as $item) {
                       
                       if($item['type']!=IPT_USERAUTH_FIELDS_PASSWORD && $item['type']!=IPT_USERAUTH_FIELDS_FILTER) {
                         $item['php'] =  $rs->GetValue($item['db']->GetName(),0);
                         
                         // print "DDD:".$item['php']."=".$rs->GetValue($item['db']->GetName(),0)."<br>";
                       }
                    }    
                      
                 
                      
                  
              
              } else {
                
              	if(mysql_errno()>0) {			
                    print "Erreur: ".mysql_errno()." : ".mysql_error()."\n<br>"; 
                //    print $query;
               }
                
              }
              
                 

        }  
      
        
        return $blogin;
        
        
  
  }
  

  function Logout() {
  
        
        foreach($this->ipt_UA_fields as $item) {
           
           if($item['type']!=IPT_USERAUTH_FIELDS_PASSWORD && $item['type']!=IPT_USERAUTH_FIELDS_FILTER) {
             $item['php'] =  null;
             
             // print "DDD:".$item['php']."=".$rs->GetValue($item['db']->GetName(),0)."<br>";
           }
        }      
  }

  
}
?>