<?


//include_once('/home/seahorse/shared/iwe_webeditor.php');

//$iwe_editor = unserialize($_SESSION['iwe_editor']);
    
include_once('/home/seahorse/shared/toolbox.php');
include_once('/home/seahorse/shared/htmlform.php');
include_once('/home/seahorse/shared/dbupdate.php');
include_once('/home/seahorse/shared/dbquery.php');

include_once('/home/seahorse/core2/pdf/class.ezpdf.php');

//  include_once('/home/seahorse/shared/ipt_email.php');


include_once("/home/oms/www/rhinhost.com/cms/config/db.php");


	
$domain = $_SERVER['SERVER_NAME'];
$domain = str_replace("www.", "",  $domain);
$_SESSION['domain']=$domain;
		                                
  include ("/home/seahorse/shared/HTML2TEXT/html2text.inc");




	
	$domain = $_SERVER['SERVER_NAME'];
    $domain = str_replace("www.", "",  $domain);
	$_SESSION['domain']=$domain;
		                                

	function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {    
		/*    $interval can be:    yyyy - Number of full years    q - Number of full quarters    m - Number of full months    y - Difference between day numbers        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)    d - Number of full days    w - Number of full weekdays    ww - Number of full weeks    h - Number of full hours    n - Number of full minutes    s - Number of full seconds (default)    */        
		
		if (!$using_timestamps) {
			$datefrom = strtotime($datefrom, 0);
			$dateto = strtotime($dateto, 0);
		}
		$difference = $dateto - $datefrom; // Difference in seconds         
		switch($interval) {         
				case 'yyyy': // Number of full years        
					$years_difference = floor($difference / 31536000);        
					if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {            
						$years_difference--;        
					}        
					if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {            
						$years_difference++;        
					}        
					$datediff = $years_difference;        
					break;    
				case "q": // Number of full quarters        
					$quarters_difference = floor($difference / 8035200);        
					while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
						$months_difference++;        
					}        
					$quarters_difference--;        
					$datediff = $quarters_difference;        
					break;    
				case "m": // Number of full months        
					$months_difference = floor($difference / 2678400);        
					while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
						$months_difference++;        
					}        
					$months_difference--;        
					$datediff = $months_difference;        
					break;    
				case 'y': // Difference between day numbers        
				$datediff = date("z", $dateto) - date("z", $datefrom);        
				break;    
				case "d": // Number of full days        
				$datediff = floor($difference / 86400);        
				break;    
				case "w": // Number of full weekdays        
				$days_difference = floor($difference / 86400);        
				$weeks_difference = floor($days_difference / 7); // Complete weeks        
				$first_day = date("w", $datefrom);        
				$days_remainder = floor($days_difference % 7);        
				$odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?        
				if ($odd_days > 7) { // Sunday            
					$days_remainder--;        
				}        
				if ($odd_days > 6) { // Saturday            
					$days_remainder--;       
				 }        
				 $datediff = ($weeks_difference * 5) + $days_remainder;        
				 break;    
				 case "ww": // Number of full weeks        
				 $datediff = floor($difference / 604800);        
				 break;    
				 case "h": // Number of full hours        
				 $datediff = floor($difference / 3600);        
				 break;    
				 case "n": // Number of full minutes        
				 $datediff = floor($difference / 60);        
				 break;    
				 default: // Number of full seconds (default)        
				 $datediff = $difference;        
				 break;    
		}        return $datediff;
	}

	

function ConvertMod ($value) {
	
		switch ($value) {
			case 1:
				return 'Insuline';
				break;
			case 2:
				 return 'Cortisol (matin)';
				 break;
			case 3:
				return 'Cortisol (soir)';
				break;
			case 4:
				return 'Oestrogène';
				break;
			case 5:
				return 'Thyroïde';
				break;
			case 6:
				return 'Hormone de croissance';
				break;
			case 7:
				return 'Testostérone';
				break;
			case 8:
				return 'Androgènes';
				break;
		}
}
	            


	function AddPage(&$pdf,$db,$id) {
				
			if($pdf!=null) {
					$pdf->ezNewPage();				
				} else {
					$pdf = new Cezpdf('letter');
							
				}		  
								
$pdf->addJpegFromFile('includes/fond_soumission.jpg',0,0,612,792);		
/*

for($i=0;$i<792;$i=$i+25) {
$pdf->addTextWrap(2,$i,10,6,$i,"left");										
}
for($i=0;$i<612;$i=$i+25) {
$pdf->addTextWrap($i,2,10,6,$i,"left");										
}
*/
	}		
	
	
	


               // $pdf->ezStartPageNumbers(555,557,10,center,'{PAGENUM}/{TOTALPAGENUM}');	
	
//taille la plus basse 160
		

	
	
$myreq =  "select 

gve_soumission.*, gco_entreprise.*,gco_contact.*, gco_province.* 

										from gve_soumission 
		left outer join gco_entreprise on gco_entreprise.id=gve_soumission.kgco_entreprise
		left outer join gco_contact on gco_contact.id=gve_soumission.kgco_contact
    left outer join gco_province on gco_province.id=gco_entreprise.kgco_province
                    where    gve_soumission.id=".intval($_GET['id'])."

		 ";

	  $rsE = new DBQuery;
	  $rsE->Open($myreq,$db);
	  $row=0;
	  



	
$myreqD =  "select 

gve_soumission_detail.*

										from gve_soumission_detail 
		
                    where    gve_soumission_detail.kgve_soumission=".intval($_GET['id'])."

		 ";

	  $rsD = new DBQuery;
	  $rsD->Open($myreqD,$db);
	  




	  $hauteur = 745;
	  $nextwidth=50;
	  $nexthauteur = $hauteur;
	  
	  
	  while($row<$rsE->RowCount()) {
	  	
	  	
AddPage($pdf,$db,$_GET['id']);	

			$pdf->setColor(0.58,0.58,0.58);
				 	$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica-Bold.afm');
				 	//$pdf->addText(390,75,14,"LE DÉRURAL INC. 2",0);
			
			$pdf->setColor(0,0,0);
			
	  	
		$pos=0;
		$nexthauteur=650;
		
		$l_height = 560;
		$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica.afm');	
		for ($i=0;$i<$rsD->RowCount();$i++) {
			
			
			
				//$asciiText = new Html2Text (html_entity_decode($rs->GetValue("dsitem".$i,($row),DB_DATA_TYPE_TEXT)), 300); // 15 columns maximum
				 // $text = $asciiText->convert();

//$pdf->addTextWrap(450,85,90,12,$rsD->GetValue("ldescription",($i),DB_DATA_TYPE_TEXT),"right");
				  
				  $lines = explode("\n",$rsD->GetValue("ldescription",($i),DB_DATA_TYPE_TEXT));
				  //$l_height=495;
				  $nb_line= 0;
				  foreach ($lines as $line){
				  	
				  		$nb++;
				  		$nb_line++;
				  		if($nb_line==1 && $rsD->GetValue("fsoustotal",($i),DB_DATA_TYPE_FLOAT)!=0) {
				  			//$pdf->addTextWrap(450,85,90,12,$rs->GetValue("mttot",($row),DB_DATA_TYPE_FLOAT),"right");
				  			$pdf->addTextWrap(465,$l_height,90,10,$rsD->GetValue("fsoustotal",($i),DB_DATA_TYPE_MONEY)." $","right");	
				  		}
				  		if(str_replace(" ","", $line)=="") {		
				  		} else {
							$pdf->addTextWrap(57,$l_height,500,10,$line,"left");	
							$l_height=$l_height-10;												
				  		}
						  	
				  }	
				  
				  $l_height=$l_height-10;
		}
			
                                                               
		
		$pdf->setColor(0.9,0.9,0.9);
				
			
				
		$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica-Bold.afm');
		//$pdf->addTextWrap(49,682,400,12,"w w w . h e l i o s w e b s o l u t i o n . c o m","left");
		$pdf->setColor(0,0,0);
		
		$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica-Bold.afm');
		$pdf->addTextWrap(50,655,400,11,$rsE->GetValue("gco_entreprise.tnom",($row),DB_DATA_TYPE_TEXT),"left");
		
		$pdf->addTextWrap(50,665,400,10,$rsE->GetValue("gco_contact.tsalutation",($row),DB_DATA_TYPE_TEXT)." ".$rsE->GetValue("gco_contact.tprenom",($row),DB_DATA_TYPE_TEXT)." ".$rsE->GetValue("gco_contact.tnom",($row),DB_DATA_TYPE_TEXT),"left");
		
		
		
			$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica.afm');	
		$pdf->addTextWrap(50,640,400,10,$rsE->GetValue("gco_entreprise.tadresse",($row),DB_DATA_TYPE_TEXT),"left");
		$pdf->addTextWrap(50,630,400,10,$rsE->GetValue("gco_entreprise.tville",($row),DB_DATA_TYPE_TEXT)." (".$rsE->GetValue("gco_province.tnom",($row),DB_DATA_TYPE_TEXT).") ".$rsE->GetValue("gco_entreprise.tcodepostal",($row),DB_DATA_TYPE_TEXT),"left");
		
		//$pdf->addTextWrap(50,590,400,10,"T: ".$rs->GetValue("telephone",($row),DB_DATA_TYPE_TEXT),"left");
		
		
		$pdf->addTextWrap(480,713,400,11,$rsE->GetValue("gve_soumission.lnumero",($row),DB_DATA_TYPE_TEXT),"left");
		$pdf->addTextWrap(480,698,400,11,$rsE->GetValue("gve_soumission.dinscrit",($row),DB_DATA_TYPE_DATE),"left");
		
		
		            /*
		                                    
		
 				  $lines = explode("\n",$rs->GetValue("remarques",($row),DB_DATA_TYPE_TEXT));
				  //$l_height=495;
				  $nb_line= 0;
				  $l_height=640;
				  foreach ($lines as $line){
				  	
				  		$nb++;
				  		$nb_line++;
				  		
				  			
				  		
				  		if(str_replace(" ","", $line)=="") {		
				  		} else {
							$pdf->addTextWrap(363,$l_height,1000,10,$line,"left");	
							$l_height=$l_height-10;												
				  		}
						  	
				  }	
				  	*/	
		
		
		
		$pdf->setColor(0,0,0);
$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica-Bold.afm');

		$pdf->addTextWrap(465,215,90,10,$rsE->GetValue("gve_soumission.fsoustotal",($row),DB_DATA_TYPE_MONEY),"right");

		$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica.afm');		

		$pdf->addTextWrap(465,197,90,10,$rsE->GetValue("gve_soumission.ftps",($row),DB_DATA_TYPE_MONEY),"right");
		$pdf->addTextWrap(465,177,90,10,$rsE->GetValue("gve_soumission.ftvq",($row),DB_DATA_TYPE_MONEY),"right");
		
$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica-Bold.afm');
		$pdf->addTextWrap(465,157,90,12,$rsE->GetValue("gve_soumission.ftotal",($row),DB_DATA_TYPE_MONEY),"right");
		
				$pdf->selectFont('/home/seahorse/core2/pdf/fonts/Helvetica.afm');		
		$pdf->setColor(0,0,0);
		$pdf->addTextWrap(50,58,500,12,"","left");
		$pdf->addTextWrap(50,40,500,12,"","left");
		
	//$pdf->addText(390,75,14,"LE DÉRURAL INC. 2",0);	
		
		$row++;
	  
}


$pdf->ezStream();


?>