<?php 
/*
Template Name:  Detail Social Media
*/
get_header(); 
		//gegevens van dreamteamer/promoteamer ophalen
		global $wpdb; $current_user;
		get_currentuserinfo();
		$actID = $_GET['id'];
		$actDetails = $wpdb->get_row("SELECT * FROM SocialPosts WHERE ID = $actID" );
		
	
			if($_GET['add'] == 'succes'){ ?>
	<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
		Social Media Post met succes toegevoegd!
	</div>
	<?php }
	
		
		 
					if($_POST['submit']){ 
				//kijken of er fouten zijn gemaakt
				if(empty($_POST['titel'])){	$error .= "<li>Je bent vergeten de titel in te vullen</li>";	}
				if(empty($_POST['startTijd'])){	$error .= "<li>Je bent vergeten een startdatum in te vullen</li>";	}
				if(empty($_POST['beschrijving'])){	$error .= "<li>Je bent vergeten een beschrijving in te vullen</li>";}	
				if($_POST['kanaalID'] == 'selecteer'){ $error .="<li>Je bent vergeten een Social Media Kanaal te selecteren</li>"; }
				if(empty($_POST['beschrijving'])){	$error .="<li>Je bent vergeten de tekst toe te voegen</li>";}
				}



					if($_POST['submit'] && empty($error)){
					//Campagne updaten
						$userData = get_userdata($_POST['contactpersoon']);
						if($actDetails->type == 'Campagne'){
							$kanalen = implode(",", $_POST['kanaal']);
						}
						
						$startD = date("Ymd", strtotime($_POST['startTijd']));
						$eindD = date("Ymd", strtotime($_POST['eindTijd']));
						
						$wpdb->update( SocialPosts, array( 'Titel' => $_POST['titel'],'aanhaker' => $_POST['aanhaker'],'Tijd_van' => $startD,'Tijd_tot' => $startD, 'Mschijf' => $_POST['m-schijf'], 'Omschrijving' => $_POST['beschrijving'], 'KanaalID' => $_POST['kanaalID'] ),array( 'ID' => $_GET['id'] ) ); 

						?>
						<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Gegevens zijn met succes aangepast! <?php echo $_POST['aanhaker'];?>
						</div>
						<?php }
						
						if(!empty($foutMelding)){ ?>
							<div  style="width: 1150px;  background-color: #ef413d; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
								<?php echo $foutMelding; ?>
							</div>
						<?php }
		$actDetails = $wpdb->get_row("SELECT * FROM SocialPosts WHERE ID = $actID" );
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
		<div style="height: 5px; width: 590px; background: #5ea9dd; float: left;">&nbsp;</div>
		<div class="contentHeaderContent">
		<div class="contentHeaderIcon"><img src="<?php bloginfo('template_url'); ?>/images/iconSocial.png" width="30"></div>
			<h1>Social Media Post: <?php echo $actDetails->Titel; ?></h1>
			<div class="edit"><?php if(!isset($_GET['edit'])){ ?><a href="/sur/contentdetail-social-media-post/?id=<?php echo $actDetails->ID; ?>&edit=1" ><img src="<?php bloginfo('template_url'); ?>/images/edit.png" alt="" title="Bewerk de gegevens" /></a><?php } ?><a href="/sur/contentkalender?delete3=yes&id=<?php echo $actDetails->ID; ?>" ><img src="<?php bloginfo('template_url'); ?>/images/iconDelete.png" alt="" title="Verwijderen" onclick="return confirm('Weet je zeker dat je deze social media post wilt verwijderen?')"/></a></div>
		</div>
		<div class="contentContentdr" >
		<?php if(empty($_GET['edit']) || !empty($show) && empty($error)){ 
		
	
		?>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top" width="130"> Titel</td>
					<td valign="top">:</td>
					<td valign="top"><?php echo $actDetails->Titel; ?></td>
				</tr>
				<tr>
					<td valign="top" width="130"> Kanaal</td>
					<td valign="top">:</td>
					<td valign="top"><?php echo getKanaalName($actDetails->KanaalID); ?></td>
				</tr>
				<tr>
					<td valign="top"><?php if($actDetails->type == 'Campagne'){
						echo "Looptijd"; }else{
							echo "Datum";
						} ?></td>
					<td valign="top">:</td>
					<td valign="top"><?php 
						if($actDetails->Tijd_van != $actDetails->Tijd_tot){
						echo mooiedatum($actDetails->Tijd_van);
						echo " - ";
						echo mooiedatum($actDetails->Tijd_tot);}else{
							echo mooiedatum($actDetails->Tijd_tot);
						}?></td>
				</tr>
				<tr>
					<td valign="top" width="130">Link naar foto of video op de M: </td>
					<td valign="top">:</td>
					<td valign="top"><?php echo $actDetails->Mschijf; ?></td>
				</tr>
				<tr>
					<td valign="top">Omschrijving</td>
					<td valign="top">:</td>
					<td valign="top" ><?php echo $actDetails->Omschrijving; ?></td>
				</tr>
			</table>
			
			<?php }


				
			if(!empty($_GET['edit']) && !empty($_GET['id']) || empty($_GET['edit']) && !empty($error) && $_POST['submit']){ 
			$actId = $_GET['id'];
			$actDetails = $wpdb->get_row("SELECT * FROM SocialPosts WHERE ID = $actID" );
			?>

				<?php if($_POST['submit'] && !empty($error)){ ?>
				<div id="alert">
					<ul>
						<?php echo $error; ?>
					</ul>
				</div>
				<?php } 
				$startD = date("d-m-Y", strtotime($actDetails->Tijd_van));
				$endD = date("d-m-Y", strtotime($actDetails->Tijd_tot));
				
				?>
				
				<form action="https://www.expect-webmedia.nl/sur/contentdetail-social-media-post/?id=<?php echo $_GET['id'];?>&show=1 " method="post">
				Onderwerp Social Media Post *<br />
				<input type="text" name="titel" value="<?php if(!isset($_POST['titel'])){ echo $actDetails->Titel; }else{ echo $_POST['titel'];} ?>" /><br /><br />
				Plaatsingsdatum *<br />
				
				<input type="text" name="startTijd" id="startDate" value="<?php echo $startD; ?>" /><br /><br />
				Social Media Platform *<br/>
				<select name="kanaalID">
					<option value="selecteer"> - Maak een keuze - </option>
						<?php 
							$kanalen = $wpdb->get_results( "SELECT * FROM SocialMedia ORDER BY ID" );
							foreach($kanalen as $kanaal){
							
							?>
							<option  id="<?php echo $kanaal->ID; ?>" value="<?php echo $actDetails->KanaalID; ?>" <?php if(!empty($_POST['kanaalID']) && !empty($error) &&  $kanaal->ID == $_POST['kanaalID'] || empty($_POST['kanaalID']) && $actDetails->KanaalID == $kanaal->ID ){ ?>selected<?php } ?>><?php echo $kanaal->Kanaal; ?></option>
							<?php }
						?>
				</select>
				<br/><br/>
				 Op welke speciale dag/week haken we aan?*<br/>
				<select name="aanhaker">
					<option value="no">Geen aanhaker</option>
						<?php 
							$beginMaand = date(Ym)."01";
							$nu = date(Ymd);
							$eindMaand  =  date("Ymd", strtotime( "$nu +1 month" ));
							$kanalen = $wpdb->get_results( "SELECT * FROM Special WHERE Tijd_van > '".$beginMaand."' AND Tijd_tot < '".$eindMaand."' ORDER BY Tijd_van" );
							foreach($kanalen as $kanaal){
							
							?>
							<option  id="<?php echo $kanaal->ID; ?>" value="<?php echo $kanaal->ID; ?>" <?php if(!empty($_POST['aanhaker']) && !empty($error) &&  $kanaal->ID == $_POST['aanhaker']){ ?>selected<?php } if(empty($_POST['submit']) && $actDetails->aanhaker == $kanaal->ID ){?>selected<?php } ?>><?php echo $kanaal->Titel ?></option>
							<?php }
						
						?>
				</select>
				<br/><br/>
				Link naar foto of video op de M: <br />
				<input type="text" name="m-schijf" value="<?php if($_POST['submit']){ echo $_POST['m-schijf']; } if(!$_POST['submit'] && !empty($_GET['copy'])){ echo $copyCampgne->Mschijf; }else{ echo $actDetails->Mschijf; } ?>" /><br /><br />
				Tekst van de Post *<br />
				<textarea name="beschrijving"><?php echo  $actDetails->Omschrijving ?></textarea><br /><br />
				<a href="/sur/contentdetail-social-media-post/?id=<?php echo $actDetails->ID; ?> ">Annuleren</a> <input type="submit" id="submit" name="submit" value="Bijwerken">
			</form>
			<?php } ?>
		</div>
	</div>

	<div id="contentRechts">
	<?php if($actDetails->type == 'Campagne'){ ?>
		<div style="height: 5px; width: 590px; background: #5ea9dd; float: left;">&nbsp;</div>
		<div class="contentHeader3">
		<?php 
				global $wpdb;
				$vandaag = date('Ymd');
				$kanalen = $wpdb->get_var( "SELECT Kanalen FROM Content WHERE ID = '".$actDetails->ID."'" );
				$kanalen2 = explode( ',', $kanalen );
				
				?>
			<h1>Kanalen en middelen</h1>
		</div>
		<div class="contentContentdr">
			<table border="0" cellpadding="5" cellspacing="3">
			<?php
				foreach( $kanalen2 as $kanaal ){ 
					$kanaalDetails = $wpdb->get_row( "SELECT * FROM Kanalen WHERE ID = '".$kanaal."'" );
				?>
				<tr>
					<td valign="top"  colspan="2"><b><a name="<?php echo $kanaalDetails->Kanaal; ?>"></a><?php echo $kanaalDetails->Kanaal; ?></b></td>
				</tr>

			<?php 
				$campagneMiddelen = $wpdb->get_results( "SELECT * FROM CampagneMiddelen WHERE Kanaal = '".$kanaalDetails->ID."' AND Campagne = '".$actID."'  " );
				foreach($campagneMiddelen as $campagneMiddel){ 
				$middelDetails = $wpdb->get_row( "SELECT * FROM Middelen WHERE ID = '".$campagneMiddel->Middel."' AND Campagne = '".$actID."'" );	
				?>
				<tr bgcolor="#8b8b8b" style="color: #ffffff;">
					<td valign="top" colspan="2" >&nbsp;<?php echo getMiddelName($campagneMiddel->Middel); if(!empty($campagneMiddel->omschrijving)){ ?> - <small><?php echo $campagneMiddel->omschrijving; ?></small><?php } ?><a href="https://www.expect-webmedia.nl/sur/contentdetail/?id=<?php echo $actID; ?>&camMidDel=<?php echo $campagneMiddel->ID; ?>" onclick="return confirm('Weet je zeker dat je dit campagnemiddel wilt verwijderen?')" ><img src="<?php bloginfo('template_url'); ?>/images/iconTrash.png" alt="" title="Dit campagnemiddel verwijderen" style="float: right; padding-top: 2px; margin-right: 3px;"></a></td>
				</tr>
				<tr>
					<td valign="top" width="150">UTM-code</td>
					<td valign="top" ><input value="<?php if(!empty($campagneMiddel->URL)){ echo $campagneMiddel->URL."?utm_source=".getChanel($kanaal)."&utm_medium=".getMedium($campagneMiddel->Middel)."&utm_campaign=".createCampagneName($actID);}else{ echo $actDetails->CampagnePage."?utm_source=".getChanel($kanaal)."&utm_medium=".getMedium($campagneMiddel->Middel)."&utm_campaign=".createCampagneName($actID); } ?>" onClick="this.setSelectionRange(0, this.value.length)" style="width: 450px; padding: 0px 3px; background-color: none; margin-bottom: 5px;"/></td>
				</tr>

			<?php } ?>
				<tr>
					<td valign="top" colspan="2">
					<?php if(empty($_GET['add']) || $_GET['chanel'] != $kanaal){ ?>
					<a href="/sur/contentdetail/?id=<?php echo $actID; ?>&add=1&chanel=<?php echo $kanaal; ?>#<?php echo $kanaalDetails->Kanaal; ?>"><img src="<?php bloginfo('template_url'); ?>/images/iconMiddelToevoegen.png" border="0"></a>
					<?php } ?>
					<?php if(!empty($_GET['add']) && $_GET['chanel'] == $kanaal){ ?>
					<div style="background: #f37021; padding: 10px; border-radius: 10px;" class="addMid">
					<img src="<?php bloginfo('template_url'); ?>/images/iconMiddelToevoegen.png" border="0">
						<form action="https://www.expect-webmedia.nl/sur/contentdetail/?id=<?php echo $_GET['id'];?>&show=1 " method="post">
						Campagnemiddel*<br />
						<select name="middel" style="width: 520px; margin-top: 5px;">
						<option value="selectie"> - selecteer campagnemiddel - </option>
						<?php 
							$middelen = $wpdb->get_results( "SELECT * FROM Middelen WHERE Kanaal = '".$kanaal."' ORDER BY ID" );						
							foreach($middelen as $middel){ ?>
							<option value="<?php echo $middel->ID; ?>"><?php echo $middel->Uiting_type; ?></option>
							<?php } ?>
							<select><br /><br />
						Korte omschrijving<br />
						<input type="text" name="addMidDis" value="<?php echo $_POST['AddMisDis']; ?>" /><br /><br />
						<input type="text" name="kanaal" value="<?php echo $kanaal; ?>" style="display: none;" />
						
							Alternatieve URL landingspagina <small>(Alleen invullen wanneer anders dan campagne landingspagina)</small> <br />
							<input type="text" name="addURL" value="<?php echo $_POST['addURL']; ?>" /><br /><br />
						<a href="/sur/contentdetail/?id=<?php echo $actDetails->ID; ?> ">Annuleren</a> <input type="submit" id="submit2" name="addMid" value="Toevoegen">
						</form>
					</div>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2">&nbsp;</td>
				</tr>
				<?php 

				}
				
				if(empty($kanalen)){
					echo "Er zijn nog geen kanalen en middelen geselecteerd!";
				} ?>
			</table>
		</div> <?php }else{ ?>
		<div style="height: 5px; width: 590px; background: #5ea9dd; float: left;">&nbsp;</div>
		<div class="contentHeader3">
		<?php 
				global $wpdb;
				$vandaag = date('Ymd');
				$activiteiten = $wpdb->get_row("SELECT * FROM Special WHERE ID = '".$actDetails->aanhaker."'");
				?>
			<h1>Aanhakers <small>( Op welke speciale dag/week haken we aan? ) </small></h1>
		</div>
		<div class="contentContentdr">
			<table border="0" cellpadding="5" cellspacing="3">
			<?php
				if(!empty($activiteiten)){ ?>
				<tr>
					<td valign="top">
					<?php if($activiteiten->Tijd_van == $activiteiten->Tijd_tot){ ?>
					<?php mooiedatum($activiteiten->Tijd_van) ; ?>
					<?php }else{?>
					<?php mooiedatum($activiteiten->Tijd_van) ; ?> - <?php mooiedatum($activiteiten->Tijd_tot) ; ?>
					<?php } ?>
					
					</td>
					<td valign="top" width="10">:</td>
					<td valign="top" width="300"><a href="/sur/contentdetail-speciale-dagen/?id=<?php echo $activiteiten->ID; ?>"><?php echo $activiteiten->Titel; ?></a></td>
				</tr>
				<?php }
				
				if(empty($activiteiten)){
					echo "Er zijn nog geen aanhakers!";
				} ?>
			</table>
		
		<?php } ?>
	
	</div>
<?php

get_footer();
