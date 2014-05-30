<?

class iptPageNumber {

  var $pQuery = "";
  var $pPage = "";
  var $pMaxPerPage = "";
  
  var $pActiveDB = null;
                
  function __construct($pActiveDB,$pQuery,$pPage=0,$pMaxPerPage=25) {
      $this->pQuery = $pQuery;
      $this->pPage = $pPage;
      $this->pMaxPerPage = $pMaxPerPage;
      $this->pActiveDB=$pActiveDB;

  }
  
  
  function GetDataQuery() {
  
  
          return $this->pQuery." limit ".(intval($this->pPage)*$this->pMaxPerPage).", ".$this->pMaxPerPage;

  
  }
  
  function GetPageQuery() {
  
  
    $rs= new iptDBQuery();
    $rs->Open($this->pQuery,$this->pActiveDB);

    
    $reqRow= "";
    $no=0;
    while($no<$rs->RowCount()) {
      if($reqRow!="") {
        $reqRow.=" union ";
      }
      $title=(intval($no/$this->pMaxPerPage)+1);
      if(intval($no/$this->pMaxPerPage)==$this->pPage) {
           $title="<strong>".$title."</strong>";
      }
      
      $reqRow.= " select ".(intval($no/$this->pMaxPerPage))." as id, '".$title."' as title ";
      
      
      $no=$no+$this->pMaxPerPage;
    }
     return $reqRow;
 
  }
  
  
   
}

?>