<?php require('../../../../wp-blog-header.php'); 
	if($_GET['secure'] == '098012378929'){
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM Beheertool WHERE Actief != 'Nee'" );
			
		$filename ="exportStudenten.xls";
		//$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		//echo $contents;
		$i = 0;
		if($i == 0 ){
				$contents = "ID \t Voornaam \t Tussenvoegsel \t Achternaam \t Type Overeenkomst \t Geslacht \t Emailadres \t Geboortedatum \t Adres \t Huisnummer \t Postcode \t Woonplaats \t Telefoonnummer \t Mobiel \t Opleiding \t Maat \t Rijbewijs \t Afwezig van \t Afwezig tot \t Opmerkingen \t IBAN \t Studentnummer \t Studiejaar \t Loonheffing \t Talentworkshop \t Rondleiding \t Vooropleiding \t Ingang_loonheffing \t Contract van \t Contract tot \t BSN \t Actief \t Persoonlijke code \n";
				echo $contents;
				$i++;
			}
		foreach( $results as $result ){
			
				$contents = $result->ID."\t".$result->Voornaam."\t".$result->Tussenvoegsel."\t".$result->Achternaam."\t".$result->Type_overeenkomst."\t".$result->Geslacht."\t".$result->Emailadres."\t".$result->Geboortedatum."\t".$result->Adres."\t".$result->Huisnummer."\t".$result->Postcode."\t".$result->Woonplaats."\t".$result->Telefoonnummer."\t".$result->Mobiel."\t".$result->Opleiding."\t".$result->Maat."\t".$result->Rijbewijs."\t".$result->Afwezig_van."\t".$result->Afwezig_tot."\t".$result->Opmerkingen."\t".$result->IBAN."\t".$result->Studentnr."\t".$result->Studiejaar."\t".$result->Loonheffing."\t".$result->Talentworkshop."\t".$result->Rondleiding."\t".$result->Vooropleiding."\t".$result->Ingang_loonheffing."\t".$result->Contract_van."\t".$result->Contract_tot."\t".$result->BSN."\t".$result->Actief."\t".$result->Perskey."\n";
				echo $contents;
				$i++;
			
		}
	}
  
?>