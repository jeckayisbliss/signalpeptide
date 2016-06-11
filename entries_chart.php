<div class="bs-examples" style="border:1px solid black; ">
	<div id="recordChart" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<button type="button" class="close" data-dismiss="modal">x</button>
					<h1 class="modal-title text-primary fa fa-user"><?php echo "Entry"; ?> Chart</h1>
				</div>
				<div class="modal-body">
					<div class="container">

						<!-- Default Chart - Chart for Signal Length -->
            <div id="nochart"></div>
						<div id="chart-area" style="min-height:400px" ></div>
						<a class="btn btn-primary" id="downloadSignal" href="" download>Download Signal Length Chart</a>
						<div class="row" line-height="20px"></div>

						<!-- Chart for Taxonomy -->
            <div id="notaxonomy"></div>
						<div id="chart-taxonomy" style="min-height:400px"></div>
						<a class="btn btn-primary" id="downloadTaxonomyChart" href="" download>Download Taxonomy Chart</a>
						<div class="row" line-height="50px"></div>

						<!-- Chart for Transmembrane -->
            <div id="noprotein"></div>
						<div id="chart-transmembrane" style="min-height:400px"></div>
						<a class="btn btn-primary" id="downloadTransmembraneChart" href="" download>Download Transmembrane Chart</a>
						<div class="row" line-height="50px"></div>

						<!-- Chart for Membrane -->
            <div id="nomembrane"></div>
						<div id="chart-membrane" style="min-height:400px"></div>
						<a class="btn btn-primary" id="downloadMembraneChart" href="" download>Download Membrane Chart</a>
						<div class="row" line-height="50px"></div>

						<!-- Chart for Non-membrane -->
            <div id="nononmembrane"></div>
						<div id="chart-nonmembrane" style="min-height:400px"></div>
						<a class="btn btn-primary" id="downloadNonmembraneChart" href="" download>Download Non-Membrane Chart</a>
						<div class="row" line-height="50px"></div>

						<!-- Chart for Evidence -->
            <div id="noevidence"></div>
						<div id="chart-evidence" style="min-height:400px"></div>
						<a class="btn btn-primary" id="downloadEvidenceChart" href="" download>Download Evidence Chart</a>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    //TODO :: LZ string decompress
      signal =  JSON.parse(sessionStorage.getItem("peptide")) ;
      taxonomy =  JSON.parse(sessionStorage.getItem("taxonomic_lineage")) ;
      protein =  JSON.parse(sessionStorage.getItem("protein_type")) ;
      membrane =  JSON.parse(sessionStorage.getItem("membrane_type")) ;
	    nonmembrane = JSON.parse(sessionStorage.getItem("nonmembrane_type"));
      evidence =  JSON.parse(sessionStorage.getItem("evidence")) ;

			// console.log(protein);
			// console.log(nonmembrane);

	function createData() {
		var new_data = new Array();
		new_data.push(new Array('', 'Length (AA)' ));

		var results = LZString.decompress(sessionStorage.getItem("results"));
		var peptide_data =  JSON.parse(results);


		$.each(peptide_data, function(key, value){
			var entryName = value.entryName;
			var sequenceLength = value.sequenceLength.replace('AA', '');
			sequenceLength = $.trim(sequenceLength);
			sequenceLength = parseInt(sequenceLength);
      var new_data_item = new Array(entryName, sequenceLength);
      new_data.push(new_data_item);

      // if(sequenceLength == "0") {
      //   document.getElementById('nochart').innerHTML = "<b>No chart to show</b>";
      //   document.getElementById('chart-area').style.display = "none";
      //   document.getElementById('downloadSignal').style.display = "none";
      // }
		});
		return new_data;
	}

	google.load("visualization", "1", {packages:["corechart"]});

	$(document).ready(function(){
		$('#recordChart').on('shown.bs.modal', function (e) {

			var data = google.visualization.arrayToDataTable( createData() );

			var options = {
			  title: 'Sequence Lengths , in AA',
			  legend: { position: 'none' },
			  // histogram: { bucketSize: 5 },
			  width: '80%', height: '100%',
			  chartArea:{width: "50%"},
				hAxis: {title: 'Sequence Length', showTextEvery: 0, slantedText: true, slantedTextAngle: 90},
				vAxis: {title: 'No. of Entries'},
				backgroundColor: "#EEE9E9",
			// chartArea: {top: 0, right: 0, bottom: 0, height:'95%', width:'70%'},
			};

			// var height = data.getNumberOfRows() * 41 + 30;
			var height = data.getNumberOfRows() * 2 + 30;
			//console.log(height);

			$(this).find('#chart-area').css({height: height});

			var chart = new google.visualization.Histogram(document.getElementById('chart-area'));
			chart.draw(data, options);

			$("#downloadSignal").attr("href", chart.getImageURI()); //download img

			//resize modal
			$('.modal .modal-body').css('max-height', $(window).height() * 0.8);
			$('.modal .modal-lg').css('width', $(window).width() * 0.8);
			$('.modal .modal-body').css('overflow-y', 'auto');
			//resize modal
		});
	});

	//Chart for Taxonomy
	function TaxonomyChart() {

		var new_data = new Array();
		new_data.push(new Array('Taxonomy', 'Count' ));

		var results = LZString.decompress(sessionStorage.getItem("results"));
		var peptide_data = JSON.parse(results);

	    var bacteria_entries_count  = 0;
	    var eukaryota_entries_count  = 0;
	    var archaea_entries_count  = 0;
	    var viruses_entries_count  = 0;

		$.each(peptide_data, function(key, value){

		      if(value.taxonomicLineage == "Bacteria") {
		          bacteria_entries_count++;
		      }
		      else if (value.taxonomicLineage == "Eukaryota") {
		          eukaryota_entries_count++;
		      }
		      else if (value.taxonomicLineage == "Archaea") {
		          archaea_entries_count++;
		      }
		      else if (value.taxonomicLineage == "Viruses") {
		          viruses_entries_count++;
		      }

		});

		var eukar_chart = new Array("Eukaryota", eukaryota_entries_count);
		new_data.push(eukar_chart);

		var bacteria_chart = new Array("Bacteria", bacteria_entries_count);
		new_data.push(bacteria_chart);

		var archaea_chart = new Array("Archaea", archaea_entries_count);
		new_data.push(archaea_chart);

		var virus_chart = new Array("Viruses", viruses_entries_count);
		new_data.push(virus_chart);

    var taxtotal = eukaryota_entries_count + bacteria_entries_count + archaea_entries_count + viruses_entries_count;
    if(taxtotal == "0") {
      document.getElementById('notaxonomy').innerHTML = "<b>No Taxonomy chart to show</b>";
      document.getElementById('chart-taxonomy').style.display = "none";
      document.getElementById('downloadTaxonomyChart').style.display = "none";
    }

		return new_data;
	}

	google.load("visualization", "1", {packages:["corechart"]});
	// google.setOnLoadCallback(drawChart);

	$(document).ready(function(){
		$('#recordChart').on('shown.bs.modal', function (e) {


    //if else for chart visibility
	if( taxonomy.filter_text == "All" ) {

			var data = google.visualization.arrayToDataTable( TaxonomyChart() );

			var options = {
			  	title: 'Taxonomy Count',
				is3D: true,
			  	legend: { position: 'right' },
				colors: ['465fff', 'bf6aff', 'ff84d1', 'ffd743'],
			  	width: '80%', height: '100%',
			  	chartArea:{ width: '50%' },
				hAxis: {title: 'No. of Entries'},
				vAxis: {title: 'Taxonomy'},
				backgroundColor: "#EEE9E9",
			  };

			var height = data.getNumberOfRows() * 2 + 30;

			$(this).find('#chart-taxonomy').css({height: height});

			var chart = new google.visualization.PieChart(document.getElementById('chart-taxonomy'));
			chart.draw(data, options);

			$("#downloadTaxonomyChart").attr("href", chart.getImageURI()); //download img

			//resize modal
			$('.modal .modal-body').css('max-height', $(window).height() * 0.8);
			$('.modal .modal-lg').css('width', $(window).width() * 0.8);
			$('.modal .modal-body').css('overflow-y', 'auto');
		}

		else{
			document.getElementById('chart-taxonomy').style.display = "none";
			document.getElementById('downloadTaxonomyChart').style.display = "none";
		}

		});
	});


	//chart for Segments
	function MembraneChart() {

		var new_data = new Array();
		new_data.push(new Array('Membrane', 'Count' ));

		var results = LZString.decompress(sessionStorage.getItem("results"));
		var peptide_data = JSON.parse(results);

			var single_entries_count  = 0;
			var multi_entries_count  = 0;
			var beta_entries_count = 0;

		$.each(peptide_data, function(key, value){
			if(value.profileType == "Transmembrane") {
				if(value.segmentType == "Single-pass membrane") {
						single_entries_count++;
				}
				else if (value.segmentType == "Multi-pass membrane") {
						multi_entries_count++;
				}
				else {
					beta_entries_count++;
				}
			}

		});

		var single_chart = new Array("Single-pass membrane", single_entries_count);
		new_data.push(single_chart);

		var multi_chart = new Array("Multi-pass membrane", multi_entries_count);
		new_data.push(multi_chart);

		var beta_chart = new Array("Beta-barrel membrane", beta_entries_count);
		new_data.push(beta_chart);

    var memtotal = single_entries_count + multi_entries_count + beta_entries_count;
    if(memtotal == "0") {
      document.getElementById('nomembrane').innerHTML = "<b>No Membrane chart to show</b>";
      document.getElementById('chart-membrane').style.display = "none";
      document.getElementById('downloadMembraneChart').style.display = "none";
    }

		return new_data;
	}

	google.load("visualization", "1", {packages:["corechart"]});

	$(document).ready(function(){
		$('#recordChart').on('shown.bs.modal', function (e) {

			//if else for chart visibility
			if( membrane.filter_text == "All" || protein.filter_text == "All") {

			var data = google.visualization.arrayToDataTable( MembraneChart() );

			var options = {
				title: 'Membrane Count',
				is3D: true,
				legend: { position: 'right' },
				colors: ['#ff8bba', '#9af2ff', '#eff6b4'],
				// histogram: { bucketSize: 5 },
				width: '80%', height: '100%',
				chartArea:{ width: '50%' },
				hAxis: {title: 'No. of Entries'},
				vAxis: {title: 'Membrane'},
				backgroundColor: "#EEE9E9",
			};

			var height = data.getNumberOfRows() * 2 + 30;
			//console.log(height);

			$(this).find('#chart-membrane').css({height: height});

			var chart = new google.visualization.PieChart(document.getElementById('chart-membrane'));
			chart.draw(data, options);

			$("#downloadMembraneChart").attr("href", chart.getImageURI()); //download img

			//resize modal
			$('.modal .modal-body').css('max-height', $(window).height() * 0.8);
			$('.modal .modal-lg').css('width', $(window).width() * 0.8);
			$('.modal .modal-body').css('overflow-y', 'auto');

		}
			else {
				document.getElementById('chart-membrane').style.display = "none";
				document.getElementById('downloadMembraneChart').style.display = "none";
			}

		});
});

//Chart for Non-membrane
function NonmembraneChart() {

	var new_data = new Array();
	new_data.push(new Array('Non-Membrane', 'Count' ));

	var results = LZString.decompress(sessionStorage.getItem("results"));
	var peptide_data = JSON.parse(results);

	var secretory_entries_count  = 0;
	var nonsecretory_entries_count  = 0;
	// console.log(value.subcellularLocation);

	$.each(peptide_data, function(key, value){
		if(value.profileType == "Globular") {
			if(value.subcellularLocation.match(/^.*Secreted.*/)) {
  			  secretory_entries_count++;
  		  }
  		  else {
  			  nonsecretory_entries_count++;
  		  }
		}


	});

	var secretory_chart = new Array("Secretory", secretory_entries_count);
	new_data.push(secretory_chart);

	var nonsecretory_chart = new Array("Non-Secretory", nonsecretory_entries_count);
	new_data.push(nonsecretory_chart);

  var nonmemtotal = secretory_entries_count + nonsecretory_entries_count;
  if(nonmemtotal == "0") {
    document.getElementById('nononmembrane').innerHTML = "<b>No Nonmembrane chart to show</b>";
    document.getElementById('chart-nonmembrane').style.display = "none";
    document.getElementById('downloadNonmembraneChart').style.display = "none";
  }

	return new_data;
}

google.load("visualization", "1", {packages:["corechart"]});
// google.setOnLoadCallback(drawChart);

$(document).ready(function(){
	$('#recordChart').on('shown.bs.modal', function (e) {


//if else for chart visibility
if( nonmembrane.filter_text == "All" || protein.filter_text == "All") {

		var data = google.visualization.arrayToDataTable( NonmembraneChart() );

		var options = {
		  title: 'Non-Membrane Chart',
			is3D: true,
		  legend: { position: 'right' },
			colors: ['#ffa331', '#7fe5c9'],
		  width: '80%', height: '100%',
		  chartArea:{ width: '50%' },
			hAxis: {title: 'No. of Entries'},
			vAxis: {title: 'Non-Membrane'},
			backgroundColor: "#EEE9E9",
		  };

		var height = data.getNumberOfRows() * 2 + 30;

		$(this).find('#chart-nonmembrane').css({height: height});

		var chart = new google.visualization.PieChart(document.getElementById('chart-nonmembrane'));
		chart.draw(data, options);

		$("#downloadNonmembraneChart").attr("href", chart.getImageURI()); //download img

		//resize modal
		$('.modal .modal-body').css('max-height', $(window).height() * 0.8);
		$('.modal .modal-lg').css('width', $(window).width() * 0.8);
		$('.modal .modal-body').css('overflow-y', 'auto');
	}
	else {
		document.getElementById('chart-nonmembrane').style.display = "none";
		document.getElementById('downloadNonmembraneChart').style.display = "none";
	}

	});
});


	//chart for Evidence
function EvidenceChart() {

	var new_data = new Array();
	new_data.push(new Array('Evidence Level', 'Count' ));

		var results = LZString.decompress(sessionStorage.getItem("results"));
		var peptide_data = JSON.parse(results);

		var exp_entries_count  = 0;
		var nonexp_entries_count  = 0;

	$.each(peptide_data, function(key, value){

		if(value.proteinExistence == "Evidence at protein level") {
				exp_entries_count++;
		}
		else if(value.segmentType == "Evidence at transcript level" || "Inferred by homology" || "Predicted" || "Uncertain") {
				nonexp_entries_count++;
		}
	});

	var exp_chart = new Array("Experimental Entries", exp_entries_count);
	new_data.push(exp_chart);

	var nonexp_chart = new Array("Nonexperimental Entries", nonexp_entries_count);
	new_data.push(nonexp_chart);

  var evitotal = exp_entries_count + nonexp_entries_count;
  if(evitotal == "0") {
    document.getElementById('noevidence').innerHTML = "<b>No Evidence chart to show</b>";
    document.getElementById('chart-evidence').style.display = "none";
    document.getElementById('downloadEvidenceChart').style.display = "none";
  }

	return new_data;
}

google.load("visualization", "1", {packages:["corechart"]});

$(document).ready(function(){
	$('#recordChart').on('shown.bs.modal', function (e) {

		//if else for chart visibility
		if( evidence.filter_text == "All" ) {

		var data = google.visualization.arrayToDataTable( EvidenceChart() );

		var options = {
			title: 'Evidence Level Count',
			is3D: true,
			legend: { position: 'right' },
			colors: ['#f26868', '#f4ce58'],
			// histogram: { bucketSize: 5 },
			width: '80%', height: '100%',
			chartArea:{ width: '50%' },
			hAxis: {title: 'No. of Entries'},
			vAxis: {title: 'Evidence Level'},
			backgroundColor: "#EEE9E9",
		};

		var height = data.getNumberOfRows() * 2 + 30;
		//console.log(height);
		$(this).find('#chart-evidence').css({height: height});

		var chart = new google.visualization.PieChart(document.getElementById('chart-evidence'));
		chart.draw(data, options);

		$("#downloadEvidenceChart").attr("href", chart.getImageURI()); //download img

		//resize modal
		$('.modal .modal-body').css('max-height', $(window).height() * 0.8);
		$('.modal .modal-lg').css('width', $(window).width() * 0.8);
		$('.modal .modal-body').css('overflow-y', 'auto');

	}
		else {
			document.getElementById('chart-evidence').style.display = "none";
			document.getElementById('downloadEvidenceChart').style.display = "none";
		}
	});
});

//chart for Transmembrane
function TransmembraneChart() {

	var new_data = new Array();
	new_data.push(new Array('Protein', 'Count' ));

	var results = LZString.decompress(sessionStorage.getItem("results"));
	var peptide_data = JSON.parse(results);

		var trans_entries_count  = 0;
		var nontrans_entries_count  = 0;

	$.each(peptide_data, function(key, value){

				if(value.profileType == "Transmembrane") {
					// console.log(value.profileType);
						trans_entries_count++;
				}
				else if (value.profileType == "Globular") {
						nontrans_entries_count++;
				}

	});

	var trans_chart = new Array("Transmembrane", trans_entries_count);
  new_data.push(trans_chart);

  var nontrans_chart = new Array("Non-Transmembrane", nontrans_entries_count);
  new_data.push(nontrans_chart);

  var prototal = trans_entries_count + nontrans_entries_count

  if(prototal == "0") {
    document.getElementById('noprotein').innerHTML = "<b>No Protein chart to show</b>";
    document.getElementById('chart-transmembrane').style.display = "none";
    document.getElementById('downloadTransmembraneChart').style.display = "none";
  }

	return new_data;
}

google.load("visualization", "1", {packages:["corechart"]});

$(document).ready(function(){
	$('#recordChart').on('shown.bs.modal', function (e) {

		//if else for chart visibility
		if( protein.filter_text == "All" ) {
			// console.log(protein.filter_text);

		var data = google.visualization.arrayToDataTable( TransmembraneChart() );

		var options = {
			title: 'Protein Count',
			is3D: true,
			legend: { position: 'right' },
			colors: ['#abd218', '#e33b3b'],
			// histogram: { bucketSize: 5 },
			width: '80%', height: '100%',
			chartArea:{ width: '50%' },
			sliceVisibilityThreshold: '.2',
			backgroundColor: "#EEE9E9",
			// hAxis: {title: 'No. of Entries'},
			// vAxis: {title: 'Transmembrane'},
		};

		var height = data.getNumberOfRows() * 2 + 30;
		//console.log(height);

		$(this).find('#chart-transmembrane').css({height: height});

		var chart = new google.visualization.PieChart(document.getElementById('chart-transmembrane'));
		chart.draw(data, options);

		$("#downloadTransmembraneChart").attr("href", chart.getImageURI()); //download img

		//resize modal
		$('.modal .modal-body').css('max-height', $(window).height() * 0.8);
		$('.modal .modal-lg').css('width', $(window).width() * 0.8);
		$('.modal .modal-body').css('overflow-y', 'auto');
	}
		else {
			document.getElementById('chart-transmembrane').style.display = "none";
			document.getElementById('downloadTransmembraneChart').style.display = "none";
		}

	});
});

</script>
