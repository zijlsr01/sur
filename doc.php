<?php require('../../../wp-blog-header.php'); 
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Briefing-contentbeheer.doc");


echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<style>";
echo "h1{font-family: NHRounded; font-size: 48; color: #000;}";
echo "</style>";
echo "<body>";

global $wpdb;

$actID = $_GET['id'];
$actDetails = $wpdb->get_row("SELECT * FROM Briefing WHERE ID = $actID" );


echo "<h1 style='font-family: NHRounded; font-size: 18; color: #000;'>Briefing contentbeheer";"</h1>";
echo "<h3 style='font-family: NHRounded; font-size: 12; color: #000;'>$actDetails->Titel"; "</h3>"; 
echo "<p style='font-family: Arial; font-size: 10; color: #000; font-weight:normal;'>Omschrijving: $actDetails->Omschrijving"; "</p>";
echo "</body>";
echo "</html>";


?>