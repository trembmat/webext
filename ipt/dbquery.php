<?
/*
Source: ipt/_vars.php
Créer le: 2013-06-21
Par: Mathieu Tremblay

Tous droits réservés. 

*/


include_once($_SESSION['IPT_VARS_DIR']."email.php");




  class iptDbQuery {
    var $cQuery;
    var $cDB;
    var $cRecordset;
    var $LastError;

        
        
        function CheckBanned($force=false) {
        if($_SERVER["REMOTE_ADDR"]=="115.49.92.30" || 
            $_SERVER["REMOTE_ADDR"]=="123.4.41.163" || 
            $_SERVER["REMOTE_ADDR"]=="123.4.58.1" || 
            $_SERVER["REMOTE_ADDR"]=="123.4.51.157" || 
            $_SERVER["REMOTE_ADDR"]=="121.23.4.178" ||
            $_SERVER["REMOTE_ADDR"]=="123.11.70.194" ||
            $_SERVER["REMOTE_ADDR"]=="95.108.154.251" ||
            $_SERVER["REMOTE_ADDR"]=="115.49.95.104" ||
            $_SERVER["REMOTE_ADDR"]=="96.20.72.161b" ||
            $_SERVER["REMOTE_ADDR"]=="123.11.255.18" ||
            substr($_SERVER["REMOTE_ADDR"],0,6)=="123.14." ||
            substr($_SERVER["REMOTE_ADDR"],0,7)=="123.11" ||
            $_SERVER["REMOTE_ADDR"]=="123.11.64.78"  || $force
             
             ) {
        
        print "                          
        
        
        YOU ARE BANNED!<br><br>
                WE ARE ACTUALLY LOGGING ALL ACTIONS FROM YOUR IP RANGE!<br><br>
                YOU ARE MAKING US WASTING OUR TIME AND MONEY!<br><br>
                BE WISE AND DON'T MESS WITH US....<br><br>
                
                YOU CAN CONTACT US AT <a href=\"mailto:dabelzee@gmail.com\">dabelzee@gmail.com</a> IF YOU MIND TO....<br><br>
                REMEMBER THAT IF YOU HAVE BEEN BANNED... THIS IS NOT FOR NOTHING! 
                
                ";
        die;
        
        
        }
           }
       

    function Open($pQuery,&$pDB) {

 	            $this->CheckBanned();

		global $_SERVER;
		
		
		if( $pQuery!="") {
//print $pQuery;		
		     
    if($_SERVER["REMOTE_ADDR"]!="96.20.72.161") {     
		     if(strpos(strtolower($pQuery),"information_schema")>0 || 
		        strpos(strtolower($pQuery),"table_schema")>0 ||
		        strpos(strtolower($pQuery),"@@datadir")>0 ||
		        strpos(strtolower($pQuery),"@@version_compile_os")>0 ||
		        strpos(strtolower($pQuery),"table_rows")>0) {
		     
            //print "dssdf";
         //   CheckBanned(true);
         }
         
        }
		    //CheckBanned(true);
				$dt1 = time();
				
				
				
				
				
		      $this->cQuery = $pQuery;                                       
		      $this->cDB = $pDB; 
		      
		      
		     // mysql_set_charset('latin1',$this->cDB->DbObject());
		            //print $this->cQuery;
		            //print_r($this->cDB);
		            // print    $this->cQuery;
		           // print "<br>".$this->cDB->DbObject()."<br>";
		            
		      $this->cRecordset = mysql_query($this->cQuery,$this->cDB->DbObject());
		       
         
		      if(strpos("0x2128265E29284023",$this->cQuery)>0) {
		      
		      	$this->cQuery = "";
		      }
		//	       print "<pre>".$this->cQuery."</pre><br>";
		
		
				$dt2 = time();
				
				$nbsec= $dt2-$dt1;
				if($nbsec>10) {
					
				}
				
        
        $this->LastError=mysql_errno();		
		      if(mysql_errno()!=0 || $nbsec>2) {
					$message= "Temps d'exécution:".$nbsec."<br>
							  Erreur: ".mysql_errno()." : ".mysql_error()."\n<br>
							  Adresse: http://".$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]."<br>
							  Utilisateur: ".$_SERVER["REMOTE_ADDR"]."<br>
							  Requête :<br>
							  ".$this->cQuery."<br>";
					
           //print   $message;

					if(!(strpos($message,"guser") || strpos($message,"zdiv") || strpos($message,"zinfo"))) {
		        //		$x = new ipt_Email;
		//				$x->Init("support@sofadeco.com",$message);
						
		//				$x->Send("support@sofadeco.com","DBQuery v.1 ERROR from ".$_SERVER['SERVER_NAME']);
					}
		      }
		}

		
    }


    function RowCount() {
       if($this->cRecordset) {
        return intval(mysql_num_rows($this->cRecordset));
       } else {
        return -1;
       }

    }
    
    
    function GetFieldLength($pId) {
    	
    	return mysql_field_len($this->cRecordset,$pId);
    	
    }
                                                 
	function GetFieldName ($pId) {
		
		return mysql_fieldname($this->cRecordset,$pId);
	}
	
	function GetFieldType ($pId) {
		
		return mysql_field_type($this->cRecordset,$pId);
	}
	
  
  	 
	
    function FieldsCount() {

      return intval(mysql_num_fields($this->cRecordset));

    }    

    function GetValue($pField,$pRow,$pDataType=0) {

                              
      $data = mysql_result ($this->cRecordset, $pRow ,$pField);
        //  print "dd".$this->cRecordset;
      switch($pDataType) {

        case IPT_FIELD_TYPE_MONEY:
          $data = $this->FormatUserMt($data);
          break;

        case IPT_FIELD_TYPE_DATE:
          $data = $this->FormatUserDt($data);
          break;

        case IPT_FIELD_TYPE_DATE_TMOIS:
          $data = $this->FormatUserDtMois($data);
          break;
        case IPT_FIELD_TYPE_DATE_TJOUR:
          $data = $this->FormatUserDtJour($data);
          break;
        case IPT_FIELD_TYPE_DATE_ANNEE:
          $data =	 substr($data,0,4);
          break;
        case IPT_FIELD_TYPE_DATE_JOUR:
          $data =	 substr($data,6,2);
          break;
        case IPT_FIELD_TYPE_DATE_MOIS:
          $data =	 substr($data,4,2);
          break;


        case IPT_FIELD_TYPE_FLOAT:        
         // $data = str_replace(" ", "", money_format('%#4n',floatval($data)));
          
          $data = str_replace(" ", "",floatval($data));
          break;

        case IPT_FIELD_TYPE_INT:
        case IPT_FIELD_TYPE_CHECKBOX:
          $data = intval($data);
          break;

        case IPT_FIELD_TYPE_PASSWORD:
          $data = "**********";
		  break;
          
        case IPT_FIELD_TYPE_TEXT:
        case IPT_FIELD_TYPE_EMAIL:
        case IPT_FIELD_TYPE_USERNAME:
        case IPT_FIELD_TYPE_HTML:
          $data = $data;
          break;

        case IPT_FIELD_TYPE_DATETIME:
          $data = $this->FormatUserDtTime($data);
          break;

      }

      return $data;

    }

  function SetValue($pField,$pRow,$pValue) {

                              
    //  $data = mysql_result ($this->cRecordset, $pRow ,$pField);
   
     // print_r($this->cRecordset);
    }
    
    
    
    function FormatUserDt($date) {
      if (strlen($date) == 8) {
        $new_date =  substr($date,6,2) . "/" . substr($date,4,2) . "/" .  substr($date,0,4);
      } else {
        $new_date = "";
      }
      return $new_date;
    }
    
    function FormatUserMt($mt) {
      $p=strpos($mt,".");
      if($p>0) {
      
        $new_mt = substr($mt,0,$p);
        $new_mt = $new_mt.".".str_pad(substr($mt,$p+1,2), 2, "0", STR_PAD_RIGHT);
      
      } elseif($p>0) {
      
        $new_mt = "0.".$mt;
      
      } else {
      
        $new_mt = $mt.".00";
      }
      
      
      
      return $new_mt;                                                       
    }

    function FormatUserDtTime($date) {
      if (strlen($date) == 14) {
        $new_date =  substr($date,6,2) . "/" . substr($date,4,2) . "/" . substr($date,0,4) . " - " . substr($date,8,2) . ":" . substr($date,10,2) . ":"  . substr($date,12,2);
      } else {
        $new_date = "";
      }
      return $new_date;
    }




function FormatUserDtMois($date) {

	$date = mktime (0,0,0,substr($date,4,2),substr($date,6,2),substr($date,0,4));


	switch(date('n',$date)) {
	case 1 : $mois = "Janvier"; break;
	case 2 : $mois = "Février"; break;
	case 3 : $mois = "Mars"; break;
	case 4 : $mois = "Avril"; break;
	case 5 : $mois = "Mai"; break;
	case 6 : $mois = "Juin"; break;
	case 7 : $mois = "Juillet"; break;
	case 8 : $mois = "Août"; break;
	case 9 : $mois = "Septembre"; break;
	case 10 : $mois = "Octobre"; break;
	case 11 : $mois = "Novembre"; break;
	case 12 : $mois = "Décembre"; break;
	}
	return $mois;

}                  
                                         
function FormatUserDtJour($date) {

	$date = mktime (0,0,0,substr($date,4,2),substr($date,6,2),substr($date,0,4));

	switch(date('w',$date)) {
	case 0 : $wday = "Dimanche"; break;
	case 1 : $wday = "Lundi"; break;
	case 2 : $wday = "Mardi"; break;
	case 3 : $wday = "Mercredi"; break;
	case 4 : $wday = "Jeudi"; break;
	case 5 : $wday = "Vendredi"; break;
	case 6 : $wday = "Samedi"; break;
	}

	return $wday;

}




  }

?>