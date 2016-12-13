	<div id="footer">
	<?php if(is_user_logged_in()){ ?>
		<img src="<?php bloginfo('template_url'); ?>/images/vergroot.png" alt="" />
	<?php } ?>
	</div>
	</div> <!-- einde wrapper -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-ui-timepicker-addon-i18n.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-ui-sliderAccess.js"></script>
		<script>
		function myFunction() {
			confirm("Weet je zeker dat je deze activiteit wilt verwijderen?");
		}

		function myFunction2() {
			confirm("Weet je zeker dat je deze persoon uit de aanmeldlijst wilt verwijderen?");
		}
		</script>

		<script type="text/javascript">
		
		$(document).ready(function(){
				$("#addMenu").click(function(){
					$("#addMenux").slideToggle(500);
				});
			});
			
			$(function(){

					$('#startTijd').timepicker({
					timeOnlyTitle: 'Kies een starttijd',
					timeText: 'Tijd',
					hourText: 'Uren',
					minuteText: 'Minuten',
					stepMinute: '15',
					secondText: 'Seconden',
					currentText: 'Huidige tijd',
					closeText: 'Bevestig'
				});

				$('#eindTijd').timepicker({
					timeOnlyTitle: 'Kies een eindtijd',
					timeText: 'Tijd',
					hourText: 'Uren',
					minuteText: 'Minuten',
					stepMinute: '15',
					secondText: 'Seconden',
					currentText: 'Huidige tijd',
					closeText: 'Bevestig'
				});

				$('#datum').datepicker({
					timeOnlyTitle: 'Kies een starttijd',
					dateFormat: 'dd-mm-yy',
					timeText: 'Tijd',
					hourText: 'Uren',
					minuteText: 'Minuten',
					secondText: 'Seconden',
					currentText: 'Huidige tijd',
					closeText: 'Bevestig'
				});

				$('#datumNew').datepicker({
					timeOnlyTitle: 'Kies een starttijd',
					dateFormat: 'dd-mm-yy',
					timeText: 'Tijd',
					hourText: 'Uren',
					minuteText: 'Minuten',
					secondText: 'Seconden',
					currentText: 'Huidige tijd',
					closeText: 'Bevestig'
				});

	
				$('#deadline').datetimepicker({
					timeOnlyTitle: 'hh',
					dateFormat: 'dd-mm-yy',
					timeText: 'Tijd',
					hourText: 'Uren',
					minuteText: 'Minuten',
					secondText: 'Seconden',
					currentText: 'Huidige tijd',
					closeText: 'Bevestig'
				});
				
				
				var startDateTextBox = $('#startDate');
				var endDateTextBox = $('#endDate');

				$.timepicker.dateRange(
					startDateTextBox,
					endDateTextBox,
					{
						dateFormat: 'dd-mm-yy',
						start: {}, // start picker options
						end: {} // end picker options
					}
				);




			var startDateTextBox = $('#range_example_1_start');
			var endDateTextBox = $('#range_example_1_end');



			startDateTextBox.datepicker({ 
				dateFormat: 'dd-mm-yy',
				onClose: function(dateText, inst) {
					if (endDateTextBox.val() != '') {
						var testStartDate = startDateTextBox.datetimepicker('getDate');
						var testEndDate = endDateTextBox.datetimepicker('getDate');
						if (testStartDate > testEndDate)
							endDateTextBox.datetimepicker('setDate', testStartDate);
					}
					else {
						endDateTextBox.val(dateText);
					}
				},
				onSelect: function (selectedDateTime){
					endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
				}
			});
			endDateTextBox.datepicker({ 
				dateFormat: 'dd-mm-yy',
				onClose: function(dateText, inst) {
					if (startDateTextBox.val() != '') {
						var testStartDate = startDateTextBox.datetimepicker('getDate');
						var testEndDate = endDateTextBox.datetimepicker('getDate');
						if (testStartDate > testEndDate)
							startDateTextBox.datetimepicker('setDate', testEndDate);
					}
					else {
						startDateTextBox.val(dateText);
					}
				},
				onSelect: function (selectedDateTime){
					startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
				}
			});


			var startDateTextBox2 = $('#range_example_1_start2');
			var endDateTextBox2 = $('#range_example_1_end2');



			startDateTextBox2.datepicker({ 
				dateFormat: 'dd-mm-yy',
				onClose: function(dateText, inst) {
					if (endDateTextBox2.val() != '') {
						var testStartDate = startDateTextBox2.datetimepicker('getDate');
						var testEndDate = endDateTextBox2.datetimepicker('getDate');
						if (testStartDate > testEndDate)
							endDateTextBox2.datetimepicker('setDate', testStartDate);
					}
					else {
						endDateTextBox2.val(dateText);
					}
				},
				onSelect: function (selectedDateTime){
					endDateTextBox2.datetimepicker('option', 'minDate', startDateTextBox2.datetimepicker('getDate') );
				}
			});
			endDateTextBox2.datepicker({ 
				dateFormat: 'dd-mm-yy',
				onClose: function(dateText, inst) {
					if (startDateTextBox2.val() != '') {
						var testStartDate = startDateTextBox2.datetimepicker('getDate');
						var testEndDate = endDateTextBox2.datetimepicker('getDate');
						if (testStartDate > testEndDate)
							startDateTextBox2.datetimepicker('setDate', testEndDate);
					}
					else {
						startDateTextBox2.val(dateText);
					}
				},
				onSelect: function (selectedDateTime){
					startDateTextBox2.datetimepicker('option', 'maxDate', endDateTextBox2.datetimepicker('getDate') );
				}
			});
			
			
			
			
			
			var startDateTextBox3 = $('#range_example_1_start3');
			var endDateTextBox3 = $('#range_example_1_end3');



			startDateTextBox3.datepicker({ 
				dateFormat: 'dd-mm-yy',
				onClose: function(dateText, inst) {
					if (endDateTextBox2.val() != '') {
						var testStartDate = startDateTextBox3.datetimepicker('getDate');
						var testEndDate = endDateTextBox3.datetimepicker('getDate');
						if (testStartDate > testEndDate)
							endDateTextBox3.datetimepicker('setDate', testStartDate);
					}
					else {
						endDateTextBox3.val(dateText);
					}
				},
				onSelect: function (selectedDateTime){
					endDateTextBox3.datetimepicker('option', 'minDate', startDateTextBox3.datetimepicker('getDate') );
				}
			});
			endDateTextBox3.datepicker({ 
				dateFormat: 'dd-mm-yy',
				onClose: function(dateText, inst) {
					if (startDateTextBox3.val() != '') {
						var testStartDate = startDateTextBox3.datetimepicker('getDate');
						var testEndDate = endDateTextBox3.datetimepicker('getDate');
						if (testStartDate > testEndDate)
							startDateTextBox3.datetimepicker('setDate', testEndDate);
					}
					else {
						startDateTextBox3.val(dateText);
					}
				},
				onSelect: function (selectedDateTime){
					startDateTextBox3.datetimepicker('option', 'maxDate', endDateTextBox3.datetimepicker('getDate') );
				}
			});




			$(window).load(function(){
			  setTimeout(function(){ $('#s6').fadeOut('slow') }, 4000);
			});

			});
			
			$(window).load(function(){
			  setTimeout(function(){ $('#s6').fadeOut('slow') }, 4000);
			});
			
			$( "#refresh" ).click(function() {
			$( "#layer" ).show( 10, function() {
			
			});
			});
			
			/* ---------------------- Conditionele logica briefing contentbeheer -----------------------*/
			
			
				
				
			/* Categorie */
			 
			 $("select[name='categorie']").click(function () {
				$('#subcatMail').css('display', ($(this).val() === 'mail') ? 'block':'none');
				
			});
			 
			 $("select[name='categorie']").click(function () {
				$('#subcatWebsite').css('display', ($(this).val() === 'website') ? 'block':'none');
			});
			
			 $("select[name='categorie']").click(function () {
				$('#subcatBanners').css('display', ($(this).val() === 'banners') ? 'block':'none');
			});
			
			 $("select[name='categorie']").click(function () {
				$('#subcatEnquete').css('display', ($(this).val() === 'enquete') ? 'block':'none');
			});
			
			 $("select[name='categorie']").click(function () {
				$('#subcatNarrowcasting').css('display', ($(this).val() === 'narrowcasting') ? 'block':'none');
			});
			
			 $("select[name='categorie']").click(function () {
				$('#subcatOverig').css('display', ($(this).val() === 'overig') ? 'block':'none');
			});
			
			/* Correcties */
			
			
			 $("select[name='correcties']").click(function () {
				$('#datumCorrecties').css('display', ($(this).val() === 'Ja') ? 'block':'none');
			});
			
			/* SubSubcategorie website */
			
			 $("select[name='subcatWebsite']").click(function () {
				$('#subcatWebsitePanels').css('display', ($(this).val() === 'panels') ? 'block':'none');
			});		
			 $("select[name='subcatWebsite']").click(function () {
				$('#subcatWebsiteLP').css('display', ($(this).val() === 'landingspagina') ? 'block':'none');
			});
			 $("select[name='subcatWebsite']").click(function () {
				$('#subcatWebsiteTekst').css('display', ($(this).val() === 'webtekst') ? 'block':'none');
			});
			 $("select[name='subcatWebsite']").click(function () {
				$('#subcatWebsiteForm').css('display', ($(this).val() === 'formulier') ? 'block':'none');
			});
			
			
		
			
			
			
			
			
			
			/* test met panels 
			$("select[name='categorie']").click(function () {
				$('#subcatWebsitePanels').css
			('display', ($(this).val() === 'website') ? 'block':'none');
			})
			
			
			$("select[name='subcatWebsite']").click(function () {
				$('#subcatWebsitePanels').css
			('display', ($(this).val() === 'panels') ? 'block':'none');
			});
			
			*/
			
		  /* test met panels */
		
			
			
		
			
			
			
			/* Briefing input voor landingspagina */
			
			
			 $("select[name='subcatWebsite']").click(function () {
				$('#briefingInput').css('display', ($(this).val() === 'landingspagina') ? 'block':'none');
			});			
			
			/* ----------------------------------- Uren calculatie -----------------------------------------*/
			
			
			// Bepaal urenwaarde van elke opdracht
			
			
			
			
			//Mail
			var uren_subcatMail = new Array();
			uren_subcatMail["keuze"]=0.00;
			uren_subcatMail["mailBestaandeOpmaak"]=1.50;
			uren_subcatMail["corMailBestaandeOpmaak"]=0.50;
			uren_subcatMail["mailNieuweOpmaak"]=3.00;
			uren_subcatMail["corMailNieuweOpmaak"]=1.00;
			
			
			//Website
			
				//Kleine aanpassing
			
				//Panels		
				var uren_subcatWebsitePanels = new Array();
				uren_subcatWebsitePanels["keuze"]=0.00;
				uren_subcatWebsitePanels["singlecontentpanel"]=1.50;
				uren_subcatWebsitePanels["multitab"]=0.50;
				uren_subcatWebsitePanels["calltoaction"]=3.00;
				uren_subcatWebsitePanels["fotoalbumklein"]=1.00;		
				uren_subcatWebsitePanels["fotoalbumgroot"]=1.00;
				uren_subcatWebsitePanels["videopanel"]=1.00;	
				
				//Landingspagina
				var uren_subcatWebsiteLP = new Array();
				uren_subcatWebsiteLP["keuze"]=0.00;
				uren_subcatWebsiteLP["landingspagina"]=2.00;
				uren_subcatWebsiteLP["landingspaginaCor"]=0.50;
				
				//Formulier
				var uren_subcatWebsiteForm = new Array();
				uren_subcatWebsiteForm["keuze"]=0.00;
				uren_subcatWebsiteForm["formulierNieuw"]=1.00;
				uren_subcatWebsiteForm["formulierBestaand"]=0.50;
				uren_subcatWebsiteForm["crmFormulierNieuw"]=1.50;
				uren_subcatWebsiteForm["crmFormulierBestaand"]=1.00;
				
				
				//Webtekst
				var uren_subcatWebsiteTekst = new Array();
				uren_subcatWebsiteTekst["keuze"]=0.00;
				uren_subcatWebsiteTekst["webTekstOpleiding"]=5.00;
				uren_subcatWebsiteTekst["webTekstCursus"]=2.50;
				uren_subcatWebsiteTekst["webTekstPagina"]=2.00;
				uren_subcatWebsiteTekst["webTekstBestaand"]=0.50;
				
			
			//Banners
			var uren_subcatBanners = new Array();
			uren_subcatBanners["keuze"]=0.00;
			uren_subcatBanners["bannersetBestaandeOpmaak"]=4.00;
			uren_subcatBanners["bannersetNieuweOpmaak"]=5.00;
			uren_subcatBanners["facebookBannerBestaandeOpmaak"]=0.50;
			uren_subcatBanners["facebookBannerNieuweOpmaak"]=1.00;

			
			//Enquete
			var uren_subcatEnquete = new Array();
			uren_subcatEnquete["keuze"]=0.00;
			uren_subcatEnquete["bestaandeEnquete"]=1.00;
			uren_subcatEnquete["nieuweEnquete"]=3.00;

			
			//Narrowcasting
			var uren_subcatNarrowcasting= new Array();
			uren_subcatNarrowcasting["keuze"]=0.00;
			uren_subcatNarrowcasting["bestaandeNarrowcasting"]=0.50;
			uren_subcatNarrowcasting["nieuweNarrowcasting"]=1.00;
			
			//Overig
			var uren_subcatOverig= new Array();
			uren_subcatOverig["keuze"]=0.00;
			uren_subcatOverig["videoYoutube"]=1.00;
			
			
			
			
			
				//This function finds the filling price based on the
			//drop down selection
			function getUrenMail()
			{
				var urenCalculatie=0;
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatMail"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatMail[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
			
			//This function finds the filling price based on the
			//drop down selection
			function getUrenWebsitePanels()
			{
				var urenCalculatie=0;
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatWebsitePanels"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatWebsitePanels[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
			//This function finds the filling price based on the
			//drop down selection
			function getUrenWebsiteLP()
			{
				var urenCalculatie=0;
				
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatWebsiteLP"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatWebsiteLP[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
			
			//This function finds the filling price based on the
			//drop down selection
			function getUrenWebsiteForm()
			{		
				var urenCalculatie=0;
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatWebsiteForm"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatWebsiteForm[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
			
			
			//This function finds the filling price based on the
			//drop down selection
			function getUrenWebsiteTekst()
			{
				var urenCalculatie=0;
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatWebsiteTekst"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatWebsiteTekst[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
			//This function finds the filling price based on the
			//drop down selection
			function getUrenBanners()
			{
				var urenCalculatie=0;
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatBanners"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatBanners[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
			//This function finds the filling price based on the
			//drop down selection
			function getUrenEnquete()
			{
				var urenCalculatie=0;
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatEnquete"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatEnquete[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
		    //This function finds the filling price based on the
			//drop down selection
			function getUrenNarrowcasting()
			{
				var urenCalculatie=0;
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatNarrowcasting"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatNarrowcasting[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
			//This function finds the filling price based on the
			//drop down selection
			function getUrenOverig()
			{
				var urenCalculatie=0;
				//Get a reference to the form id="cakeform"
				var theForm = document.forms["briefingcontent"];
				//Get a reference to the select id="filling"
				var geselecteerdeOpdrachten = theForm.elements["subcatOverig"];
			 
				//set cakeFilling Price equal to value user chose
				//For example filling_prices["Lemon".value] would be equal to 5
				berekendeUren = uren_subcatOverig[geselecteerdeOpdrachten.value];
			 
				//finally we return cakeFillingPrice
				return berekendeUren;
			}
			
			
			function resetTotal()
			{
				var urenOptelling = 0;
			}
			
			
			
			// Bereken totaal van verschillende subcategorieën
			
			function calculateTotal()
			{
				//Here we get the total price by calling our function
				//Each function returns a number so by calling them we add the values they return together
			

				var urenOptelling = getUrenMail() || getUrenWebsitePanels() || getUrenWebsiteLP() || getUrenWebsiteForm() 
				|| getUrenWebsiteTekst() || getUrenBanners() || getUrenEnquete() || getUrenNarrowcasting() || getUrenOverig(); 
				
				
				
				
				//display the result
				var divobj = document.getElementById('totaalUren');
				divobj.style.display='block';
				divobj.innerHTML = "Totaal aantal uren is "+urenOptelling;
				document.getElementById('myField').value = urenOptelling;
				
			}
			
			function hideTotal()
			{
				var divobj = document.getElementById('totaalUren');
				divobj.style.display='none';
			}
			
		//Ecma
		$( ".alleOpleidingenAan" ).click(function() {
		  $("#alleopleidingen input:checkbox").prop("checked", true);
		});
		
		$( ".alleOpleidingenUit" ).click(function() {
		  $("#alleopleidingen input:checkbox").prop("checked", false);
		}); 	
			
		
	
		//Ecma
		$( ".alleEcmaAan" ).click(function() {
		  $("#ecma input:checkbox").prop("checked", true);
		});
		
		$( ".alleEcmaUit" ).click(function() {
		  $("#ecma input:checkbox").prop("checked", false);
		}); 


		//Techniek
		$( ".alleTechniekAan" ).click(function() {
		  $("#techniek input:checkbox").prop("checked", true);
		});
		
		$( ".alleTechniekUit" ).click(function() {
		  $("#techniek input:checkbox").prop("checked", false);
		});
		
		//IEC
		$( ".alleIecAan" ).click(function() {
		  $("#iec input:checkbox").prop("checked", true);
		});
		
		$( ".alleIecUit" ).click(function() {
		  $("#iec input:checkbox").prop("checked", false);
		});
		
	     //Zorg & Welzijn
		$( ".alleZorgwelzijnAan" ).click(function() {
		  $("#zorgwelzijn input:checkbox").prop("checked", true);
		});
		
		$( ".alleZorgwelzijnUit" ).click(function() {
		  $("#zorgwelzijn input:checkbox").prop("checked", false);
		});

									 
			
			
		</script>	
</body>
</html>