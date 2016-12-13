<?php 
/*
Template Name: Briefing Detail
*/
get_header(); 
		//gegevens van dreamteamer/promoteamer ophalen
		global $wpdb; $current_user;
		get_currentuserinfo();
		
		$actID = $_GET['id'];
		$actDetails = $wpdb->get_row("SELECT * FROM Briefing WHERE ID = $actID" );
		
		 
				if(!empty($_GET['delml']) && !$_POST['briefing']){
					$wpdb->query( " DELETE FROM Briefing WHERE ID = ".$_GET['delml']." "  );
					?>
					<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
						Briefing met succes verwijderd!
					</div>
					<?php
					 } 
		
		
		
	
		
			 /* if($_POST['mail']){
				if(empty($_POST['naam'])){	$error .= "<li>Je bent een naam vergeten in te vullen</li>"; }
				
				if($_POST['activiteit'] == 'keuze'){	$error .= "<li>Je bent vergeten een maillijst te selecteren</li>";	}
				
				if(empty($error)){
					$wpdb->insert( Mailing, array( 'Naam' => $_POST['naam'], 'ListID' => $_POST['activiteit'], 'ActID' => $_GET['id']) );
					?>
					<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
						E-mail is met succes aangemaakt!
						</div>
					<?php 
				}
	
			}
			
			if(isset($_GET['stop'])){
				$wpdb->update( Activiteiten, array( 'Max_deelnemers' => '0'),array( 'ID' => $_GET['id']) ); 
				?>
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Aanmeldingen zijn gestopt!
				</div>
				<?php
			}
			
			//Annulerings e-mail versturen
			
			if(isset($_GET['ann']) && empty($actDetails2->annulering)){
				$ActID = $_GET['id'];
				annuleringsmail($ActID);
			}
			
			//Bevestigings e-mail versturen
			if(isset($_GET['bev']) && empty($actDetails2->bevestiging)){
				$ActID = $_GET['id'];
				bevestigingsmail($ActID);
			}


			//Enkele bevestigings e-mail versturen
			if(isset($_GET['enkelbev'])){
				$ActID = $_GET['id'];
				$StudID = $_GET['Studid'];
				bevestigingsmailEnkel($ActID,$StudID);
			}
			
			//mail versturen
			if(isset($_GET['send']) && !isset($_GET['reminder'])){
				$ListID = $_GET['send'];
				$ActID = $_GET['id'];
				$sendDate = $wpdb->get_row( "SELECT * FROM Maillijst WHERE ID = '".$ListID."'" );
				$toDay = date('Ymd');
				$mail = "";
				if($sendDate->SendDate != $toDay ){
					verzendMail($ListID,$ActID,$mail);
				}else{
					$foutMelding = "Je hebt deze mail vandaag al verstuurd!";
				}
			}
			
			//Reminder versturen
			if(isset($_GET['send']) && isset($_GET['reminder'])){
				$ListID = $_GET['send'];
				$ActID = $_GET['id'];
				$mail = "Reminder: ";
				$sendDate = $wpdb->get_row( "SELECT * FROM Maillijst WHERE ID = '".$ListID."'" );
				$toDay = date('Ymd');
				if($sendDate->SendDate != $toDay ){
					verzendMail($ListID,$ActID,$mail);
				}else{
					$foutMelding = "Je hebt deze reminder vandaag al verstuurd!";
				}
			}
			
			*/
			
			
			if($_GET['add'] == 'succes'){ ?>
	<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
		Briefing met succes toegevoegd!
	</div>
	<?php }
			
		 
					if($_POST['submit']){ 
			
				
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
				
					} // Einde IF statement




					if($_POST['submit'] && empty($error)){
					//Activiteit updaten
						$dbDate = date("Ymd", strtotime($_POST['datum']));
						$userData = get_userdata($_POST['contactpersoon']);
						
						$wpdb->update( Activiteiten, array( 'Titel' => $_POST['titel'], 'Datum' => $dbDate, 'Tijd_van' => $_POST['startTijd'], 'Tijd_tot' => $_POST['eindTijd'], 'Omschrijving' => $_POST['beschrijving'], 'Max_deelnemers' => $_POST['aantal'], 'Deadline' => $_POST['deadline'], 'ContactpersoonID' => $_POST['contactpersoon'],'Contactpersoon' => $userData->display_name, 'Contactemail' => $userData->user_email, 'Locatie' => $_POST['locatie'], 'Doelgroep' => $_POST['doelgroep'], 'Opmerkingen' => $_POST['opmerkingen'] ),array( 'ID' => $_GET['id']) ); 

						?>
						<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
						Activiteit is met succes aangepast!
						</div>
						<?php }
						
						if(!empty($foutMelding)){ ?>
							<div  style="width: 1150px;  background-color: #ef413d; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
								<?php echo $foutMelding; ?>
							</div>
						<?php }
		$actDetails = $wpdb->get_row("SELECT * FROM Activiteiten WHERE ID = $actID" );
	?><?php

	//Student hoeft zich aangemeld, maar hoeft niet te werken
	if(!empty($_GET['delete']) && !empty($_GET['studid']) &&  !empty($_GET['actid']) && !empty($_GET['dbID'])){
					//$wpdb->query(   "  DELETE FROM Aanmeldingen WHERE StudID = ".$_GET['studid']." AND ActID = ".$_GET['actid']." "  );
					//$wpdb->query(   "  DELETE FROM Maillijst WHERE ActID = ".$_GET['actid']." "  );
					$wpdb->update( Aanmeldingen, array( 'hoeftNiet' => '1' ),array( 'ID' => $_GET['dbID']) ); 
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Aanmelding omgezet naar "Hoeft niet te werken"
				</div>
				<?php } ?>
				
				<?php

				// Student stond op hoeft niet te werken, maar wordt nu alsnog ingeroosterd
				if(!empty($_GET['delete']) && !empty($_GET['studid']) &&  !empty($_GET['actid']) && !empty($_GET['dbID2'])){
					$wpdb->update( Aanmeldingen, array( 'hoeftNiet' => '' ),array( 'ID' => $_GET['dbID2']) ); 
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Aanmelding omgezet naar "Hoeft niet te werken"
				</div>
				<?php } ?>
				
				<?php
				if(!empty($_GET['deletemail']) && !empty($_GET['listid'])){

					$wpdb->query(   " DELETE FROM Maillijst WHERE ID = ".$_GET['listid']." "  );
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					E-mail met succes verwijderd!
				</div>
				<?php } ?>
	<div style="clear: both;"></div>
    
	<div id="contentLinks">
		<div class="contentHeader">
        <?php if(empty($_GET['edit']) || !empty($show) && empty($error)){ 
		
			$actDetails = $wpdb->get_row("SELECT * FROM Briefing WHERE ID = $actID" );
			
		}
		?>
        <h1><?php echo $actDetails->Titel; ?></h1>
			
			<div class="edit"><a href="https://www.expect-webmedia.nl/sur/briefing-detail/?id=<?php echo $actDetails->ID; ?>" id="refresh"><img src="<?php bloginfo('template_url'); ?>/images/iconRefresh.png" title="Ververs pagina"></a><?php if(!isset($_GET['edit'])){ ?><a href="https://www.expect-webmedia.nl/sur/briefing-detail/?id=<?php echo $actDetails->ID; ?>&edit=1" ><img src="<?php bloginfo('template_url'); ?>/images/edit.png" alt="" title="bewerk de gegevens" /></a><?php } ?><a href="https://www.expect-webmedia.nl/sur/briefing-detail/?delete=yes&id=<?php echo $actDetails->ID; ?>" ><img src="<?php bloginfo('template_url'); ?>/images/iconDelete.png" alt="" title="Verwijder activiteit" onclick="return confirm('Weet je zeker dat je deze activiteit wilt verwijderen?')"/></a></div>
		</div>
		<div class="contentContent">

		<?php if(empty($_GET['edit']) || !empty($show) && empty($error)){ 
		
			$actDetails = $wpdb->get_row("SELECT * FROM Briefing WHERE ID = $actID" );
		?>
					<table border="0" cellpadding="0" cellspacing="0">
				
                 <tr>
					<td valign="top">Omschrijving opdracht</td>
					<td valign="top">:</td>
					<td valign="top" ><?php echo $actDetails->Omschrijving; ?></td>
				</tr>
				<tr>
					<td valign="top">Datum</td>
					<td valign="top">:</td>
					<td valign="top"><?php mooiedatum($actDetails->Startdatum); ?></td>
				</tr>
				<tr>
					<td valign="top">Projectnummer</td>
					<td valign="top">:</td>
					<td valign="top" ><?php echo $actDetails->Projectnummer; ?></td>
				</tr>
               
				<tr>
					<td valign="top">Categorie</td>
					<td valign="top">:</td>
					<td valign="top"><?php echo $actDetails->Categorie; ?></td>
				</tr>
				<tr>
					<td valign="top">Correcties</td>
					<td valign="top">:</td>
					<td valign="top" ><?php echo $actDetails->Correcties; ?></td>
				</tr>
                <tr>
					<td valign="top">Datum correcties</td>
					<td valign="top">:</td>
					<td valign="top" >
					<?php 
				
					if(empty($actDetails->Einddatum)){ 
						echo "Niet van toepassing";
					}
					else{
						echo mooiedatum($actDetails->Einddatum);
					}
				?></td>
				</tr>
                
                <tr>
					<td valign="top">Uren</td>
					<td valign="top">:</td>
					<td valign="top" ><?php echo $actDetails->Uren; ?> uur</td>
				</tr>
                 <tr>
					<td valign="top">Locatie M: schijf</td>
					<td valign="top">:</td>
					<td valign="top" ><?php echo $actDetails->Locatie; ?></td>
				</tr>
                        
			</table><br /><br />
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top" width="130">Opdrachtgever</td>
					<td valign="top">:</td>
					<td valign="top"><?php echo $actDetails->Opdrachtgever; ?></a></td>
				</tr>
				<tr>
					<td valign="top">E-mailadres opdrachtgever</td>
					<td valign="top">:</td>
					<td valign="top"><a href="mailto:<?php echo $actDetails->Contactemail; ?>"><?php echo $actDetails->Contactemail; ?></a></td>
				</tr>
              
				
			</table>
			<?php }


				
			if(!empty($_GET['edit']) && !empty($_GET['id']) || empty($_GET['edit']) && !empty($error) && $_POST['submit']){ 
            $actDetails = $wpdb->get_row("SELECT * FROM Briefing WHERE ID = $actID" ); ?>

				<?php if($_POST['submit'] && !empty($error)){ ?>
				<div id="alert">
					<ul>
						<?php echo $error; ?>
					</ul>
				</div>
				<?php } ?>
				
				<form action="https://www.expect-webmedia.nl/sur/briefing-detail/?id=<?php echo $_GET['id'];?>&show=1 " method="post">
				Titel opdracht *<br />
				<input type="text" name="titel" value="<?php if(!isset($_POST['titel'])){ echo $actDetails->Titel; }else{ echo $_POST['titel'];} ?>" /><br /><br />
               	Datum *<br />
				<input type="text" name="startDatum" id="startDatum" value="<?php mooiedatum3($actDetails->Startdatum); ?>" /><br /><br />
                Projectnummer *<br />
				<input type="text" name="projectnummer" id="projectnummer" value="<?php echo $actDetails->Projectnummer; ?>" /><br /><br />
				Datum correcties<br />
				<input type="text" name="einddatum" id="einddatum" value="<?php mooiedatum3($actDetails->Einddatum); ?>" /><br /><br />
				Correcties *<br />
				<input type="text" name="correcties" id="correcties" value="<?php echo $actDetails->Correcties; ?>"/><br /><br />
				Locatie M:schijf *<br />
				<input type="text" name="locatie" value="<?php echo $actDetails->Locatie; ?>" /><br /><br />			
				Naam opdrachtgever: *<br />
				<input type="text" name="deadline" id="deadline" value="<?php echo $actDetails->Opdrachtgever; ?>" /><br /><br />		
				Korte omschrijving*<br />
				<textarea name="beschrijving"><?php echo $actDetails->Omschrijving; ?></textarea><br /><br /> 
				<a href="https://www.expect-webmedia.nl/sur/briefing-detail/?id=<?php echo $actDetails->ID; ?> ">Annuleren</a> <input type="submit" id="submit" name="submit" value="Briefing bijwerken">
			</form>
			<?php } ?>
		</div>
        </div>
        
        
        <div id="contentRechts">
		
		<div class="contentHeaderActief"><h1>Mijn voorgaande briefings</h1></div>
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
						echo "Je hebt nog geen Briefings";
					}
				?>
			</table>
		</div>
        
           <div class="button" onclick="location.href='https://www.expect-webmedia.nl/sur/wp-content/themes/beheertool/doc.php?id=<?php echo $actDetails->ID; ?>';">Download briefing
           </div>
         
	</div> 


    
  
<?php

get_footer();
