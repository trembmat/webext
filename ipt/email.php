<?


class iptEmail {

	var $header;
	var $from;
	var $uid;  

function encode_iso88591($string){
  $text = '=?iso-8859-1?q?';
  for( $i = 0 ; $i < strlen($string) ; $i++ ){
    $val = ord($string[$i]);
    $val = dechex($val);
    $text .= '='.$val;
  }
  $text .= '?=';
  return $text;
}



	function Init($from,$message) {
      $this->from=$from; 
              
	    $this->uid = md5(uniqid(time()));
	    $this->header = "From: ".$from."\n";
	    $this->header .= "MIME-Version: 1.0\n";
	    $this->header .= "Content-Type: multipart/mixed; boundary=\"".$this->uid."\"\n\n";
	    $this->header .= "This is a multi-part message in MIME format.\n";
	    $this->header .= "--".$this->uid."\n";
	    $this->header .= "Content-type:text/html; charset=iso-8859-15\n";
	    $this->header .= "Content-Transfer-Encoding: 8bit\n\n";
	    $this->header .= $message."\n\n";
	    
      //\nAdresse IP de l'expéditeur".$_SERVER["REMOTE_ADDR"]."\nURL d'origine:".$_SERVER['REQUEST_URI']."\n\n";   
	    $this->header .= "--".$this->uid."";

	}

	function AddAttachment($file,$name,$id) {
	
	//print file_exists("/home/wz/sofadeco.com/myriamdev/josephine_new/images/bandeau_courriel.jpg");
	    $file_size = filesize($file);
	    $handle = fopen($file, "r");
	   // print $file_size;
	    $content = fread($handle, $file_size);
	    fclose($handle);
	    $content = chunk_split(base64_encode($content));
	    $filename = $name;

	    $this->header .= "\n";

	    if($id!="") {
	    	$this->header .= "Content-id: <".$id.">\n";
	    }
	    $this->header .= "Content-Type: application/octet-stream; name=\"".$name."\"\n";
	    $this->header .= "Content-Transfer-Encoding: base64\n";
	    $this->header .= "Content-Disposition: attachment; filename=\"".$name."\"\n\n";
	    $this->header .= $content."\n\n";
	    $this->header .= "--".$this->uid."";

	}

	function Send($to,$title) {
	    $this->header .= "--";
		//$title = str_replace('é','=E9', $title);
    		$i = mail($to, $this->encode_iso88591($title), "", $this->header,"-f ".$this->from);
    		return $i;
    		print "done".$i;
        //$i = mail("$to","$subject","$message",$xheaders,"-f $from");

//print $this->header;

	}



}

?>
