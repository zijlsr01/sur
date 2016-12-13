<?php 
/*
Template Name: homepagina
*/
get_header();  get_header();

				//connect to the database
				global $wpdb;
				
				//haal gegevens van de huidige gebruiker open
				$current_user = wp_get_current_user();				
				
				if(!empty($_GET['delete'])){
					$actDetails = $wpdb->get_row("SELECT * FROM Activiteiten WHERE ID = ".$_GET['id']."" );
					$wpdb->query(   "  DELETE FROM Activiteiten WHERE ID = ".$_GET['id']." "  );
					$wpdb->query(   "  DELETE FROM Aanmeldingen WHERE ActID = ".$_GET['id']." "  );
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Activiteit "<?php $actDetails->Titel; ?>" Verwijderd!
				</div>
				<?php } ?>
				<div style="clear: both;"></div>
	<div id="contentLinks">
		<div class="contentHeaderActief">
			<h1>Mijn komende activiteiten</h1>
		</div>
		<div class="contentContent">
			<table border="0" cellpadding="5" cellspacing="3">
				<?php 
				global $wpdb;
				$vandaag = date('Ymd');
				$activiteiten = $wpdb->get_results( "SELECT * FROM Activiteiten WHERE Datum >= '".$vandaag."' AND ContactpersoonID = '".$current_user->ID."' ORDER BY Datum ASC" );
				foreach( $activiteiten as $activiteit ){ 
				
				//kijken of er wel aanmeldingen zijn, anders geen werkbriefjes
				$aanmeldingen = $wpdb->get_results( "SELECT * FROM Aanmeldingen WHERE ActID = '".$activiteit->ID."' AND Afwezig != 'afwezig'" );
				?>
							<tr >
								<td valign="top" width="110" class="date"> <B>&nbsp;&nbsp;<?php mooiedatum($activiteit->Datum); ?></B></td>
								<td valign="top">&nbsp;</td>
								<td valign="top" width="285"><a href="https://www.expect-webmedia.nl/sur/activiteit-detail/?id=<?php echo $activiteit->ID; ?>"><?php echo $activiteit->Titel; ?></a></td>
								<td valign="top"><?php if(!empty($aanmeldingen)){ ?><a href="https://www.expect-webmedia.nl/sur/print-werkbriefjes/?actid=<?php echo $activiteit->ID; ?>" target="_blank"><span>print werkbriefjes</span></a><?php 				} ?></td>
							</tr>
				<?php } 
				
					if(empty($activiteiten)){
						echo "Je hebt nog geen activiteiten ingepland";
					}
				?>
			</table>
		</div>
		<div class="contentHeaderActief">
			<h1>Mijn recente activiteiten</h1>
		</div>
		<div class="contentContent">
			<table border="0" cellpadding="5" cellspacing="3">
				<?php 
				global $wpdb;
				$vandaag = date('Ymd');
				$activiteiten = $wpdb->get_results( "SELECT * FROM Activiteiten WHERE Datum < '".$vandaag."' AND ContactpersoonID = '".$current_user->ID."' ORDER BY Datum ASC" );
				foreach( $activiteiten as $activiteit ){ 
				
				//kijken of er wel aanmeldingen zijn, anders geen werkbriefjes
				$aanmeldingen = $wpdb->get_results( "SELECT * FROM Aanmeldingen WHERE ActID = '".$activiteit->ID."'" );
				?>
							<tr >
								<td valign="top" width="110" class="date"> <B>&nbsp;&nbsp;<?php mooiedatum($activiteit->Datum); ?></B></td>
								<td valign="top">&nbsp;</td>
								<td valign="top" width="285"><a href="https://www.expect-webmedia.nl/sur/activiteit-detail/?id=<?php echo $activiteit->ID; ?>"><?php echo $activiteit->Titel; ?></a></td>
								<td valign="top"><?php if(!empty($aanmeldingen)){ ?><a href="https://www.expect-webmedia.nl/sur/print-werkbriefjes/?actid=<?php echo $activiteit->ID; ?>" target="_blank"><span>print werkbriefjes</span></a><?php 				} ?></td>
							</tr>
				<?php } 
				
					if(empty($activiteiten)){
						echo "Je hebt geen recente activiteiten";
					}
				?>
			</table>
		</div>
	</div>

	<div id="contentRechts">
		<div class="contentHeader3">
			<h1>Mijn nieuwste aanmeldingen</h1>
		</div>
		<div class="contentContent">
		<table border="0" cellpadding="5" cellspacing="3">
				<?php 
				global $wpdb;
				$vandaag = date('Ymd');
				$mijnAanmeldingen= $wpdb->get_results( "SELECT * FROM Aanmeldingen WHERE ContactID = '".$current_user->ID."' AND Afwezig != 'afwezig' AND hoeftNiet !='1' ORDER BY Datum DESC LIMIT 5" );
				foreach( $mijnAanmeldingen as $mijnAanmelding ){ ?>
							<tr >
								<td valign="top" width="110" class="date"> <B>&nbsp;&nbsp;<?php mooiedatum($mijnAanmelding->Datum); ?></B></td>
								<td valign="top">&nbsp;</td>
								<td valign="top" width="150"><a href="https://www.expect-webmedia.nl/sur/detail/?id=<?php echo $mijnAanmelding->StudID; ?>" target="_self"><?php echo studentNaam($mijnAanmelding->StudID); ?></a></td>
								<td valign="top"><a href="https://www.expect-webmedia.nl/sur/activiteit-detail?id=<?php echo $mijnAanmelding->ActID; ?>"><?php activiteitNaam($mijnAanmelding->ActID) ?></a></td>
							</tr>
				<?php } 
				
					if(empty($mijnAanmeldingen)){
						echo "Er zijn nog geen aanmeldingen";
					}
				?>
			</table>
		</div>
		
			<div class="contentHeader4">
			<h1>Mijn nieuwste afmeldingen</h1>
		</div>
		<div class="contentContent">
		<table border="0" cellpadding="5" cellspacing="3">
				<?php 
				global $wpdb;
				$vandaag = date('Ymd');
				$mijnAanmeldingen2 = $wpdb->get_results( "SELECT * FROM Aanmeldingen WHERE ContactID = '".$current_user->ID."' AND Afwezig = 'afwezig' ORDER BY Datum DESC LIMIT 5" );
				foreach( $mijnAanmeldingen2 as $mijnAanmelding2 ){ ?>
							<tr >
								<td valign="top" width="110" class="date"> <B>&nbsp;&nbsp;<?php mooiedatum($mijnAanmelding2->Datum); ?></B></td>
								<td valign="top">&nbsp;</td>
								<td valign="top" width="150"><a href="https://www.expect-webmedia.nl/sur/detail/?id=<?php echo $mijnAanmelding2->StudID; ?>" target="_self"><?php echo studentNaam($mijnAanmelding2->StudID); ?></a></td>
								<td valign="top"><a href="https://www.expect-webmedia.nl/sur/activiteit-detail?id=<?php echo $mijnAanmelding2->ActID; ?>"><?php activiteitNaam($mijnAanmelding2->ActID) ?></a></td>
							</tr>
				<?php } 
				
					if(empty($mijnAanmeldingen2)){
						echo "Er zijn nog geen afmeldingen";
					}
				?>
			</table>
		</div>
	</div>
				

<?php

get_footer(); ob_end_flush(); ?>