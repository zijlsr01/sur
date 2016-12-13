<?php  ob_start();
/*
Template Name: Briefing
*/


get_header();

				//connect to the database
				global $wpdb; $current_user;
				get_currentuserinfo();
				// 
				 $current_user = wp_get_current_user();
				 
				if(!empty($_GET['delml']) && !$_POST['briefing']){
					$wpdb->query( " DELETE FROM Briefing WHERE ID = ".$_GET['delml']." "  );
					?>
					<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
						Briefing met succes verwijderd!
					</div>
					<?php
					 } ?>
				
                <div style="clear: both;"></div>
                
                
                
                
                <?php // Berekening uren op basis selectie formulier
				
				$total = 0;
				
				// Bereken de uren subcatMail
					switch($_POST['subcatMail']) {
								 	
					case "MailBestaandeopmaak":
						$total =  1.50;
						break;				
					case "corMailBestaandeOpmaak":
						$total =  0.50;
						break;						
					case "mailNieuweOpmaak":
						$total =  3.00;
						break;
					case "corMailNieuweOpmaak":
						$total =  1.00;
						break;
					}
					
					
						// Bereken de uren subcatWebsitePanels
					switch($_POST['subcatWebsitePanels']) {
								 	
					case "singlecontentpanel":
						$total =  0.50;
						break;				
					case "multitab":
						$total =  1.00;
						break;						
					case "calltoaction":
						$total =  0.50;
						break;
					case "fotoalbumklein":
						$total =  1.00;
						break;
					case "fotoalbumgroot":
						$total =  1.50;
						break;
					case "videopanel":
						$total =  0.50;
						break;		
					}
					
					
					// Bereken de uren subcatWebsiteLP
					switch($_POST['subcatWebsiteLP']) {
								 	
					case "landingspagina":
						$total =  2.00;
						break;				
					case "landingspaginaCor":
						$total =  0.50;
						break;						
					}
					
					// Bereken de uren subcatWebsiteForm
					switch($_POST['subcatWebsiteForm']) {
								 	
					case "formulierNieuw":
						$total =  1.00;
						break;				
					case "formulierBestaand":
						$total =  0.50;
						break;		
					case "crmFormulierNieuw":
						$total =  1.50;
						break;								
					case "crmFormulierBestaand":
						$total =  1.00;
						break;						
									
					}
					
					// Bereken de uren subcatWebsiteTekst
					switch($_POST['subcatWebsiteTekst']) {
								 	
					case "webTekstOpleiding":
						$total =  5.00;
						break;				
					case "webTekstCursus":
						$total =  2.50;
						break;		
					case "webTekstPagina":
						$total =  2.00;
						break;								
					case "webTekstBestaand":
						$total =  0.50;
						break;						
									
					}
							
					// Bereken de uren subcatBanners
					switch($_POST['subcatBanners']) {
								 	
					case "bannersetBestaandeOpmaak":
						$total =  4.00;
						break;				
					case "bannersetNieuweOpmaak":
						$total =  5.00;
						break;		
					case "facebookBannerBestaandeOpmaak":
						$total =  0.50;
						break;								
					case "facebookBannerNieuweOpmaak":
						$total =  1.00;
						break;						
									
					}
					
					// Bereken de uren subcatEnquete
					switch($_POST['subcatEnquete']) {
							 	
					case "bestaandeEnquete":
						$total =  1.00;
						break;				
					case "nieuweEnquete":
						$total =  3.00;
						break;												
					}
					
					// Bereken de uren subcatNarrowcasting
					switch($_POST['subcatNarrowcasting']) {
								 	
					case "bestaandeNarrowcasting":
						$total =  0.50;
						break;				
					case "nieuweNarrowcasting":
						$total =  1.00;
						break;												
					}
					
					// Bereken de uren subcatOverig
					switch($_POST['subcatOverig']) {
								 	
					case "videoYoutube":
						$total =  1.00;
						break;															
					}
					
					
					// Bereken de uren correcties
					switch($_POST['correcties']) {
								 	
					case "Ja":
						$total +=  0.50;
						break;			
					case "Nee":
						$total +=  0.00;
						break;														
					}
					
				?>
								
								
	<div id="contentLinks">
		
        <div class="contentHeader">
			<h1>Contentbeheer</h1>
		</div>
        
		<div class="contentContent input-list style-1 clearfix">
			<p><B>Briefing contentbeheer</B></p>
			<?php 
				//kijken of er fouten zijn gemaakt
				if(empty($_POST['titel'])){	$error .= "<li>Je bent vergeten de titel in te vullen</li>";	}
				if(empty($_POST['projectnummer'])){	$error .= "<li>Je bent vergeten het projectnummer in te vullen</li>";	}
				if(empty($_POST['startDatum'])){	$error .= "<li>Je bent vergeten een datum in te vullen</li>";	}
				if(empty($_POST['beschrijving'])){	$error .= "<li>Je bent vergeten een beschrijving in te vullen</li>";}
				if(empty($_POST['opdrachtgever'])){ $error .= "<li>Je bent vergeten je naam in te vullen</li>";	}
				if(empty($_POST['correcties'])){ $error .= "<li>Je bent vergeten het Correcties veld in te vullen</li>";	}
				if(empty($_POST['emailopdrachtgever'])){	$error .= "<li>Je bent vergeten je e-mailadres in te vullen</li>";	}
				if($_POST['categorie'] == 'keuze'){	$error .= "<li>Je bent vergeten een categorie te kiezen</li>";	}
				if($_POST['categorie'] == 'website' && $_POST['subcatWebsite'] == 'keuze'){ $error .= "<li>Je bent vergeten om de subcategorie Website in te vullen</li>";}
				if($_POST['categorie'] == 'website' && $_POST['subcatWebsite'] == 'panels' && $_POST['subcatWebsitePanels'] == 'keuze'){ $error .= "<li>Je bent vergeten om een panel te kiezen</li>";}
				if($_POST['categorie'] == 'website' && $_POST['subcatWebsite'] == 'landingspagina' && $_POST['subcatWebsiteLP'] == 'keuze'){ $error .= "<li>Je bent vergeten om een keuze te maken qua landingspagina</li>";}
				if($_POST['categorie'] == 'website' && $_POST['subcatWebsite'] == 'formulier' && $_POST['subcatWebsiteForm'] == 'keuze'){ $error .= "<li>Je bent vergeten om een keuze te maken qua formulier</li>";}
				
				if($_POST['categorie'] == 'website' && $_POST['subcatWebsite'] == 'webtekst' && $_POST['subcatWebsiteText'] == 'keuze'){ $error .= "<li>Je bent vergeten om een keuze te maken qua webtekst</li>";}
				
				
				
				

				
				if($_POST['categorie'] == 'mail' && $_POST['subcatMail'] == 'keuze'){ $error .= "<li>Je bent vergeten om de subcategorie Mail in te vullen</li>";	}
				if($_POST['categorie'] == 'banners' && $_POST['subcatBanners'] == 'keuze'){ $error .= "<li>Je bent vergeten om de subcategorie Banners in te vullen</li>";	}
				if($_POST['categorie'] == 'enquete' && $_POST['subcatEnquete'] == 'keuze'){ $error .= "<li>Je bent vergeten om de subcategorie Enquete in te vullen</li>";	}
				if($_POST['categorie'] == 'narrowcasting' && $_POST['subcatNarrowcasting'] == 'keuze'){ $error .= "<li>Je bent vergeten om de subcategorie Narrowcasting in te vullen</li>";	}
				if($_POST['categorie'] == 'overig' && $_POST['subcatOverig'] == 'keuze'){ $error .= "<li>Je bent vergeten om de subcategorie Overig te vullen</li>";	}
				

					

				if(isset( $_POST['submit'] ) && !empty($error)){ ?>
					<div id="alert">
						<ul>
							<?php echo $error; ?>
						</ul>
					</div>
				<?php }
				

				//als er geen fouten gemaakt zijn dan zetten we de gegevens in de database en geven we een succesmelding
				if($_POST['submit'] && empty($error)){
					$dbDate = date("Ymd", strtotime($_POST['startDatum']));
					$dbDate2 = date("Ymd", strtotime($_POST['eindDatum']));
					$contactID =  $current_user->ID;
					$actKey = date('YmdB').$contactID;
					
					
					// Conditioner om alleen correcties datum naar DB te schrijven wanneer nodig
					
					if($_POST['correcties'] == 'Ja'){
					$datumCor = $dbDate2;
					}
					
					
					
					//Conditioner voor schrijven subcategorie naar database
					
					if($_POST['categorie'] == 'mail'){
						$subCat= $_POST['subcatMail'];
					}		
					if($_POST['categorie'] == 'website'){
						$subCat= $_POST['subcatWebsite']; 
					}		
					if($_POST['categorie'] == 'banners'){
						$subCat= $_POST['subcatBanners'];
					}
					if($_POST['categorie'] == 'enquete'){
						$subCat= $_POST['subcatEnquete'];
					}
					if($_POST['categorie'] == 'narrowcasting'){
						$subCat= $_POST['subcatNarrowcasting'];
					}
					if($_POST['categorie'] == 'overig'){
						$subCat= $_POST['subcatOverig'];
					}
					
					//Conditioner voor schrijven Subsubcategorie naar database
							
					
					//SUBSUB Website
						
					if($_POST['subcatWebsite'] == 'panels'){
					$subsubCat= $_POST['subcatWebsitePanels'];
					}
					if($_POST['subcatWebsite'] == 'landingspagina'){
					$subsubCat= $_POST['subcatWebsiteLP'];
					}
					if($_POST['subcatWebsite'] == 'webtekst'){
					$subsubCat= $_POST['subcatWebsiteTekst'];
					}
					if($_POST['subcatWebsite'] == 'formulier'){
					$subsubCat= $_POST['subcatWebsiteForm'];
					}
					
		
					$wpdb->insert('Briefing', array( 'Titel' => $_POST['titel'],'Projectnummer' => $_POST['projectnummer'], 'Startdatum' => $dbDate, 'Einddatum' => $datumCor, 'Correcties' => $_POST['correcties'], 'Omschrijving' => $_POST['beschrijving'], 'Categorie' => $_POST['categorie'], 'SubCategorie' => $subCat, 'SubSubcategorie'=> $subsubCat, 'ContactpersoonID' => $current_user->ID ,'Opdrachtgever' => $_POST['opdrachtgever'], 'Contactemail' => $_POST['emailopdrachtgever'], 'Locatie' => $_POST['locatie'],/*'Uren' => $_POST['uren'],*/ 'Uren' => $total, 'actKey' => $actKey ) ); 
					$briefingDetails = $wpdb->get_row("SELECT * FROM Briefing WHERE actKey = $actKey" );
					$url = "https://www.expect-webmedia.nl/sur/briefing-detail/?id=".$briefingDetails->ID;
					wp_redirect( $url.'&add=succes' ); exit;
					
					
					
					
				}
			?>

			<?php 
				if(!isset( $_POST['submit'] ) || !empty($error)){ 
					get_currentuserinfo();
					?>
                    
                   
                   
                
                
                <form id="briefingcontent" action="" method="post">
                
                Titel opdracht*<br />
				<input type="text" name="titel" required value="<?php echo $_POST['titel']; ?>" /><br /><br />
                     
				Datum *<br />
				<input type="text" name="startDatum" required  id="datum" value="<?php echo $_POST['startDatum']; ?>" /><br /><br />
                    
                Projectnummer*<br />
				<input type="text" name="projectnummer" required value="<?php echo $_POST['projectnummer;']; ?>" /><br /><br />   

                Categorie *<br />
				<select name="categorie" onchange="calculateTotal();" required >
					<option value="keuze" <?php if($_POST['categorie'] == "keuze"){ ?> selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="mail" <?php if($_POST['categorie'] == "mail"){ ?> selected="selected"<?php } ?>>Mail</option>
					<option value="website" <?php if($_POST['categorie'] == "website"){ ?> selected="selected" <?php } ?>>Website</option>
					<option value="banners" <?php if($_POST['categorie'] == "banners"){ ?> selected="selected"<?php } ?>>Banners</option>
					<option value="enquete" <?php if($_POST['categorie'] == "enquete"){ ?>selected="selected"<?php } ?>>Enquete</option>
					<option value="narrowcasting" <?php if($_POST['categorie'] == "narrowcasting"){ ?>selected="selected"<?php } ?>>Narrowcasting</option>
                    <option value="overig" <?php if($_POST['categorie'] == "overig"){ ?>selected="selected"<?php } ?>>Overig</option>
				</select><br /><br />
                
                 <div id="subcatMail" style="display:none"> 
                
                Subcategorie Mail *<br />
                
				<select name="subcatMail" onchange="calculateTotal();">
					<option value="keuze" <?php if($_POST['subcatMail'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="mailBestaandeOpmaak" <?php if($_POST['subcatMail'] == "mailBestaandeOpmaak"){ ?>selected="selected"<?php } ?>>Opmaak mail - bestaande opmaak
</option>
					<option value="corMailBestaandeOpmaak" <?php if($_POST['subcatMail'] == "corMailBestaandeOpmaak"){ ?>selected="selected"<?php } ?>>Correcties mail bestaande opmaak
</option>
					<option value="mailNieuweOpmaak" <?php if($_POST['subcatMail'] == "mailNieuweOpmaak"){ ?>selected="selected"<?php } ?>>Opmaak mail - nieuwe opmaak
</option>
                    <option value="corMailNieuweOpmaak" <?php if($_POST['subcatMail'] == "corMailNieuweOpmaak"){ ?>selected="selected"<?php } ?>>Correcties mail - nieuwe opmaak
</option>
				</select><br /><br />
                
                </div>
                
        
                
                <div id="subcatWebsite" style="display:none"> 
                
                Subcategorie Website *<br />
				<select name="subcatWebsite" onchange="calculateTotal();">
					<option value="keuze" <?php if($_POST['subcatWebsite'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="kleineAanpassing" <?php if($_POST['subcatWebsite'] == "kleineAanpassing"){ ?>selected="selected"<?php } ?>>Kleine aanpassing (foto wijzigen, PDF, min tekstwijz, agenda-item, nieuwsbericht)</option>
					<option value="panels" <?php if($_POST['subcatWebsite'] == "panels"){ ?>selected="selected"<?php } ?>>Panels</option>
                    <option value="landingspagina" <?php if($_POST['subcatWebsite'] == "landingspagina"){ ?>selected="selected"<?php } ?>>Landingspagina</option>
					<option value="webtekst" <?php if($_POST['subcatWebsite'] == "webtekst"){ ?>selected="selected"<?php } ?>>Webtekst</option>
					<option value="formulier" <?php if($_POST['subcatWebsite'] == "formulier"){ ?>selected="selected"<?php } ?>>Formulier</option>
				</select><br /><br />
                
                </div>
                
                 <div id="subcatWebsitePanels" style="display:none"> 
                
                Panels *<br />
				<select name="subcatWebsitePanels" onchange="calculateTotal(); document.getElementById('preview').src = 'https://www.expect-webmedia.nl/sur/wp-content/themes/beheertool/images/'+this.value+'.jpg'">
					<option value="keuze" <?php if($_POST['subcatWebsitePanels'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="singlecontentpanel" <?php if($_POST['subcatWebsitePanels'] == "singlecontentpanel"){ ?>selected="selected"<?php } ?>>Single content panel</option>
					<option value="multitab" <?php if($_POST['subcatWebsitePanels'] == "multitab"){ ?>selected="selected"<?php } ?>>Multitab</option>
					<option value="calltoaction" <?php if($_POST['subcatWebsitePanels'] == "calltoaction"){ ?>selected="selected"<?php } ?>>Call to action</option>
					<option value="fotoalbumklein" <?php if($_POST['subcatWebsitePanels'] == "fotoalbumklein"){ ?>selected="selected"<?php } ?>>Foto album (minder dan 25 foto's)</option>
					<option value="fotoalbumgroot" <?php if($_POST['subcatWebsitePanels'] == "fotoalbumgroot"){ ?>selected="selected"<?php } ?>>Foto album (meer dan 25 foto's)</option>
                    <option value="videopanel" <?php if($_POST['subcatWebsitePanels'] == "videopanel"){ ?>selected="selected"<?php } ?>>Video panel</option>
	
				</select><br /><br /> 
                </div>
                

                <div id="subcatWebsiteLP" style="display:none"> 
                
                Landingspagina *<br />
				<select name="subcatWebsiteLP" onchange="calculateTotal();">
					<option value="keuze" <?php if($_POST['subcatWebsiteLP'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="landingspagina" <?php if($_POST['subcatWebsiteLP'] == "landingspagina"){ ?>selected="selected"<?php } ?>>Maken landingspagina</option>
					<option value="landingspaginaCor" <?php if($_POST['subcatWebsiteLP'] == "landingspaginaCor"){ ?>selected="selected"<?php } ?>>Correcties landingspagina</option>
                 </select><br /><br />
                 </div>
                    
                
                <div id="subcatWebsiteForm" style="display:none"> 
                
                Formulier *<br />
				<select name="subcatWebsiteForm" onchange="calculateTotal();">
					<option value="keuze" <?php if($_POST['subcatWebsiteForm'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="formulierNieuw" <?php if($_POST['subcatWebsiteForm'] == "formulierNieuw"){ ?>selected="selected"<?php } ?>>Formulier - Nieuw</option>
					<option value="formulierBestaand" <?php if($_POST['subcatWebsiteForm'] == "formulierBestaand"){ ?>selected="selected"<?php } ?>>Formulier - op basis bestaand</option>
                    <option value="crmFormulierNieuw" <?php if($_POST['subcatWebsiteForm'] == "crmFormulierNieuw"){ ?>selected="selected"<?php } ?>>CRM Formulier - Nieuw</option>
					<option value="crmFormulierBestaand" <?php if($_POST['subcatWebsiteForm'] == "crmFormulierBestaand"){ ?>selected="selected"<?php } ?>>CRM Formulier - op basis bestaand</option>
				</select><br /><br /> 
                </div>
                
                
                   <div id="subcatWebsiteTekst" style="display:none"> 
                
                Subcategorie webtekst *<br />
				<select name="subcatWebsiteTekst" onchange="calculateTotal();">
					<option value="keuze" <?php if($_POST['subcatWebsiteTekst'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="webTekstOpleiding" <?php if($_POST['subcatWebsiteTekst'] == "webTekstOpleiding"){ ?>selected="selected"<?php } ?>>Webtekst nieuwe opleiding</option>
					<option value="webTekstCursus" <?php if($_POST['subcatWebsiteTekst'] == "webTekstCursus"){ ?>selected="selected"<?php } ?>>Webtekst invoeren nieuwe cursus</option>
                    <option value="webTekstPagina" <?php if($_POST['subcatWebsiteTekst'] == "webTekstPagina"){ ?>selected="selected"<?php } ?>>Webtekst nieuwe algemene pagina</option>
					<option value="webTekstBestaand" <?php if($_POST['subcatWebsiteTekst'] == "webTekstBestaand"){ ?>selected="selected"<?php } ?>>Webtekst wijzigen algemene pagina</option>
				</select><br /><br /> 
                </div>
                

             <div id="subcatBanners" style="display:none" > 
                        
             Subcategorie Banners *<br />
            <select name="subcatBanners" onchange="calculateTotal();">
                <option value="keuze" <?php if($_POST['subcatBanners'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
                <option value="bannersetBestaandeOpmaak" <?php if($_POST['subcatBanners'] == "bannersetBestaandeOpmaak"){ ?>selected="selected"<?php } ?>>
                Bannerset - bestaande opmaak</option>
                <option value="bannersetNieuweOpmaak" <?php if($_POST['subcatBanners'] == "bannersetNieuweOpmaak"){ ?>selected="selected"<?php } ?>>
                Bannerset - nieuwe opmaak</option>
                <option value="facebookBannerBestaandeOpmaak" <?php if($_POST['subcatBanners'] == "facebookBannerBestaandeOpmaak"){ ?>selected="selected"<?php } ?>>										        Facebookbanner - bestaande opmaak</option>
                <option value="facebookBannerNieuweOpmaak" <?php if($_POST['subcatBanners'] == "facebookBannerNieuweOpmaak"){ ?>selected="selected"<?php } ?>>Facebook banner - nieuwe opmaak</option>                     
            </select>
            <br /><br />
                
                </div>
                
                
      <div id="subcatEnquete" style="display:none"> 
                
        Subcategorie Enquete *<br />
		<select name="subcatEnquete" onchange="calculateTotal();" >
			<option value="keuze" <?php if($_POST['subcatEnquete'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
			<option value="bestaandeEnquete" <?php if($_POST['subcatEnquete'] == "bestaandeEnquete"){ ?>selected="selected"<?php } ?>>Enquete - bestaande opmaak</option>
			<option value="nieuweEnquete" <?php if($_POST['subcatEnquete'] == "nieuweEnquete"){ ?>selected="selected"<?php } ?>>Enquete - nieuwe opmaak</option>
		</select><br /><br />
                
       </div>
                
                <div id="subcatNarrowcasting" style="display:none"> 
                
                Subcategorie Narrowcasting *<br />
				<select name="subcatNarrowcasting" onchange="calculateTotal();" >
					<option value="keuze" <?php if($_POST['subcatNarrowcasting'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="bestaandeNarrowcasting" <?php if($_POST['subcatNarrowcasting'] == "bestaandeNarrowcasting"){ ?>selected="selected"<?php } ?>>Narrowcasting - bestaande opmaak</option>
					<option value="nieuweNarrowcasting" <?php if($_POST['subcatNarrowcasting'] == "nieuweNarrowcasting"){ ?>selected="selected"<?php } ?>>Narrowcasting - nieuwe opmaak</option>
                   
					
				</select><br /><br />
                
                </div>
                
                 <div id="subcatOverig" style="display:none"> 
                
                Subcategorie Overig *<br />
				<select name="subcatOverig" onchange="calculateTotal();" >
					<option value="keuze" <?php if($_POST['subcatOverig'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="videoYoutube" <?php if($_POST['subcatOverig'] == "videoYoutube"){ ?>selected="selected"<?php } ?>>Youtube - video uploaden</option>    
				</select><br /><br />
                
                </div>
                
                <div id="correcties"> 
                
                Correcties*<br />
				<select name="correcties" required onchange="calculateTotal();" >
					<option value="keuze" <?php if($_POST['correcties'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
                    <option value="Ja" <?php if($_POST['correcties'] == "Ja"){ ?>selected="selected"<?php } ?>>Ja</option>
					<option value="Nee" <?php if($_POST['correcties'] == "Nee"){ ?>selected="selected"<?php } ?>>Nee</option>    
				</select><br /><br />
                
               </div>
               
               <div id="datumCorrecties" style="display:none"> 
               
                Datum correcties *<br />
                
				<input type="text" name="eindDatum" id="datumNew" value="<?php echo $_POST['eindDatum']; ?>" /><br /><br />
                </div>
                
                Naam opdrachtgever *<br />
				<input type="text" required name="opdrachtgever" value="<?php if(!isset($_POST['opdrachtgever'])){ echo $current_user->display_name; }else{ echo $_POST['opdrachtgever'];} ?>" /><br /><br />
                
                E-mail opdrachtgever *<br />
				<input type="e-mail" required name="emailopdrachtgever" value="<?php if(!isset($_POST['emailopdrachtgever'])){ echo $current_user->user_email; }else{ echo $_POST['emailopdrachtgever'];} ?>" /><br /><br />
                
                  Korte omschrijving *<br />
				<textarea name="beschrijving" rows="3" cols="30"><?php echo $_POST['beschrijving']; ?></textarea><br /><br />  
                		
				Projectmap op de (M:) schijf<br />
				<input type="text" name="locatie" value="<?php echo $_POST['locatie']; ?>" /><br /><br />
                <input type="hidden" name="uren" value="" id="myField" /><br /><br />
                
                
           		<!-- deze div wordt gebruikt om de juiste input te vragen per geselecteerde opdracht -->
			    <div id="briefingInput" style="display:none">
                
                <p>Lever een complete briefing met de volgende elementen:
                
                - Inhoud (tekst), afbeeldingen meesturen per blok, tekst voor in buttons, links meesturen
                </p>

                </div>   
                             
                <!-- <div id="totaalUren" style="background:#FF0; color:#000; font-size:16px" ></div>-->	
                
               

				<input type="submit" id="submit" name="submit" value="Briefing versturen">
			
            </form>

			<?php } ?>
      
		</div>
	</div>

	<div id="contentRechts">
            
         <div class="contentHeaderActief">
			<h1>Voorbeeldweergave</h1>
		 </div>
        
        <div id="test-afbeelding">
 			 <img id="preview"><br />
		</div>
	
	<div class="contentHeaderActief">
			<h1>Reeds ingeplande briefings</h1>
		</div>
		<div class="contentContent">
		<table border="0" cellpadding="5" cellspacing="3">
				<?php 
				global $wpdb;
				$briefings2 = $wpdb->get_results( "SELECT * FROM Briefing WHERE ContactpersoonID = $current_user->ID ORDER BY ID DESC");
				foreach( $briefings2 as $briefing2 ){ 
				$onderwerp = substr($briefing2->Titel, 0, 50);
				?>
							<tr >
								<td valign="top" width="500" title="Een briefing"> <B>&nbsp;&nbsp;<a href="https://www.expect-webmedia.nl/sur/briefing-detail/?id=<?php echo $briefing2->ID; ?>"><?php echo $onderwerp; ?></a></B></td>
								<td valign="top"><a href="https://www.expect-webmedia.nl/sur/briefing-contentbeheer/?delml=<?php echo $briefing2->ID; ?>"  onclick="return confirm('Weet je zeker dat je deze Briefing wil verwijderen?')">X</a></td>
							</tr>
				<?php } 
				
					if(empty($briefings2)){ 
						echo "Je hebt nog geen E-mails";
					}
				?>
			</table>
		</div>
        
        
        <div class="contentHeaderZoeken">
					<h1>Zoek (voorgaande) briefings</h1>
				</div>
				<div class="contentContent">
					<form method="post" id="search">
						<input type="text" value="" id="searchDream" name="keyWord">
						<input type="submit" value="Zoeken!" name="submit2" id="searchSubmit">
					</form>
                    
					<?php if($_POST['submit2']){
						global $wpdb;
						$keyWord = $_POST['keyWord'];
						$zoekresultaten = $wpdb->get_results( "SELECT * FROM Briefing WHERE Titel LIKE '%".$keyWord."%' OR Opdrachtgever LIKE '%".$keyWord."%' ORDER BY ID DESC" );
						$aantal = $wpdb->get_var( " SELECT COUNT(*) FROM Briefing WHERE Titel LIKE '%".$keyWord."%' OR Opdrachtgever LIKE '%".$keyWord."%'"); 
						?><h3>Zoekresultaten voor <i>&quot;<?php echo $_POST['keyWord']; ?>&quot;</i> (<?php echo $aantal; ?>)</h3>
						<table cellpadding="5" cellspacing="0" border="0">
						<?php
						foreach( $zoekresultaten as $zoekresultaat ){ ?>
							<tr >
								<td valign="top" width="120" class="date"> <B>&nbsp;&nbsp;<?php mooiedatum($zoekresultaat->Startdatum); ?></B></td>
								<td valign="top">&nbsp;</td>
								<td valign="top"><a href="https://www.expect-webmedia.nl/sur/briefing-detail?id=<?php echo $zoekresultaat->ID; ?>"><?php echo $zoekresultaat->Titel; ?></a></td>
							</tr>
						<?php }

						if(empty($zoekresultaten)){
							echo "Er zijn geen zoekresultaten<br />";
						}
					}
					?>
					</table>
				</div>
        
        
        
        
        
        
        
        </div>
        
        
        
				

<?php

get_footer(); ob_end_flush(); ?>