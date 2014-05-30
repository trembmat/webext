<?

class iptPDF_Form {


 var $ipt_background_img="";
 var $ipt_pdf="";
 var $ipt_base_dir="";
 var $ipt_fonts_dir ="ext/ipt/fonts/";
 var $ipt_text_styles = array();
 var $ipt_text_active="";

  function iptPDF_Form($pBaseDir="") {
      $this->ipt_base_dir =$pBaseDir;
  }
  
  
  
  function SetBackground($pImg) {
      $this->ipt_background_img =$pImg;
  
  }


function SetFontsLocation($pDir) {
      $this->ipt_fonts_dir =$pDir;
  
  }

	function AddPage() {
			if($this->ipt_pdf!=null) {
					$this->ipt_pdf->ezNewPage();				
				} else {
					$this->ipt_pdf = new iptEzPDF('letter');	
				}	
        if($this->ipt_background_img!="") {	  			
          $this->ipt_pdf->addJpegFromFile($this->ipt_base_dir.$this->ipt_background_img,0,0,612,792);
        }		
	}		
	
	
  function AddTextStyle($pName,$pFont,$pSize,$pColor=array(0,0,0),$pAlign="left") {
  
      $this->ipt_text_styles[$pName]['font'] = $pFont;
      $this->ipt_text_styles[$pName]['size'] = $pSize;
      $this->ipt_text_styles[$pName]['color'] = $pColor;
      $this->ipt_text_styles[$pName]['align'] = $pAlign;

      
      
      
                                                               
  }

  function ActiveTextStyle($pName) {
  
        $this->ipt_pdf->setColor($this->ipt_text_styles[$pName]['color'][0],$this->ipt_text_styles[$pName]['color'][1],$this->ipt_text_styles[$pName]['color'][2]);
        $this->ipt_pdf->selectFont($this->ipt_base_dir.$this->ipt_fonts_dir.$this->ipt_text_styles[$pName]['font']);
        $this->ipt_text_active=$pName;
  }
  

  function AddTextLabel($pLabel,$pTop,$pLeft,$pWidth) {
  
      $pSize=10;
      $pAlign="left";
      if($this->ipt_text_active!="") {
        $pSize = $this->ipt_text_styles[$this->ipt_text_active]['size'];
        $pAlign = $this->ipt_text_styles[$this->ipt_text_active]['align'];
      }
      
      
			$this->ipt_pdf->addTextWrap($pLeft,$pTop,$pWidth,$pSize,$pLabel,$pAlign);	
  }

  function Save($pFileName) {
  
       $this->ipt_pdf->ezSaveToFile($pFileName);

  }
  
  
  function Show() {

	     $this->ipt_pdf->stream();
  }
	
}





?>