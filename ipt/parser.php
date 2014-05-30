<?






class iptParser {

var $ipt_data;


   
 function FindPreviousId($look_in,$look_for) {
  
      $myval =0;
      foreach($look_in as $mitem => $mvalue) {
      
        if($mvalue['nick']==$look_for)  {
          if(isset($mvalue['comment_id'])) {
            $myval = $mvalue['comment_id'];
          }
        }
      }
      
      return intval($myval);
 
}
                                   
                                   
                                   
   function PosAfter($p_data,$p_startpos,$find) {
      
      $tmp_pos1= strpos(substr($p_data,$p_startpos),$find);
     // print "(pos1:".$tmp_pos1.")";
      if($tmp_pos1>=0) {
        return $tmp_pos1+strlen($find)+$p_startpos;
      } else {
        return $p_startpos;
      }
      

   }
   
   function PosBefore($p_data,$p_startpos,$find) {
      
      return strpos(substr($p_data,$p_startpos),$find)+$p_startpos;
 

   }
   
function curl($url){

    $headers[]  = "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0";
    $headers[]  = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
    $headers[]  = "Accept-Language:fr,fr-fr;q=0.8,en-us;q=0.5,en;q=0.3";
    $headers[]  = "Accept-Encoding:gzip,deflate";
    $headers[]  = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $headers[]  = "Keep-Alive:120";
    $headers[]  = "Connection:keep-alive";
    $headers[]  = "Cache-Control:max-age=0";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    
    //curl_setopt($curl,CURLOPT_POST, count($fields));
  //  curl_setopt($curl,CURLOPT_POSTFIELDS, $fields_string); 
      
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);   
    curl_setopt($curl, CURLOPT_REFERER, 'http://acorp.info/');
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;

}






function Open($url,$pUseProxy=false) {

     if($pUseProxy) {
        $this->ipt_data = $this->curl("http://acorp.info/browse.php?u=".urlencode($url)."&b=4&f=norefer");
     } else {
      $this->ipt_data = $this->curl($url);
     }
    




}





function GetContent() {


    return $this->ipt_data;




}



}


?>