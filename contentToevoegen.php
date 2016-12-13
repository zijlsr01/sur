<?php  ob_start();
/*
Template Name: Content toevoegen
*/


get_header();

				//connect to the database
				global $wpdb; $current_user;
				get_currentuserinfo();				
				$current_user = wp_get_current_user();
				
				if(!empty($_GET['copy'])){
					$copyCampgne = $wpdb->get_row( "SELECT * FROM Content WHERE ID = '".$_GET['copy']."'" );
				}
	
				if(!empty($_GET['delete'])){
					$actDetails = $wpdb->get_row("SELECT * FROM Activiteiten WHERE ID = ".$_GET['id']."" );
					$wpdb->query(   "  DELETE FROM Activiteiten WHERE ID = ".$_GET['id']." "  );
					$wpdb->query(   "  DELETE FROM Aanmeldingen WHERE ActID = ".$_GET['id']." "  );
					$wpdb->query(   "  DELETE FROM Maillijst WHERE ActID = ".$_GET['id']." "  );
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Activiteit met succes verwijderd!
				</div>
				<?php } ?>
				<div style="clear: both;"></div>
	<div id="contentLinks">
		<div class="contentHeaderContent">
		<div class="contentHeaderIcon" style="margin-top: 5px;"><img src="<?php bloginfo('template_url'); ?>/images/iconAdd.png " alt=""></div>
			<h1>Campagne aanmaken</h1>
		</div>
		<div class="contentContentdr">
			<?php 
				//kijken of er fouten zijn gemaakt
				if(empty($_POST['titel'])){	$error .= "<li>Je bent vergeten de titel in te vullen</li>";	}
				if(empty($_POST['startTijd'])){	$error .= "<li>Je bent vergeten een startdatum in te vullen</li>";	}
				if(empty($_POST['eindTijd'])){	$error .= "<li>je bent vergeten een einddatum in te vullen</li>";}
				if(empty($_POST['beschrijving'])){	$error .= "<li>Je bent vergeten een beschrijving in te vullen</li>";}
				if(empty($_POST['kanaal'])){	$error .= "<li>Je bent vergeten een kanaal toe te voegen</li>";}
				if(empty($_POST['contactpersoon'])){ $error .= "<li>Je bent vergeten een contactpersoon in te vullen</li>";	}
				if(empty($_POST['camURL'])){ $error .= "<li>Je bent vergeten de url van de landingspagina in te vullen</li>";	}
				if(empty($_POST['emailcontactpersoon'])){	$error .= "<li>Je bent vergeten een e-mailadres van een contactpersoon in te vullen</li>";	}
				if($_POST['doelgroep'] == 'keuze'){	$error .= "<li>Je bent vergeten een doelgroep in te vullen</li>";	}

					

				if(isset( $_POST['submit'] ) && !empty($error)){ ?>
					<div id="alert">
						<ul>
							<?php echo $error; ?>
						</ul>
					</div>
				<?php }
				

				//als er geen fouten gemaakt zijn dan zetten we de gegevens in de database en geven we een succesmelding
				if($_POST['submit'] && empty($error)){
					$startD = date("Ymd", strtotime($_POST['startTijd']));
					$eindD = date("Ymd", strtotime($_POST['eindTijd']));
					$contactID =  $current_user->ID;
					$actKey = date('YmdB').$contactID;
					$kanalen = implode(",", $_POST['kanaal']);
					$kleur = "#f02845";
					$Jaar = substr($eindD, 0, 6);
					$camName = preg_replace('/\s+/', '', $_POST['titel']);
					$utmCamName = $Jaar.$camName;
					$campagneType = "Campagne";
					$wpdb->insert( Content, array( 'Titel' => $_POST['titel'],'type' => $campagneType, 'Tijd_van' => $startD, 'Tijd_tot' => $eindD, 'Omschrijving' => $_POST['beschrijving'], 'Kanalen' => $kanalen, 'ContactpersoonID' => $current_user->ID ,'Contactpersoon' => $_POST['contactpersoon'], 'Contactemail' => $_POST['emailcontactpersoon'], 'Doelgroep' => $_POST['doelgroep'], 'Opmerkingen' => $_POST['opmerkingen'], 'kleur' => $kleur, 'actKey' => $actKey, 'CampagnePage' => $_POST['camURL'], 'campagneCode' => $utmCamName ) ); 
					
					$studNr = $_POST['studnr'];
					$ActDetails = $wpdb->get_row("SELECT * FROM Content WHERE actKey = $actKey" );
					$url = "https://www.expect-webmedia.nl/sur/contentdetail/?id=".$ActDetails->ID;
					wp_redirect( $url.'&add=succes' ); exit;
				}
			?>

			<?php 
				if(!isset( $_POST['submit'] ) || !empty($error)){ 
					get_currentuserinfo();
					$kanalen = $wpdb->get_results( "SELECT * FROM Kanalen" );
					
					if(!$_POST['submit'] && !empty($_GET['copy'])){ ?>
						<a href="/sur/content-toevoegen"><img src="<?php bloginfo('template_url'); ?>/images/iconCopyStop.png" alt="" title="Annuleer Kopieeractie" style="margin-bottom: 20px; border: 0px;"></a>
					<?php }
					
					?>
			<form action="" method="post">
				Naam campagne *<br />
				<input type="text" name="titel" value="<?php if($_POST['submit']){ echo $_POST['titel']; } if(!$_POST['submit'] && !empty($_GET['copy'])){ echo $copyCampgne->Titel; } ?>" /><br /><br />
				Startdatum<br />
				<input type="text" name="startTijd" id="startDate" value="<?php if($_POST['submit']){ echo $_POST['startTijd']; } if(!$_POST['submit'] && !empty($_GET['copy'])){ mooiedatum3($copyCampgne->Tijd_van); } ?>" /><br /><br />
				Einddatum<br />
				<input type="text" name="eindTijd" id="endDate" value="<?php if($_POST['submit']){ echo $_POST['eindTijd']; } if(!$_POST['submit'] && !empty($_GET['copy'])){ mooiedatum3($copyCampgne->Tijd_tot); } ?>" /><br /><br />
				Omschrijving *<br />
				<textarea name="beschrijving"><?php if($_POST['submit']){ echo $_POST['beschrijving']; } if(!$_POST['submit'] && !empty($_GET['copy'])){ echo $copyCampgne->Omschrijving; } ?></textarea><br /><br />
				Welke Kanalen worden voor deze campagne ingezet *<br />
				<table border="0" cellpadding="0" cellspacing="5">
						<?php 
							$kanalen = $wpdb->get_results( "SELECT * FROM Kanalen ORDER BY ID" );
							foreach($kanalen as $kanaal){
							$kanalenCopy = explode(",", $copyCampgne->Kanalen);
							?>
							<tr>			
							<td valign="top"><input type="checkbox" class="check" name="kanaal[]" id="<?php echo $kanaal->ID; ?>" value="<?php echo $kanaal->ID; ?>" <?php if(!empty($_POST['kanaal']) && !empty($error) &&  in_array( $kanaal->ID, $_POST['kanaal'])){ ?>checked<?php } if(!empty($_GET['copy']) && !$_POST['submit'] && in_array($kanaal->ID, $kanalenCopy)){?>checked<?php } ?>></td><td><label for="<?php echo $kanaal->ID; ?>"><?php echo $kanaal->Kanaal; ?></label></td>	
							</tr>
							<?php }
						
						?></table>
<br /><br />
				URL landingpagina *<br />
				<input type="text" name="camURL" value="<?php if($_POST['submit']){ echo $_POST['camURL']; } if(!$_POST['submit'] && !empty($_GET['copy'])){ echo $copyCampgne->CampagnePage; } ?>" /><br /><br />
				Naam contactpersoon *<br />
				<input type="text" name="contactpersoon" value="<?php if(!isset($_POST['contactpersoon'])){ echo $current_user->display_name; }else{ echo $_POST['contactpersoon'];} ?>" /><br /><br />
				E-mail contactpersoon *<br />
				<input type="text" name="emailcontactpersoon" value="<?php if(!isset($_POST['emailcontactpersoon'])){ echo $current_user->user_email; }else{ echo $_POST['emailcontactpersoon'];} ?>" /><br /><br />
				Doelgroep *<br />
				<select name="doelgroep">
					<option value="keuze" <?php if($_POST['doelgroep'] == "keuze"){ ?>selected="selected"<?php } ?>>- Maak een keuze -</option>
					<option value="werving" <?php if( $_POST['doelgroep'] == "werving" || !$_POST['submit'] && !empty($_GET['copy']) && $copyCampgne->Doelgroep == 'werving'){ ?>selected="selected"<?php } ?>>Werving</option>
					<option value="corporate" <?php if( $_POST['doelgroep'] == "corporate" || !$_POST['submit'] && !empty($_GET['copy']) && $copyCampgne->Doelgroep == 'corporate'){ ?>selected="selected"<?php } ?>>Corporate</option>
				</select><br /><br />
				Aanvullende informatie<br />
				<textarea name="opmerkingen"><?php if($_POST['submit']){ echo $_POST['camURL']; } if(!$_POST['submit'] && !empty($_GET['copy'])){ echo $copyCampgne->Opmerkingen; } ?></textarea><br /><br />
				<input type="submit" id="submit" name="submit" value="Campagne aanmaken">
			</form>

			<?php } ?>
		</div>
	</div>

	<div id="contentRechts">
	<div class="contentHeaderZoeken">
					<h1>Zoek &amp; kopieer (voorgaande) campagnes</h1>
				</div>
				<div class="contentContentdr">
					<form method="post" id="search">
						<input type="text" value="" id="searchDream" name="keyWord">
						<input type="submit" value="Zoeken!" name="submit2" id="searchSubmit">
					</form>
					<?php if($_POST['submit2']){
						global $wpdb;
						$keyWord = $_POST['keyWord'];
						$zoekresultaten = $wpdb->get_results( "SELECT * FROM Content WHERE type = 'Campagne' AND Titel LIKE '%".$keyWord."%' OR Contactpersoon LIKE '%".$keyWord."%' ORDER BY ID DESC" );
						$aantal = $wpdb->get_var( " SELECT COUNT(*) FROM Content WHERE Titel LIKE '%".$keyWord."%' OR Contactpersoon LIKE '%".$keyWord."%'  AND type = 'Campagne'"); 
						?><span class="header3">Zoekresultaten voor <i>&quot;<?php echo $_POST['keyWord']; ?>&quot;</i> (<?php echo $aantal; ?>)</span>
						<table cellpadding="5" cellspacing="0" border="0">
						<?php
						foreach( $zoekresultaten as $zoekresultaat ){ 
							if($zoekresultaat->type == "Campagne"){
						?>
							<tr >
								<td valign="top" width="250"><a href="https://www.expect-webmedia.nl/sur/contentdetail/?id=<?php echo $zoekresultaat->ID; ?>"><?php echo $zoekresultaat->Titel; ?></a></td>
								<td valign="top">&nbsp;</td>
								<td valign="top" width="270" class="date">&nbsp;&nbsp;<?php mooiedatum4($zoekresultaat->Tijd_tot); ?><a href="/sur/content-toevoegen/?copy=<?php echo $zoekresultaat->ID; ?>"><img src="<?php bloginfo('template_url'); ?>/images/iconCopy.png" alt="" title="Kopieer deze campagne" border="0" style="float: right;"></a></td>
							</tr>
						<?php 
							}
						}

						if(empty($zoekresultaten)){
							echo "Er zijn geen zoekresultaten<br />";
						}
					}
					?>
					</table>
				</div>
				<div class="buttonHalf" onclick="location.href='/sur/campagne-kanalen-en-middelen/';">
					Campagnekanalen en middelen toevoegen
				</div>
				<div class="buttonInactive" >
					&nbsp;
				</div>
	</div>
				

<?php

get_footer(); ob_end_flush(); ?>