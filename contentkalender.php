<?php  ob_start();
/*
Template Name: Contentkalender
*/


get_header();

				//connect to the database
				global $wpdb; $current_user;
				get_currentuserinfo();
				// 
				$current_user = wp_get_current_user();

				//Als het maand en jaar niet in de url zit dan wordt de huidige maand getoond
				if(empty($_GET['month']) && empty($_GET['jaar'])){ 
					$maand = date('m');
					$jaar = date('Y');
				}else{
					$maand = $_GET['month'];
					$jaar = $_GET['jaar'];
				}


				$d = cal_days_in_month(CAL_GREGORIAN,$maand,$jaar);

				$datas = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31); 

				$huidigeMaand = get_mooiemaand($maand);

				$vorigePeriode = $jaar."-".$maand."-01";

				$vorigeMaand = date("m", strtotime( "$vorigePeriode -1 month" ));
				$vorigeJaar = date("Y", strtotime( "$vorigePeriode -1 month" ));

				$volgendeMaand = date("m", strtotime( "$vorigePeriode +1 month" ));
				$volgendeJaar = date("Y", strtotime( "$vorigePeriode +1 month" ));

				$vorigeMooieMaand = get_mooiemaand($vorigeMaand);
				$volgendeMooieMaand = get_mooiemaand($volgendeMaand);
				
				$dezeMaand = $jaar.$maand."01";
				$dezeMaandEind = $jaar.$maand."29";
				$drieMaanden = date("Ymd", strtotime( "$dezeMaand -3 month" ));
				$drieMaandenPlus = date("Ymd", strtotime( "$dezeMaandEind +3 month" ));
				$beginLopendeMaand = $jaar.$maand."01";
				$eindeLopendeMaand = $jaar.$maand.$d;
			
			
				
				if(!empty($_GET['delete'])){
					$actDetails = $wpdb->get_row("SELECT * FROM Content WHERE ID = ".$_GET['id']."" );
					$wpdb->query(   "  DELETE FROM Content WHERE ID = ".$_GET['id']." "  );
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Campagne met succes verwijderd!
				</div>
				<?php } 
				
				if(!empty($_GET['delete2'])){
					//$actDetails = $wpdb->get_row("SELECT * FROM Specials WHERE ID = ".$_GET['id']."" );
					$wpdb->query(   "  DELETE FROM Special WHERE ID = ".$_GET['id']." "  );
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Speciale dag(en) met succes verwijderd!
				</div>
				<?php } 
				
				if(!empty($_GET['delete3'])){
					//$actDetails = $wpdb->get_row("SELECT * FROM Specials WHERE ID = ".$_GET['id']."" );
					$wpdb->query(   "  DELETE FROM SocialPosts WHERE ID = ".$_GET['id']." "  );
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Social Media Post met succes verwijderd!
				</div>
				<?php }
				
				if(!empty($_GET['delete4'])){
					//$actDetails = $wpdb->get_row("SELECT * FROM Specials WHERE ID = ".$_GET['id']."" );
					$wpdb->query(   "  DELETE FROM Persbericht WHERE ID = ".$_GET['id']." "  );
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Persbericht met succes verwijderd!
				</div>
				<?php }
				
				
				if(!empty($_GET['delete5'])){
					//$actDetails = $wpdb->get_row("SELECT * FROM Specials WHERE ID = ".$_GET['id']."" );
					$wpdb->query(   "  DELETE FROM Radiointerview WHERE ID = ".$_GET['id']." "  );
				?>
			
				<div id="s6" style="width: 1150px;  background-color: #007942; float: left; margin-bottom: 15px;padding: 20px; color: #ffffff;">
					Radio Interview met succes verwijderd!
				</div>
				<?php }
				
				?>
				
				
				<div id="contentBreed">
				<div id="addMenu">
					<img src="<?php bloginfo('template_url'); ?>/images/buttonAddContent.png" style="border: 0px;">
				</div>
				
				<div id="addMenux">
					<div id="cam"><a href="/sur/content-toevoegen/">Campagne</a></div>
					<div id="soc"><a href="/sur/social-media-toevoegen/">Social Media</a></div>
					<div id="per"><a href="/sur/persbericht-toevoegen/">Persbericht</a></div>
					<div id="rad"><a href="/sur/radio-interview-toevoegen/">Radio Interview</a></div>
					<div id="spec"><a href="/sur/speciale-dagen-toevoegen/">Speciale dag(en)</a></div>
				</div>
				<table cellspacing="0" cellpadding="10" border="0" width="100%">
					<tr>
						<td width="33%"><a href="/sur/contentkalender/?month=<?php echo $vorigeMaand; ?>&jaar=<?php echo $vorigeJaar; ?>" style="color: #393939;">&laquo; <?php echo $vorigeMooieMaand." ".$vorigeJaar; ?></a></td>
						<td width="33%" style="text-align: center;"><span class="month"><?php echo $huidigeMaand." ".$jaar; ?></span></td>
						<td width="33%" valign="right" style="text-align: right;"><a href="/sur/contentkalender/?month=<?php echo $volgendeMaand; ?>&jaar=<?php echo $volgendeJaar; ?>" style="color: #393939;"><?php echo $volgendeMooieMaand." ".$volgendeJaar; ?> &raquo;</a></td>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="0" border="0">
				<tr>
				<?php
				//dagen
				foreach(range(1, $d) as $data){
						if($data <= $d){ 
						if($data < 10){ $da = "0".$data; }else{ $da = $data;}
						$datum = $jaar.$maand.$da;
						$dagnummer = date("N", strtotime($datum));
						if($dagnummer != '6' && $dagnummer != '7'){
						echo "<td class='dateHeader' style='background-color: #000;' style='border: 5px solid red;'>";
						if($data < 10){ echo "0"; }
						echo $data."</td>";}else{
							echo "<td class='dateHeader' style='background-color: #444444;'>";
						if($data < 10){ echo "0"; }
						echo $data."</td>";
						}
					}
				}
				?><tr></tr><?php
				//speciale momenten
				$specialBegin = $jaar.$maand."01";
				$specialEind = $jaar.$maand.$d;
				foreach(range(1, $d) as $data){
						if($data < 10){ $dag = "0".$data; }else{
							$dag = $data;
						}
						$totaalDatum = $jaar.$maand.$dag;
						?><td height="10" valign="bottom"><?php
							$specials = $wpdb->get_results( "SELECT * FROM Special WHERE (`Tijd_van` BETWEEN '".$specialBegin."' AND '".$specialEind."') AND (`Tijd_tot` BETWEEN '".$specialBegin."' AND '".$specialEind."')" );
							$specialData = $jaar.$maand.$dag;
							foreach($specials as $special){
								if($special->Tijd_van > $specialData || $special->Tijd_tot < $specialData){  }else{ ?>
									<div onclick="location.href='/sur/contentdetail-speciale-dagen/?id=<?php echo $special->ID; ?>'" style="width: 100%; height: 10px; background-color: <?php echo $special->kleur; ?>; border-bottom: 5px solid #fff; cursor: pointer;" title="<?php echo $special->Titel; ?>"></div>
								<?php }
								
							}

						?>
						</td>
								
					<?php }
				?>
				</tr>
				<?php
				//campagnes ophalen
				$campagnes = $wpdb->get_results( "SELECT * FROM Content WHERE (`Tijd_van` BETWEEN '".$drieMaanden."' AND '".$eindeLopendeMaand."') AND (`Tijd_tot` BETWEEN '".$beginLopendeMaand."' AND '".$drieMaandenPlus."')" );

				foreach($campagnes as $campagne){

				$beginMaand = $jaar.$maand."01";
				$eindeMaand = $jaar.$maand.$d;
				$camStart = $campagne->Tijd_van;
				$camEind = $campagne->Tijd_tot;
		
				if($camEind > $beginMaand){
				
				?> <tr> <?php 
							foreach( $datas as $data){
									if($data <= $d){ 
									if($data < 10){ $currentDay = "0".$data; }else{$currentDay = $data;}
									$currentDate = $jaar.$maand.$currentDay;
									$korteCam = $jaar.$maand."03";
									$som = $campagne->Tijd_tot - 2;
									if(($camStart <= $currentDate) && ($currentDate <= $camEind)) { $style = "style='background-color:".$campagne->kleur.";'";}
									?><td <?php echo $style; ?> title="<?php echo $campagne->type.": ".$campagne->Titel; ?>" class="campagne" ><?php if( $camStart == $currentDate){ ?><div class="overLay" onclick="location.href='/sur/contentdetail/?id=<?php echo $campagne->ID; ?>'"><?php echo getIcon($campagne->type);?><?php if($som > $currentDate){ ?>&nbsp; <div class="overLayText"><?php echo $campagne->type.": ".$campagne->Titel; } ?></div></div><?php } ?><?php if( $camStart < $beginMaand && $currentDay == 01){ ?><div class="overLay" onclick="location.href='/sur/contentdetail/?id=<?php echo $campagne->ID; ?>'"><?php echo getIcon($campagne->type);?>&nbsp; <?php if($camEind >= $korteCam){ ?><div class="overLayText"><?php echo $campagne->type.": ".$campagne->Titel; ?></div><?php } ?></div><?php } ?></td><?
									$style ="";
								}else{
									
									break;
								}
							}
						?></tr><?php	
						}
					}
				
				
				?>
				</tr><?php
				//Social Media Posts
				$specialBegin = $jaar.$maand."01";
				$specialEind = $jaar.$maand.$d;
				foreach(range(1, $d) as $data){
						if($data < 10){ $dag = "0".$data; }else{
							$dag = $data;
						}
						$totaalDatum = $jaar.$maand.$dag;
						?><td height="30" valign="bottom" style="border-right: 2px solid #fff;"><?php
							$specials = $wpdb->get_results( "SELECT * FROM SocialPosts WHERE (`Tijd_van` BETWEEN '".$specialBegin."' AND '".$specialEind."') AND (`Tijd_tot` BETWEEN '".$specialBegin."' AND '".$specialEind."')" );
							$specialData = $jaar.$maand.$dag;
							foreach($specials as $special){
								if($special->Tijd_van > $specialData || $special->Tijd_tot < $specialData){  }else{ ?>
									<div onclick="location.href='/sur/contentdetail-social-media-post/?id=<?php echo $special->ID; ?>'" style="width: 100%; height: 30px; border-right: 1px solid #fff; background-color: #5ea9dd; border-bottom: 2px solid #fff; cursor: pointer;" title="<?php echo getKanaalName($special->KanaalID); ?>: <?php echo $special->Titel; ?>" class="social"></div>
								<?php }
								
							}

						?>
						</td>
								
					<?php }
				?>
				</tr>
				
				</tr><?php
				//Persberichten ophalen
				$specialBegin = $jaar.$maand."01";
				$specialEind = $jaar.$maand.$d;
				foreach(range(1, $d) as $data){
						if($data < 10){ $dag = "0".$data; }else{
							$dag = $data;
						}
						$totaalDatum = $jaar.$maand.$dag;
						?><td height="30" valign="bottom" style="border-right: 2px solid #fff;"><?php
							$specials = $wpdb->get_results( "SELECT * FROM Persbericht WHERE (`Tijd_van` BETWEEN '".$specialBegin."' AND '".$specialEind."') AND (`Tijd_tot` BETWEEN '".$specialBegin."' AND '".$specialEind."')" );
							$specialData = $jaar.$maand.$dag;
							foreach($specials as $special){
								if($special->Tijd_van > $specialData || $special->Tijd_tot < $specialData){  }else{ ?>
									<div onclick="location.href='/sur/detailpagina-persbericht/?id=<?php echo $special->ID; ?>'" style="width: 100%; height: 30px; border-right: 1px solid #fff; background-color: #f58d4d; border-bottom: 2px solid #fff; cursor: pointer;" title="Persbericht: <?php echo $special->Titel; ?>" class="pers"></div>
								<?php }
								
							}

						?>
						</td>
								
					<?php }
				?>
				</tr>
				</tr><?php
				//Radio interviews ophalen
				$specialBegin = $jaar.$maand."01";
				$specialEind = $jaar.$maand.$d;
				foreach(range(1, $d) as $data){
						if($data < 10){ $dag = "0".$data; }else{
							$dag = $data;
						}
						$totaalDatum = $jaar.$maand.$dag;
						?><td height="30" valign="bottom" style="border-right: 2px solid #fff;"><?php
							$specials = $wpdb->get_results( "SELECT * FROM Radiointerview WHERE (`Tijd_van` BETWEEN '".$specialBegin."' AND '".$specialEind."') AND (`Tijd_tot` BETWEEN '".$specialBegin."' AND '".$specialEind."')" );
							$specialData = $jaar.$maand.$dag;
							foreach($specials as $special){
								if($special->Tijd_van > $specialData || $special->Tijd_tot < $specialData){  }else{ ?>
									<div onclick="location.href='/sur/detailpagina-radiointerview/?id=<?php echo $special->ID; ?>'" style="width: 100%; height: 30px; border-right: 1px solid #fff; background-color: #00ab4e; border-bottom: 2px solid #fff; cursor: pointer;" title="Persbericht: <?php echo $special->Titel; ?>" class="radio"></div>
								<?php }
								
							}

						?>
						</td>
								
					<?php }
				?>
				</tr>
				
		 </table>
	</div>			
<?php				


get_footer(); ob_end_flush(); ?>