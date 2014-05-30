<?


include_once($_SESSION['IPT_VARS_DIR']."_vars.php");


/*
Source: ipt/widget.php
Créer le: 2013-06-27
Par: Mathieu Tremblay

Tous droits réservés. 




Exemple d'utilisation (structure de base de données IPT par défaut):




$x = new iptWidget();
$x->Init($my_template_file,$my_rs);





*/



class iptTemplate {



  var $ipt_TPL_template;
  var $ipt_TPL_html;
  var $ipt_TPL_flag1;
  var $ipt_TPL_flag2;
  

  function iptTemplate($p_template) {
        
        $this->ipt_WID_html="";
        $this->ipt_TPL_flag1=-1;
        $this->ipt_TPL_flag2=-1;
                
        $this->Init($p_template);
        
        
  }
  
  function Init($p_template) {
           $this->ipt_WID_template=$p_template;
         if(file_exists($p_template)) {
           $this->ipt_WID_html = file_get_contents($p_template);
         } else {
            print "Can't open ".$p_template;
         }

  
  
  }
                   
  function Explode($p_start,$p_finish,$p_nb) {
      
      
     // print "i'm gonna explode".$p_nb."<br>";
      $tmp_html="";
      $tmp_html = $this->GetActiveContent();
   
      $tmp_1 = strpos($tmp_html,$p_start);
      $tmp_2 = strpos($tmp_html,$p_finish);
      
       //print "my position is between ".$tmp_1." ($p_start) and ".$tmp_2." ($p_finish)<br>";
  
      
      
      if($tmp_2>$tmp_1 && $tmp_2!=-1 && $tmp_1!=-1) {
      
        $tmp_html1="";
        $tmp_repeat=substr($tmp_html,$tmp_1,$tmp_2-$tmp_1);
        
        
        
        for($i=0;$i<$p_nb;$i++) {
           $tmp_html1.=$p_start."<!--".$i."-->".$tmp_repeat."<!--/".$i."-->".$p_finish;
        }
        
        
        
        
        $tmp_html2 = substr($tmp_html,0,$tmp_1);
        $tmp_html2 .= $tmp_html1;
        $tmp_html2 .= substr($tmp_html,$tmp_2+strlen($p_finish));
        
        
        
        
        $this->SetActiveContent($tmp_html2);
      
      }
    
  
  }
  
  
  function Activate($p_start,$p_finish) {
  
      $tmp_html =$this->ipt_WID_html; 
      
      
      $tmp_1 = strpos($tmp_html,$p_start);
      $tmp_2 = strpos($tmp_html,$p_finish)+strlen($p_finish);
  
      
  
      $this->ipt_TPL_flag1=$tmp_1;
      $this->ipt_TPL_flag2=$tmp_2;
      
      
     // print "my position is between ".$tmp_1." ($p_start) and ".$tmp_2." (GetActiveContent())<br>";
    // print "my position is between ".$tmp_1." ($p_start) and ".$tmp_2." (GetActiveContent())<br>";
  
  
  }
  
  

  function GetActiveContent() {
      //  print   "Will get active content in between ".$this->ipt_TPL_flag1." and  ".$this->ipt_TPL_flag2."<br>";
        
        
        
        $tmp_html =$this->ipt_WID_html; 
        if($this->ipt_TPL_flag1!=-1 && $this->ipt_TPL_flag2!=-1) {
          $tmp_html = substr($tmp_html,$this->ipt_TPL_flag1, $this->ipt_TPL_flag2-$this->ipt_TPL_flag1);

        }
        return  $tmp_html;

  }

  
  function SetActiveContent($p_newcontent) {
       // print "i'm gonna wrtie off....<!-begin->".$p_newcontent."<!-/end-><br>";
        $tmp_html = $this->ipt_WID_html;
        $tmp_html2= "";
        
          
      //  print   "Will set active content in between ".$this->ipt_TPL_flag1." and  ".$this->ipt_TPL_flag2."<br>";
        if($this->ipt_TPL_flag1==-1) {
          $this->ipt_TPL_flag1=0;
        }
        if($this->ipt_TPL_flag2==-1) {
          $this->ipt_TPL_flag2=strlen($tmp_html);
        }
        

        $tmp_html2 = substr($tmp_html,0,$this->ipt_TPL_flag1);
    
        
        $tmp_html2 .= $p_newcontent;
        
        
        $tmp_html2 .= substr($tmp_html,$this->ipt_TPL_flag2);
        
        $this->ipt_WID_html=$tmp_html2; 
        
      //  print "\nThe content of active area should now be....<br>\n";
      //  print $this->GetContent();
      //  print "\nEnd of active area content<br>\n";

  }
  
  
   function Replace($p_find,$p_newvalue) {
  
      
      $tmp_html = $this->GetActiveContent();
     // print "Trying to replace ".$p_find." with ".$p_newvalue." <br>\n";
      //   print "\n\n<BR>the content is actually....<br><br>\n\n";
      // print $tmp_html;
       //print "\n\n<BR>end OF Actual content<br><br>\n\n";
      
      $tmp_1 = str_replace($p_find,$p_newvalue,$tmp_html);
      
      // print "\n\n<BR>the row should be replaced with....<br><br>\n\n";
      // print $tmp_1;
      // print "\n\n<BR>end OF ROW<br><br>\n\n";  
      
      $this->ipt_WID_html=str_replace($tmp_html,$tmp_1,$this->ipt_WID_html);
      
      
      
       
  
  }


  function GetContent() {
  
    return  $this->ipt_WID_html;
  }

     
}


?>