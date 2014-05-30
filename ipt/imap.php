<?
/*
Source: ipt/imap.php
Créer le: 2014-03-20
Par: Mathieu Tremblay

Tous droits réservés. 

*/




  class iptIMAP {
    var $cQuery;

    var $ipt_Serveur;
    var $ipt_Login;
    var $ipt_Password;
    var $ipt_Port;
    var $ipt_Security;
    var $ipt_ConnectionString;
    
    var $ipt_IMAP_Object; 
     
    function Connect($pLogin,$pPass,$pServeur="localhost",$pPort="143",$pSecure="novalidate-cert") {

              $this->ipt_Serveur= $pServeur;
              $this->ipt_Password= $pPass;
              $this->ipt_Login= $pLogin;
              $this->ipt_Port= $pPort;
              $this->ipt_Security= $pSecure;

              $this->ipt_ConnectionString= "{".$this->ipt_Serveur.":".$this->ipt_Port."/".$this->ipt_Security."}";

              $connection = imap_open($this->ipt_ConnectionString, $this->ipt_Login, $this->ipt_Password, OP_HALFOPEN);
              if($connection) {
                $this->ipt_IMAP_Object=$connection;
                return true;
              } else {
                return false;
              }
                        

    }
    
    
    function GetNbNewItem($pFolder="INBOX") {
              
              $mbox = imap_open($this->ipt_ConnectionString.$pFolder, $this->ipt_Login, $this->ipt_Password);
              $count = 0;
              if (!$mbox) {
                  echo "Error";
              } else {
                  $headers = imap_headers($mbox);
         
                  foreach ($headers as $mail) {
                      $flags = substr($mail, 0, 4);
                      $isunr = (strpos($flags, "U") !== false);
           
                      if ($isunr)
                      $count++;
                  }
              }
          
              imap_close($mbox);
              return $count;
    
    }

    function GetFoldersListQuery($pFolder) {
          $req = "";
          $id=0;
          $mbox = imap_open($this->ipt_ConnectionString.$pFolder, $this->ipt_Login, $this->ipt_Password);
           $folders=null;
          if($mbox) {
              $mailboxes = imap_list($mbox,$this->ipt_ConnectionString.$pFolder , '*');
              $id= $id+1;
              foreach($mailboxes as $mailbox) {
                  $shortname = str_replace($this->ipt_ConnectionString.$pFolder, '', $mailbox);
                 $folders[count($folders)]=$shortname;
                 if($req!="") {
                    $req .= " union ";
                 }
                 $req .= " select ".intval($id)." as id, '".addslashes($shortname)."' folder ";
                 // echo "$shortname\n";
              }
              
          }
          
         return $req;
    
    }


function decode_iso88591($string){
  if (strpos(strtolower($string), '=?iso-8859-1') === false) {
    return $string;
  }
  $string = explode('?', $string);
  return strtolower($string[2]) == 'q' ? quoted_printable_decode($string[3]) : base64_decode($string[3]);
} 



function flatMimeDecode($string) {
    //$string = $this->decode_iso88591($string);
    $array = imap_mime_header_decode($string);
    $str = "";
    foreach ($array as $key => $part) {
        $str .= $part->text;
    }
    
    $str = mb_convert_encoding($str, "UTF-8", "iso-8859-1");
    return $str;
}



    function GetMsgListQuery($pFolder,$pMailboxId=0) {
    
              $req = "";
        
                $mbox = imap_open($this->ipt_ConnectionString.$pFolder, $this->ipt_Login, $this->ipt_Password);
              
                             
                $MC = imap_check($mbox);
           
                  
                // Récupère le sommaire pour tous les messages contenus dans INBOX
                      $result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
                 $mbox2=    imap_sort($mbox, SORTDATE, 1);
                //  print_r($mbox2);
                  
                                   
                foreach ($mbox2 as $key => $value) {
                        $overview = $result[$value-1];
                       $dt="";
                    if(isset($overview->date)) {
                      $dt = date('d-m-Y H:i',strtotime($overview->date));
                    }
                     $overview->subject= $this->flatMimeDecode($overview->subject);
                    
                     $overview->from= $this->flatMimeDecode($overview->from);     
                    
                    if($req!="") {
                          $req .= " union ";
                       }
                       $req .= " select ".intval($overview->msgno)." as id, '".addslashes($pFolder)."' folder, ".intval($pMailboxId)." as mbox, '".addslashes(htmlspecialchars($overview->subject))."' sujet, '".addslashes(htmlspecialchars($overview->from))."' expediteur, '".addslashes(htmlspecialchars($dt))."' dtenvoie ";
          
                
                }
              
         
                imap_close($mbox);
                return $req;
    
    
    }
    
    
    
  function parse_message($obj, $prefix="") {
/* Here you can process the data of the main "part" of the message, e.g.: */
  //do_anything_with_message_struct($obj);
    //    print_r($obj);
  if (sizeof($obj->parts) > 0)
    foreach ($obj->parts as $count=>$p)
      $this->parse_part($p, $prefix.($count+1));
      
      
}

function parse_part($obj, $partno) {
/* Here you can process the part number and the data of the parts of the message, e.g.: */
 // do_anything_with_part_struct($obj,$partno);
  //print $obj->type;
  if ($obj->type == TYPEMESSAGE)
    $this->parse_message($obj->parts[0], $partno.".");
  else
    if (isset($obj->parts))
      foreach ($obj->parts as $count=>$p)
        $this->parse_part($p, $partno.".".($count+1));
}

/* Let's say, you have an already opened mailbox stream $mbox
   and you like to parse through the first message: */
  
 
      
      function GetMsg($pFolder, $pMessageId)
      {

         $message = array();
         
         $mbox = imap_open($this->ipt_ConnectionString.$pFolder, $this->ipt_Login, $this->ipt_Password);
           
         $header = imap_header($mbox, $pMessageId);
         $structure= imap_fetchstructure($mbox, $pMessageId);
    
         $message['subject'] = $header->subject;
         $message['fromaddress'] =   $header->fromaddress;
         $message['toaddress'] =   $header->toaddress;
         $message['ccaddress'] =   $header->ccaddress;
         $message['date'] =   $header->date;
      
        if ($this->check_type($structure))
        {
         $message['body'] = imap_fetchbody($mbox,$pMessageId,"2"); ## GET THE BODY OF MULTI-PART MESSAGE
         if(!$message['body']) {$message['body'] = '[NO TEXT ENTERED INTO THE MESSAGE]\n\n';}
        }
        else
        {
         $message['body'] = imap_body($mbox, $pMessageId);
         if(!$message['body']) {$message['body'] = '[NO TEXT ENTERED INTO THE MESSAGE]\n\n';}
        }
        
                    $message['body']= quoted_printable_decode($message['body']);
        $req = " select ".intval($pMessageId)." id,
                         '".addslashes( $message['subject'])."' as sujet, 
                         '".addslashes( $message['fromaddress'])."' as fromaddress,
                         '".addslashes( $message['toaddress'])."' as toaddress,
                         '".addslashes( $message['ccaddress'])."' as ccaddress,
                         '".addslashes( $message['date'])."' as dt,
                         '".addslashes( $message['body'])."' as body
                         ";
        return $req;
        
      }
      
      
      
      function check_type($structure) ## CHECK THE TYPE
      {
        if($structure->type == 1)
          {
           return(true); ## YES THIS IS A MULTI-PART MESSAGE
          }
       else
          {
           return(false); ## NO THIS IS NOT A MULTI-PART MESSAGE
          }
      }

    
    

  }

?>