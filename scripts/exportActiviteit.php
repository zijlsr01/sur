<?php require('../../../../wp-blog-header.php'); 
	if($_GET['secure'] == '0999897965' && !empty($_GET['actid'])){
		global $wpdb;
		$ActID = $_GET['actid'];
		$results = $wpdb->get_results( "SELECT * FROM Aanmeldingen WHERE ActID = $ActID AND Afwezig != 'afwezig' AND Afwezig != 'afwezig2' AND hoeftNiet != '1' " );
			
		$actName = $wpdb->get_var( "SELECT Titel FROM Activiteiten WHERE ID = $ActID" );
		$filename = "aanmeldingen.xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $contents;
		$i = 0;
		if($i == 0 ){
				$contents = "Voornaam \t Tussenvoegsel \t Achternaam \t Geslacht \t Emailadres \t Telefoonnummer \t Mobiel \t Opleiding \t Maat \t Rijbewijs \t Studentnummer \t Studiejaar \t Talentworkshop \t Rondleiding \n";
				echo $contents;
				$i++;
			}
		foreach( $results as $result ){
				
				$StudID = $result->StudID;
				$studentInfo = $wpdb->get_row("SELECT * FROM Beheertool WHERE ID = $StudID" );
					
				$contents = $studentInfo->Voornaam."\t".$studentInfo->Tussenvoegsel."\t".$studentInfo->Achternaam."\t".$studentInfo->Geslacht."\t".$studentInfo->Emailadres."\t".$studentInfo->Telefoonnummer."\t".$studentInfo->Mobiel."\t".$studentInfo->Opleiding."\t".$studentInfo->Maat."\t".$studentInfo->Rijbewijs."\t".$studentInfo->Studentnr."\t".$studentInfo->Studiejaar."\t".$studentInfo->Talentworkshop."\t".$studentInfo->Rondleiding."\n";
				echo $contents;
			
				$i++;
			
		}
	}
  
?>