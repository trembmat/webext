<?




class iptCrypt {

  private $ipt_cript_key;

  function iptCrypt($pKey="secret") {
    
    $myKey = $pKey;
    if(strlen($myKey)>8) {
       $myKey =substr($myKey,0,8);
    }
    $this->ipt_cript_key=$myKey;
    
    
  }

  function Encrypt($data) {
      $key = $this->ipt_cript_key;  // Clé de 8 caractères max
      $data = serialize($data);
      $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
      $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
      mcrypt_generic_init($td,$key,$iv);
      $data = base64_encode(mcrypt_generic($td, '!'.$data));
      mcrypt_generic_deinit($td);
      return $data;
  }
   
  function Decrypt($data) {
      $key = $this->ipt_cript_key;
      $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
      $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
      mcrypt_generic_init($td,$key,$iv);
      $data = mdecrypt_generic($td, base64_decode($data));
      mcrypt_generic_deinit($td);
       
      if (substr($data,0,1) != '!')
          return false;
   
      $data = substr($data,1,strlen($data)-1);
      return unserialize($data);
  }
  



}




?>