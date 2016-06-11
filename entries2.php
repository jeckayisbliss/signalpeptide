<!--DOCTYPE html-->
<html lang="en">
<head>
<!-- Start of page Preloader stuff -->
<!-- <style type="text/css"> ->
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript,
if it's not present, don't show loader */

/*.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(img/Preloader_1.gif) center no-repeat #fff;
}
</style>*/
<!- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script> -->

<!-- <script>
//paste this code under the head tag or in a separate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
	</script> -->

	<!-- End of page preloader stuff -->

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Jeckay / Kezah">
	<title>Protein Sequence Profiler</title>
	<link type="text/css" rel="stylesheet" href="css/dataTables/dataTables.bootstrap.css">
	<link type="text/css" rel="stylesheet" href="css/dataTables/jquery.dataTables.css">

		<!-- <link href="https://bootswatch.com/lumen/bootstrap.min.css" rel="stylesheet">
		<link href="https://bootswatch.com/lumen/bootstrap.css" rel="stylesheet"> -->

    <!-- Bootstrap Core CSS -->
  	<link href="css/bootstrap.min.css" rel="stylesheet">
  	<!-- Custom CSS -->
  	<link href="css/modern-business.css" rel="stylesheet">
  	<!-- Custom Fonts -->
  	<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  	<link rel="stylesheet" type="text/css" href="css/style.css">

  	<!-- auto page loader with percentage -->
  	<!--<script src="js/pace.js"></script>
  	<link href="css/pace.css" rel="stylesheet" />-->

	<!-- Bootstrap Core CSS -->
    <!-- <link href="try/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->

    <!-- Fonts -->
    <!-- <link href="try/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
	<!-- <link href="try/css/animate.css" rel="stylesheet" /> -->
    <!-- Squad theme CSS -->
    <!-- <link href="try/css/style.css" rel="stylesheet"> -->
	<!-- <link href="try/color/default.css" rel="stylesheet"> -->


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="html5shiv.js"></script>
		<script src="respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="js/lz-string.js"></script>
    <script type="text/javascript" src="js/loader.js"></script>
    <script type="text/javascript" src="js/googleapi.js"></script>
    <script type="text/javascript" src="js/html2canvas.js"></script>
	<script src="js/dataTables/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>


<!-- <div class="se-pre-con"></div> //preloader stuff -->

	<!-- Navigation -->
	<?php include_once('menu.php'); ?>

	<!-- Chart Information -->
	<?php include('entries_table.php'); ?>
	<?php include('entries_chart.php'); ?>
	<!-- Page Content -->
	<div class="container">
		<!-- Page Heading/Breadcrumbs -->
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<h1 class="page-header">Data Entries</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a>
						</li>
						<li class="active">Entries</li>
					</ol>
					<ol class="breadcrumb" id="filter-details">
					</ol>
				</div>
				<!-- <div class="row main-content">
					<div class="col-lg-3">
						<label>Check for redundancy (%) : </label>
					</div>
					<div class="col-lg-2" >
						<select id="redundancy-percentage" class="form-control table-bordered" onchange="checkForRedundancy()"></select>
					</div>

				</div> -->
				<!-- <br> -->
				<div class="row">
						<div class="col-xs-12 .col-sm-6 .col-lg-8">
							<a href="#" onclick="FilterTables();" data-toggle="modal" data-target="#recordTable" data-backdrop="static" data-keyboard="false" class="btn btn-info upload">Show Table</a>
							<a href="#" data-toggle="modal" data-target="#recordChart" class="btn btn-info upload" data-title="Chart">Show Chart</a>
							<button class="btn btn-info upload" onclick="download('fasta')">Fasta</button>
							<button class="btn btn-info upload" onclick="download('txt')">Text Record</button>

							<label style="float:right">Display Filter Results by:
								<select name="URL" class="filter form-control" id="filter" onchange="reloadData(this.value)">
									<option value="default" selected>Default</option>
									<!--<option value="1">Data Sets with Signal Peptide</option>-->
									<!--<option value="2">Data Sets without Signal Peptide</option>-->
									<option value="3">Functions</option>
									<option value="4">Transmembranes</option>
									<option value="5">Non-Transmembranes</option>
								</select>&nbsp; &nbsp; &nbsp;
							</label>

							<label style="float:right">Check for redundancy (%) :
							&nbsp; &nbsp; &nbsp;<select id="redundancy-percentage" class="form-control table-bordered" onchange="checkForRedundancy()"></select>
						</label>
						</div>
				</div>

				<div class="row">
					<div class="list-container">
						<div class="table-responsive">
							<table class="table table-striped table-bordered" id="resultTable">
								<div id="datatable_loader"></div>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	   	<!-- /.row -->
		<!-- Dialog box --->


		<!-- end Chart Information -->
		<!-- end Record Information -->
		<!-- end Dialog box-->
		<!-- <hr> -->
		<!-- Footer -->
		<div class="padded">
		</div>
		<center>
		<?php //include_once('footer.php'); ?>
		</center>
	<!-- </div> -->

	<script>

		var content_fasta = "";
		var content_text = "";

		var peptide;
		var taxonomic_lineage;
		var protein_type;
		var membrane_type;
		var nonmembrane_type;
		var evidence;

		$(document).ready(function(){
			for (i = 0; i < 102; i++) {
				if (i == 0) {
					$("#redundancy-percentage").append("<option value='None' selected>None</option>");
				} else {
					$("#redundancy-percentage").append("<option value='" + (i - 1) + "'>"  + (i - 1) + "</option>");
				}
			}

            //TODO :; remove console.log
			// console.log("start");
			// console.log(sessionStorage);
			// console.log("end");

			//filters chosen from modal are set here:
			peptide = JSON.parse(sessionStorage.getItem("peptide"));
			taxonomic_lineage = JSON.parse(sessionStorage.getItem("taxonomic_lineage"));
			protein_type = JSON.parse(sessionStorage.getItem("protein_type"));
			membrane_type = JSON.parse(sessionStorage.getItem("membrane_type"));
			nonmembrane_type = JSON.parse(sessionStorage.getItem("nonmembrane_type"));
			evidence = JSON.parse(sessionStorage.getItem("evidence"));
			var none = "--";

			$("#filter-details").empty();
			appendFilterDetails("Signal Peptide", peptide);
			appendFilterDetails("Taxonomy", taxonomic_lineage);
			appendFilterDetails("Protein Type", protein_type);
			if(protein_type.filter_text == "Transmembrane") {
				appendFilterDetails("Membrane Type", membrane_type);
			} else if(protein_type.filter_text == "Non-Transmembrane") {
				appendFilterDetails("Non-membrane Type", nonmembrane_type);
			}
			appendFilterDetails("Evidence", evidence);

			if (peptide == null && taxonomic_lineage == null &&
				protein_type == null && membrane_type == null && evidence == null) {
				$("#filter-details").html("Data filters are unknown.");
			}
			else
			{
				if(protein_type.filter_text == "Transmembrane")	{
					filter.getElementsByTagName('option')[3].disabled = true;
					filter.getElementsByTagName('option')[2].disabled = false;
				}
				else if(protein_type.filter_text == "Non-Transmembrane") {
					filter.getElementsByTagName('option')[2].disabled = true;
					filter.getElementsByTagName('option')[3].disabled = false;
				} else {
					filter.getElementsByTagName('option')[2].disabled = true;
					filter.getElementsByTagName('option')[3].disabled = true;
				}
			}

			filter = $("[name='URL'] :selected").val();
			reloadData(filter);
		});

		var filter_headers = {};

		filter_headers["3"] = [{"targets": [0], "title": "Entry ID"}, {"targets": [1], "title": "Entry Name"}, {"targets": [2], "title": "Protein Sequence"}, {"targets": [3], "title": "Functions"}];
		filter_headers["4"] = [{"targets": [0], "title": "Entry ID"}, {"targets": [1], "title": "Entry Name"}, {"targets": [2], "title": "Protein Sequence"}, {"targets": [3], "title": "Segment Type"}, {"targets":[4], "title": "No. of Segments"}, {"targets": [5], "title": "Position(s)"}];
		filter_headers["5"] = [{"targets": [0], "title": "Entry ID"}, {"targets": [1], "title": "Entry Name"}, {"targets": [2], "title": "Protein Sequence"}, {"targets": [3], "title": "Place of Excretion / Residence"}];
		filter_headers["default"] = [{"targets":[0], "title": "Entry ID"}, {"targets":[1], "title": "Entry Name"}, {"targets":[2], "title": "Sequence Length"}, {"targets":[3], "title": "Taxonomy"}];

		var filter_rows = {};

		filter_rows["3"] = ["entryId", "entryName", "sequence", "function"];
		filter_rows["4"] = ["entryId", "entryName", "sequence", "segmentType", "topologyLength", "topologyOrientation"];
		filter_rows["5"] = ["entryId", "entryName", "sequence", "subcellularLocation"];
		filter_rows["default"] = ["entryId", "entryName", "sequenceLength", "taxonomicLineage"];

		Object.size = function(obj) {
		    var size = 0, key;
		    for (key in obj) {
		        if (obj.hasOwnProperty(key)) size++;
		    }
		    return size;
		};

		function download(type) {
			content = "data:text/txt;charset=utf-8,";
			file = "file";

		    var results = LZString.decompress(sessionStorage.getItem("results"));
			var peptide_data = JSON.parse(results);
			var size = Object.size(peptide_data);

			//get Date
			var currentDate = new Date();

			var day = currentDate.getDate();
			var month = currentDate.getMonth() + 1;
			var year = currentDate.getFullYear();

			//get time
			var time = currentDate.getTime();
			var hours = currentDate.getHours();
			var minutes = currentDate.getMinutes();
			var secs = currentDate.getSeconds();

			if (minutes < 10)
				minutes = "0" + minutes

			var suffix = "AM";

			if (hours >= 12) {
				suffix = "PM";
				hours = hours - 12;
			}

			if (hours == 0) {
				hours = 12;
			}

			var check_redundancy;
			var percent;

			percent = document.getElementById("redundancy-percentage").value;

			if(percent == "None") {
				check_redundancy = "No";
				percent = "-";
			} else {
				check_redundancy = "Yes";
			}

			dl_details = "DOWNLOAD DETAILS \r\n" +
							"	File Name: " + "Output(" + time + ").txt"+ "\r\n" +
								"	Date (dd/mm/yyyy): " + day + "/" + month + "/" + year + "\r\n" +
									"	Time: " + hours + ":" + minutes + " " + suffix + "\r\n" +
										"	Total Entries: " + size + "\r\n" +
											"	Filter Setting \r\n" +
												"		Signal Peptide: " + peptide.filter_text +
												"\r\n		Taxonomy: " + taxonomic_lineage.filter_text +
												"\r\n		Protein Type: " + protein_type.filter_text +
												"\r\n		Membrane Type: " + membrane_type.filter_text +
												"\r\n		Non-Membrane Type: " + nonmembrane_type.filter_text +
												"\r\n		Evidence: " + evidence.filter_text + "\r\n" +
													"	Subject to Redundancy Checking: " + check_redundancy + "\r\n" +
														"	Redundancy Percentage: " + percent + "\r\n\r\n";

			if (type == "fasta") {
				content = content + dl_details + content_fasta;
				file = "output.fasta";
			} else if (type == "txt") {
				content = content + dl_details + content_text;
				file = "output.txt";
			}

			var encodedUri = encodeURI(content);
			var link = document.createElement("a");
			link.setAttribute("href", encodedUri);
			link.setAttribute("download", "Text Record(" + time + ").txt");

			link.click();
		}

		function checkForRedundancy() {
			filter = $("[name='URL'] :selected").val();
			reloadData(filter)
		}

		function onRequestStart() {
			$("[name='URL']").attr("disabled", "disabled");
			$("#loading-status").html("loading...");
		}

		function onRequestEnd() {
			$("[name='URL']").removeAttr("disabled");
			$("#loading-status").html("&nbsp;");
		}

		function reloadData(filter) {
			onRequestStart();
			request(filter, peptide, protein_type, evidence, taxonomic_lineage, membrane_type, nonmembrane_type);
		}

		function request(filter, peptide, protein_type, evidence, taxonomic_lineage, membrane_type, nonmembrane_type) {
			var peptide_value = filter == "1" ? "Yes" : peptide == null ? "" : peptide.filter_value;
			var proteint_type_value = protein_type == null ? "" : protein_type.filter_value;
			var evidence_value = evidence == null ? "" : evidence.filter_value;
			var taxonomic_lineage_value = taxonomic_lineage == null ? "" : taxonomic_lineage.filter_value;
			var membrane_type_value = membrane_type == null ? "" : membrane_type.filter_value;
			var nonmembrane_type_value = nonmembrane_type == null ? "" : nonmembrane_type.filter_value;

			var limit = 10;
			var offset = 0;
			var percentage = $("#redundancy-percentage").val();

			var results = LZString.decompress(sessionStorage.getItem("results"));
			var peptide_data = JSON.parse(results);
			var size = Object.size(peptide_data);

			$.ajax({
				url: "/signal-peptide/controller/data_filter.php",
				data: {
					peptide: peptide_value,
					protein_type: proteint_type_value,
					evidence: evidence_value,
					taxonomic_lineage: taxonomic_lineage_value,
					membrane_type: membrane_type_value,
					nonmembrane_type: nonmembrane_type_value,
					limit: limit,
					offset: offset,
					percentage: percentage
				},

				beforeSend: function() {
					$("#datatable_loader").html('<center><img id="loading-status" class="loading-image" src="img/Preloader_3.gif" alt="loading..."></center>');	
					
					if(percentage != "None" && size > 300) {

						if (confirm("There are more than 300 entries. Results will be automatically sent to your email. ") == true) {
						        
						    var email = prompt("Please enter your email-addres", "zekah_anshe@yahoo.com");

							window.location = 'only_req_files/examples/smtp.php';
						    //alert("The results will be sent on the provided email.");						

						    $("#datatable_loader").html('');
						    //location.reload();

						} else {						    
						    $("#datatable_loader").html('');
						    return false;
						}
					}

				},

				success: function(data) {
					$("#datatable_loader").html('');

					response = JSON.parse(data);
					message = response.message;
					results = $.extend({}, response.result);
					//console.log(response);
					// set json data for datatable based on the fitler
					//TODO:: sessionStorage has a limit; we must compress the data pass to results using LZString
					//TODO:: find all references to resutls variable and decompress it
					//sessionStorage.setItem("results", JSON.stringify(results));

                    //console.log( LZString.compress( JSON.stringify(results) )  );
					sessionStorage.setItem("results", LZString.compress( JSON.stringify(results) ));

					 //console.log(results);
					// var a = LZString.compress( JSON.stringify(results) );
					// console.log( a  );
					// console.log(  LZString.decompress(a) );

				 	populateFilterResults(filter, results);
					onRequestEnd();
				},
				/*
				error: function() {
					alert("an error has occured on getting table data");
				},*/
			});

		}

		function populateFilterResults(filter, results) {

			if ($.fn.DataTable.isDataTable("#resultTable")) {
				//window.table = $("#resultTable").DataTable({});
				window.table.destroy();
				$("#resultTable").empty();
			}

			//TODO:: decompress the results LZString

			content_text = "";
			content_fasta = "";

			var data = new Array();
			for (index in results) {

				result = results[index];
				row = getFilterRow(filter, result);

				content_fasta = content_fasta + result.fasta + "\n";


				var funct = "";
				var sub_loc = "";
				var signal = "";
				var transmem = "";
				var trans = "";
				var kw = "";

				//for (key in row) {
				//	content_text = content_text + row[key] + "\r\t\t"
				//}

				if(!!result.functions) {
					funct = "CC   -!- FUNCTION: " + result.functions + "\n";
				}
				if(!!result.subcellularLocation) {
					sub_loc = "CC   -!- SUBCELLULAR LOCATION: " + result.subcellularLocation + "\n";
				}
				if(result.isSignal == "1") {
					signal = "FT   SIGNAL\t" + result.singalLength + "\n";
				}
				if(result.profileType == "Transmembrane") {
					if(result.topologyLength == 1) {
						transmem = "FT   TRANSMEM\t" + result.topologyOrientation + "\n";
					} else {
						var position = result.topologyOrientation;
						var array_position = position.split(",");
					//	console.log(array_position);
						for(var i = 0; i < array_position.length; i++) {
							trans += "FT   TRANSMEM\t" + array_position[i].trim("\n") + "\n";
						}
						transmem += trans;
					}
					kw = "KW   Transmembrane (" + result.topologyLength + ")\n";
				} else
					kw = "KW   Non-Transmembrane\n";

				content_text = content_text +
								"ID   " + result.entryName + "\t\t" + result.sequenceLength + "\n" +
								"AC   " + result.entryId + "\n" +
								"DT   " + result.dateCreated + "\t\t(Date Created)\n" +
								"DT   " + result.dateLastModified + "\t\t(Date Modified)\n" +
								"OC   " + result.taxonomicLineage + "\n" +
								funct +
								sub_loc +
								"PE   " + result.proteinExistence + "\n" +
								kw +
								signal +
								transmem +
								"SQ   SEQUENCE\t" + result.sequenceLength + "\n" +
								"     " + result.sequence + "\n" +
								"//\r\n\r\n" ;

				data.push(row);
			}

			//create tfoot
			var tf = '<tfoot><tr>';
			$.each( getFilterHeader(filter), function(){
				tf += '<th>'+this.title+'</th>';
			} );
			tf += '</tr></tfoot>';
			$("#resultTable").append(tf);

			// create placeholder
			$('#resultTable tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
			} );

			window.table = $("#resultTable").DataTable({
				columns: getFilterHeader(filter),
				data: data

			});

			// bind inputs to filter
 			window.table.columns().every( function () {
				var that = this;
				$( 'input', this.footer() ).on( 'keyup change', function () {
						//console.log(  that.search() );
						if ( that.search() !== this.value ) {
								that
										.search( this.value )
										.draw();
						}
				});
			});

		}

		function getFilterRow(filter, result) {
			filter_data = filter_rows[filter];
			var row = new Array();
			for (index in filter_data) {
				key = filter_data[index];
				value = "";
				if (key in result) {
					value = result[key];
				}
				row.push(value);
			}
			return row;
		}

		function getFilterHeader(filter) {
			if (filter == null || filter == "") {
				filter = "1";
			}
			return filter_headers[filter];
		}

		function appendFilterDetails(title, category) {
			if (category != null) {
				text = category.filter_text;
				if (text != "None") {
					$("#filter-details").append(getBreadcrumListItem(title, text));
				} else {
					$("#filter-details").append(getBreadcrumListItem(title, "All"));
				}
			}
		}

		function getBreadcrumListItem(title, text) {
			html = "<li class=\"active\">" + title + " : " + text + "</li>";
			return html;
		}

		// http://stackoverflow.com/questions/11582512/how-to-get-url-parameters-with-javascript
		function getURLParameter(name) {
		  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
		}
	</script>
	<!-- Bootstrap Core JavaScript -->

</body>
</html>
