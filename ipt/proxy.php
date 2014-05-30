<?


class iptProxy {




    function Test($proxy) {
                  global $fisier;
                  $splited = explode(':',$proxy); // Separate IP and port
                  if($con = @fsockopen($splited[0], $splited[1], $eroare, $eroare_str, 3)) 
                  {
                    return true; // Show the proxy
                    fclose($con); // Close the socket handle
                  } else {
                    return false;
                  }
    }
    


}

?>