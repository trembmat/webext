<?

                                     
class iptScreen {


  var $query_new = ""; //"select 0 id, '' tnom, '19970131' dnaissance";
  var $query_edit = ""; //"select * from hts_joueur where id=1";
  var $query_list = ""; //"select * from hts_joueur order by id desc";
            
  var $template_edit = ""; //"template/forms/player.html";          
  var $template_list = ""; //"template/forms/players.html";

  var $dbo_name = ""; //"htsPlayer";
  var $dbo_fields = null; //array(HTS_PLAYER_NAME=>'tnom',HTS_PLAYER_BIRTHDATE=>'dnaissance');


  private $isc_db = null;
  private $isc_html = "";


  function iptScreen($pDB=null) {
    if(!($pDB)) {
    
    } else {
      $this->isc_db = $pDB;
    }
  }
  

  
  function Init($pDB) {
  
    global $_GET, $_POST;
    
    $this->isc_db=$pDB; 
    
    if(isset($_POST['id'])) {
    
       $this->Save();
       
    }
                 
    
    if(isset($_GET['id'])) {
    
      if(intval($_GET['id'])!=0) {
      
        $this->Edit();
        
      } else {
      
        $this->Add();
        
      }
      
    } else {
       $this->Liste();
    
    
    }
    
    
      
  }
  
  
  
  function Save() {
  
    global $_GET, $_POST;
    
    $my_player = new $this->dbo_name; 
    $my_player->Init($this->isc_db,intval($_POST['id']));
    
    foreach($this->dbo_fields as $item=>$value) {
      if(isset($_FILES[$value])) {
            
           $my_player->SetParam($item,$_FILES[$value]['tmp_name'],true);
      } else {
      
         if(isset($_POST[$value])) {
            $my_player->SetParam($item,$_POST[$value]);
          }
     
      }

    
    }
 
    //$my_player->SetParam(HTS_PLAYER_BIRTHDATE,$_POST['dnaissance']);
  
    $newid = $my_player->Save();
  
    if(intval($_POST['id'])==0) {
      $_POST['id'] = $newid; 
    }
    $_GET['id']  =$_POST['id'];    
    
  }
    
  
  function Edit() {
    global $_GET, $_POST;
               
    
  
      $my_player = new $this->dbo_name; 
      $my_player->Init($this->isc_db,intval($_GET['id']));
      //print_r($my_player);

      $this->isc_html= "Edit\n\n";
      $rs2 = new iptDbQuery();
      $rs2->Open($this->query_edit,$this->isc_db);
      $x = new iptWidget($this->template_edit,$rs2);
      $this->isc_html .= $x->GetHTML();
          
    
    
  }
   
  function Add() {
    global $_GET, $_POST;
    
    
    $this->isc_html = "New\n\n";
    $rs2 = new iptDbQuery();
    $rs2->Open($this->query_new,$this->isc_db);
    $x = new iptWidget($this->template_edit,$rs2);
    $this->isc_html .= $x->GetHTML();
    
    
    
  }
   
  function Liste() {
    global $_GET, $_POST;
    $this->isc_html = "List\n\n";

    $rs2 = new iptDbQuery();
    $rs2->Open($this->query_list,$this->isc_db);
    $x = new iptWidget($this->template_list,$rs2);
    $this->isc_html .= $x->GetHTML();
    
    
    
    
    
    
  }  
    
  function Show() {
    print $this->isc_html;
  }
  
  
  function GetHTML() {
    return $this->isc_html;
  }  
  
  
}


?>