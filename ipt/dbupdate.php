<?

class iptDBUpdate {
    var $cTable;
    var $cIdField;
    var $cDB;
    var $cId;
    var $LastQuery;
    var $LastError;
    var $cValue;

    var $cQueryPartA;
    var $cQueryPartB;

    function Begin($pTable,$pIdField,$pId,&$pDB) {
      $this->cTable = $pTable;
      $this->cIdField = $pIdField;
      $this->cDB = $pDB; 
      $this->cId = intval($pId);

      $this->cQueryPartA = "";
      $this->cQueryPartB = "";
    }
    
    
    
  function GetValue($pField) {
	  //Ca serait utile mais faut changer le set value avant pour qui passe pas un tableau $this->cValue; 
  }
  
  
    function SetValue($pField,$pValue,$pDataType) {
	     $bCancel=false;
      $data = $pValue;
        //print $pField."=".$pDataType."<br>";
      switch($pDataType) {

        case IPT_FIELD_TYPE_DATE:
          $data = "'" . $this->FormatDbDt($data) . "'";
          break;

        case IPT_FIELD_TYPE_FLOAT:
          $data = floatval($data);
          break;

        case IPT_FIELD_TYPE_INT:
        case IPT_FIELD_TYPE_CHECKBOX:
          $data = intval($data);
          break;
        case IPT_FIELD_TYPE_MULTILINE:   
        case IPT_FIELD_TYPE_TEXT:
        case IPT_FIELD_TYPE_EMAIL:
        case IPT_FIELD_TYPE_USERNAME:
        case IPT_FIELD_TYPE_HTML:
          if(strpos($data,"\'")>0) {
          } else {
           $data = addslashes($data);
           }
          
          $data = "'" .$data . "'";
          break;

        
        	
        case IPT_FIELD_TYPE_PASSWORD:
          if($data!= "**********") {
				$data = "PASSWORD('" . $data . "')";
          } else {
          	
          	$bCancel=true;
          }
          break;
		  
        case IPT_FIELD_TYPE_FILE:
          $datastring=file_get_contents($pValue);
          $datahex=unpack("H*hex", $datastring);
          $data = "0x".$datahex['hex'];
          break;
          
        case IPT_FIELD_TYPE_IMAGE:
          $datastring=file_get_contents($pValue);
          $datahex=unpack("H*hex", $datastring);
          $data = "0x".$datahex['hex'];
          break;
          
        default:
           $data = addslashes($data);
          break;

      }

      if($bCancel==false) {
	      if($this->cId==0) {
	
	        if($this->cQueryPartA!="") { $this->cQueryPartA = $this->cQueryPartA . ","; }
	        $this->cQueryPartA = $this->cQueryPartA . $pField;
	
	        if($this->cQueryPartB!="") { $this->cQueryPartB = $this->cQueryPartB . ","; }
	        $this->cQueryPartB = $this->cQueryPartB . $data;
	
	      } else {
	
	        if($this->cQueryPartA!="") { $this->cQueryPartA = $this->cQueryPartA . ","; }
	        $this->cQueryPartA = $this->cQueryPartA . $pField . "=" . $data;
	
	      }
      }

    }

    function Delete($id) {

          $query = "delete from " . $this->cTable . " where " . $this->cIdField . "=" . $id;

	        mysql_query($query,$this->cDB->DbObject());


		    }    
    
    function Update() {
global $_SERVER;
      if($this->cId==0) {
        $query = "insert into " . $this->cTable . " (" . $this->cQueryPartA . ") values(".$this->cQueryPartB.")";
      } else {
        $query = "update " . $this->cTable . " set " . $this->cQueryPartA . " where " . $this->cIdField . "=" . $this->cId;
      }


      
      $this->LastQuery = $query;
      
      mysql_query($query,$this->cDB->DbObject());
      
      
      
      
         
     //  print $query;
      
      
      
      
      $x2 = mysql_insert_id($this->cDB->DbObject()); 


      
if(mysql_error()!="") {
	
	 $this->LastError = $message = "<pre>";	
     $this->LastError .= "> Database writing error!\n";
     $this->LastError .= "> ".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."\n";
     $this->LastError .= "> ".mysql_error();
     $this->LastError .= "</pre>";

	 
	 $message = "<pre>";
     $message .= "> Database writing error!\n";
     $message .= "> ".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."\n";
     $message .= "> ".$query."\n";
     $message .= "> ".mysql_error();
     $message .= "</pre>";

$this->LastError= $message;

//$x = new ipt_Email;
//$x->Init("support@sofadeco.com",$message);
//$x->Send("support@asselinmedia.com","DBUpdate ".$_SERVER['SERVER_NAME']);

print $message;

}
      
      if($x2==0) {
      	
				$rs2 = new iptDBQuery;
					$rs2->Open("SELECT LAST_INSERT_ID() newid",$this->cDB);
					$x2 = $rs2->GetValue("newid",0,IPT_FIELD_TYPE_INT);
      	
      	
      }
      
      
      
  

      return $x2;

    }

    function ReturnLastQuery() {                                                    
    	return $this->LastQuery;
    	
    }
    
    function FormatDbDt($date) {
      if (strlen($date) == 10) {


        $new_date = substr($date,6,4) . substr($date,3,2) . substr($date,0,2);
      } else {								
        $new_date = "";
      }
      return $new_date;
    }


	
	
  }

	
?>
