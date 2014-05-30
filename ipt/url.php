<?




class iptUrl {

  private $ipt_url;

  function iptUrl($pUrl="") {
    $this->ipt_url = $pUrl;
    if($this->ipt_url!="") {
    
    }
    
  }

  function GetFilename($pUrl="") {
      if($pUrl!="") {
        $this->ipt_url=$pUrl;
      }  
      

     $mystr = strrev($this->ipt_url);
     $mystr = substr(strrev($mystr),strlen($mystr)-strpos($mystr,"/"));
     
     if(substr($mystr,0,1)=="?") {
       $mystr =substr($mystr,1);
     }
     
     $my_url = explode ("?" , $mystr ); 
          
     $my_url =$my_url[0];
    
      
      return $my_url;
  }
   
  function GetParams($pUrl="") {
      if($pUrl!="") {
        $this->ipt_url=$pUrl;
      }  
      

     $mystr = strrev($this->ipt_url);
     $mystr = substr(strrev($mystr),strlen($mystr)-strpos($mystr,"/"));
  
     if(substr($mystr,0,1)=="?") {
       $mystr =substr($mystr,1);
     }     
     $my_url = explode ("?" , $mystr ); 
     $my_param = explode ("&" , $my_url[1] );     
     $my_url =$my_url[0];
     $aParams=null;

      foreach($my_param as $item => $value) {
           $my_vals = explode ("=" , $value );
           $aParams[$my_vals[0]]= $my_vals[1];
      }
    
      
      return $aParams;
  }
   
}




?>