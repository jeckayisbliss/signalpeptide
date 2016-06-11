<style type="text/css">
      #tblGridTaxonomy {
        background: #EEE9E9;
        border: 2px;
      }
      #tblGridProteinType {
        background: #EEE9E9;
        border: 1px;
      }
      #tblGridMembraneType {
        background: #EEE9E9;
        border: 1px;
      }
      #tblGridNonmembraneType {
        background: #EEE9E9;
        border: 1px;
      }
      #tblGridEvidenceLevel {
        background: #EEE9E9;
        border: 1px;kground: white;
      }
</style>
<div class="bs-examples" style="border:1px solid black;">
  <div class="modal fade" id="recordTable">
    <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <!-- <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title text-primary fa fa-user"> Entries Table</h3>
          </div>
          <div class="modal-body">
              <!-- Table for Taxonomy -->
              <!-- <div id ="taxonomy_div" background-color = "#ffffff"> -->
              <div id ="taxonomy_div">
                <table class="table table-striped" id="tblGridTaxonomy">
                  <thead id="tblHead"></thead>
                  <tbody></tbody>
                </table>
                <button type="button" class="btn btn-primary" id="dloadTaxonomy">Download Taxonomy Table</button>
              </div>

              <!-- <div class="row">____________________________________________________________________________________________</div> -->

              <!--Table for Protein Type -->
              <div id = "protein_div">
                <table class="table table-striped" id="tblGridProteinType">
                  <thead id="tblHead"></thead>
                  <tbody></tbody>
                </table>
                <button type="button" class="btn btn-primary" id="dloadProtein">Download Protein Type Table</button>
              </div>

              <!-- <div class="row">____________________________________________________________________________________________</div> -->

              <!-- Table for Membrane Type -->
              <div id = "membrane_div">
                <table class="table table-striped" id="tblGridMembraneType">
                  <thead id="tblHead"></thead>
                  <tbody></tbody>
                </table>
                <button type="button" class="btn btn-primary" id="dloadMembrane">Download Membrane Type Table </button>
                <button type="button" class="btn btn-primary" id="dloadMembraneProtein">Download Membrane Type Table </button>
              </div>

              <!-- Table for Nonmembrane Type -->
              <div id = "nonmembrane_div">
                <table class="table table-striped" id="tblGridNonmembraneType">
                  <thead id="tblHead"></thead>
                  <tbody></tbody>
                </table>
                <button type="button" class="btn btn-primary" id="dloadNonmembrane">Download Non-Membrane Type Table </button>
                <button type="button" class="btn btn-primary" id="dloadNonmembraneProtein">Download Non-Membrane Type Table </button>
              </div>

              <!-- <div class="row">____________________________________________________________________________________________</div> -->

              <!-- Table for Evidence Level -->

              <div id = "evidence_div">
                <table class="table table-striped" id="tblGridEvidenceLevel">
                  <thead id="tblHead"></thead>
                  <tbody></tbody>
                </table>
                <button type="button" class="btn btn-primary" id="dloadEvidence">Download Evidence Table </button>
              </div>

            </div><!-- /.modal body -->
            <div class="modal-footer">
              <!-- <button type="button" onclick="javascript:window.location.reload()" class="btn btn-default " data-dismiss="modal">Close</button> -->
              <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
            </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>



<script>
//download Taxonomy table
  $('#dloadTaxonomy').click(function(){
    html2canvas($('#tblGridTaxonomy'),
    {
      onrendered: function (canvas) {
        var a = document.createElement('a');
        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
        a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        a.download = 'taxonomy_table.png';
        a.click();
      }
    });
  });

  //download Protein table
    $('#dloadProtein').click(function(){
      html2canvas($('#tblGridProteinType'),
      {
        onrendered: function (canvas) {
          var a = document.createElement('a');
          // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
          a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
          a.download = 'protein_table.png';
          a.click();
        }
      });
    });

    //download Membrane table
      $('#dloadMembrane').click(function(){
        html2canvas($('#tblGridMembraneType'),
        {
          onrendered: function (canvas) {

            var a = document.createElement('a');
            // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
            a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            a.download = 'membrane_table.png';
            a.click();
          }
        });
      });

      //download Membrane table
        $('#dloadMembraneProtein').click(function(){
          html2canvas($('#tblGridMembraneType'),
          {
            onrendered: function (canvas) {

              var a = document.createElement('a');
              // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
              a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
              a.download = 'membrane_table.png';
              a.click();
            }
          });
        });


      //download Nonmembrane table
        $('#dloadNonmembrane').click(function(){
          html2canvas($('#tblGridNonmembraneType'),
          {
            onrendered: function (canvas) {

              var a = document.createElement('a');
              // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
              a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
              a.download = 'nonmembrane_table.png';
              a.click();
            }
          });
        });

        //download Nonmembrane table
          $('#dloadNonmembraneProtein').click(function(){
            html2canvas($('#tblGridNonmembraneType'),
            {
              onrendered: function (canvas) {

                var a = document.createElement('a');
                // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
                a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                a.download = 'nonmembrane_table.png';
                a.click();
              }
            });
          });

      //download Protein table
        $('#dloadEvidence').click(function(){
          html2canvas($('#tblGridEvidenceLevel'),
          {
            onrendered: function (canvas) {
              var a = document.createElement('a');
              // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
              a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
              a.download = 'evidence_table.png';
              a.click();
            }
          });
        });

// Tables
  function FilterTables() {

    var results = LZString.decompress(sessionStorage.getItem("results"));
    var peptide_data = JSON.parse(results);

    //Taxonomy
    var bacteria_entries_count  = 0;
    var eukaryota_entries_count  = 0;
    var archaea_entries_count  = 0;
    var viruses_entries_count  = 0;

    //Protein Type
    var transmem_entries_count  = 0;
    var nontransmem_entries_count  = 0;

    //Membrane Type
    var single_entries_count = 0;
    var multi_entries_count = 0;
    var beta_entries_count = 0;

    //Nonmembrane Type
    var secretory_entries_count = 0;
    var nonsecretory_entries_count = 0;

    //Evidence Level
    var experimental_entries_count = 0;
    var nonexperimental_entries_count = 0;


    $.each(peptide_data, function(key, value){
        //Conditions for Taxonomy
        var bac = window.bacteria_entries_count;

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

        //Conditions for Protein Type
        if(value.profileType == "Transmembrane") {
            transmem_entries_count++;
        }
        else if (value.profileType == "Globular") {
            nontransmem_entries_count++;
        }

        //Condition for Membrane Type
        if(value.profileType == "Transmembrane") {
            if(value.segmentType == "Single-pass membrane") {
                single_entries_count++;
            }
            else if(value.segmentType == "Multi-pass membrane") {
                multi_entries_count++;
            }
            else {
                beta_entries_count++;
            }
        }


        //Condition for Nonmembrane Type
        if(value.profileType == "Globular")
        {
            if(value.subcellularLocation.match(/^.*Secreted.*/)) {
                secretory_entries_count++;
            }
            else {
                nonsecretory_entries_count++;
            }
        }

        // Condition for Evidence Level
        if(value.proteinExistence == "Evidence at protein level") {
            experimental_entries_count++;
        }
        else if(value.proteinExistence == "Evidence at transcript level" || "Inferred from homology" || "Predicted" || "Uncertain") {
            nonexperimental_entries_count++;
        }
    });

  function showTaxonomy() {
      //Array to Table - Taxonomy
      var table_tax_head = $("#tblGridTaxonomy > thead");
      var table_taxonomy = $("#tblGridTaxonomy > tbody");

      var taxonomy_total = eukaryota_entries_count + archaea_entries_count + bacteria_entries_count + viruses_entries_count;
      var eukaryota_percent = ((eukaryota_entries_count / taxonomy_total)*100).toFixed(2);
      var archaea_percent = ((archaea_entries_count / taxonomy_total)*100).toFixed(2);
      var bacteria_percent = ((bacteria_entries_count / taxonomy_total)*100).toFixed(2);
      var viruses_percent = ((viruses_entries_count / taxonomy_total)*100).toFixed(2);

      if(taxonomy_total == 0) {
        document.getElementById("taxonomy_div").innerHTML = "<b><center>No Taxonomy table to show<center></b>";
      }
      else {
        table_tax_head.append("<h5 class='text-center'/><b>"+"Taxonomy"+"</b></h5>");
        table_tax_head.append(
          // "<tr><h5>"+"Taxonomy"+"</h5></tr>"+
          "<tr id='text-center'/>"+
          "<th>"+"Taxonomy Name"+"</th>"+
          "<th>"+"Count"+"</th>"+
          "<th>"+"Percent"+"</th>"+
          "</tr>");

        $("#eukaryota_entry_count tbody").append(eukaryota_entries_count);
        table_taxonomy.append(
          "<tr>"+
          "<td><center>"+"Eukaryota"+"</center></td>"+
          "<td><center>"+eukaryota_entries_count+"</center></td>"+
          "<td><center>"+ eukaryota_percent + " %" + "</center></td>"+
          "</tr>");

        $("#archaea_entry_count").append(archaea_entries_count);
        table_taxonomy.append("<tr><td><center>"+"Archaea"+"</center></td><td><center>"+archaea_entries_count+"</center></td><td><center>"+ archaea_percent + " %" + "</center></td></tr>");

        $("#bacteria_entry_count").append(bacteria_entries_count);
        table_taxonomy.append("<tr><td><center>"+"Bacteria"+"</center></td><td><center>"+bacteria_entries_count+"</center></td><td><center>"+ bacteria_percent + " %"+ "</center></td></tr>");

        $("#viruses_entry_count").append(viruses_entries_count);
        table_taxonomy.append("<tr><td><center>"+"Viruses"+"</center></td><td><center>"+viruses_entries_count+"</center></td><td><center>"+ viruses_percent + " %" + "</center></td></tr>");

        table_taxonomy.append("<tr><td><center><b>"+"Total Taxonomy Count"+"</b></center></td><td><center><b>"+taxonomy_total+"</b></center></td><td><center><b>"+"100 %"+"</td></b></center></tr>");
      }
  }

  function showProtein() {
      //Array to table - Protein Type
      var table_prot_head = $("#tblGridProteinType > thead");
      var table_proteinType = $("#tblGridProteinType > tbody");

      var protein_total = transmem_entries_count + nontransmem_entries_count;

      var transmem_percent = ((transmem_entries_count / protein_total)*100).toFixed(2);
      var nontransmem_percent = ((nontransmem_entries_count / protein_total)*100).toFixed(2);

      if(protein_total == 0) {
        document.getElementById("protein_div").innerHTML = "<b><center>No Protein table to show<center></b>";
      }
      else {
        table_prot_head.append("<h5 class='text-center'/><b>"+"Protein Type"+"</b></h5>");
        table_prot_head.append(
          "<tr id='text-center'/>"+
          "<th>"+"Protein Type"+"</th>"+
          "<th>"+"Count"+"</th>"+
          "<th>"+"Percent"+"</th>"+
          "</tr>");

        $("#transmem_entries_count").append(transmem_entries_count);
        table_proteinType.append("<tr><td><center>"+"Transmembrane"+"</center></td><td><center>"+transmem_entries_count+"</center></td><td><center>"+ transmem_percent + " %" + "</center></td></tr>");

        $("#nontransmem_entries_count").append(nontransmem_entries_count);
        table_proteinType.append("<tr><td><center>"+"Non-Transmembrane"+"</center></td><td><center>"+nontransmem_entries_count+"</center></td><td><center>"+ nontransmem_percent + " %" + "</center></td></tr>");

        table_proteinType.append("<tr><td><center><b>"+"Total Transmembrane Count"+"</b></center></td><td><center><b>"+protein_total+"</b></center></td><td><center><b>"+"100 %"+"</td></b></center></tr>");
      }
  }

  function showMembrane() {
      //Array to Table - Membrane Type
      var table_mem_head = $("#tblGridMembraneType > thead");
      var table_membraneType = $("#tblGridMembraneType > tbody");

      var membrane_total = single_entries_count + multi_entries_count + beta_entries_count;
      var single_percent = ((single_entries_count / membrane_total)*100).toFixed(2);
      var multi_percent = ((multi_entries_count / membrane_total)*100).toFixed(2);
      var beta_percent = ((beta_entries_count / membrane_total)*100).toFixed(2);

      if(membrane_total == 0) {
        document.getElementById("membrane_div").innerHTML = "<b><center>No Membrane table to show<center></b>";
      }
      else {
        table_mem_head.append("<h5 class='text-center'/><b>"+"Membrane Type"+"</b></h5>");
        table_mem_head.append(
          "<tr id='text-center'/>"+
              "<th>"+"Membrane Type"+"</th>"+
              "<th>"+"Count"+"</th>"+
              "<th>"+"Percent"+"</th>"+
          "</tr>");

        $("#single_entry_count").append(single_entries_count);
        table_membraneType.append("<tr><td><center>"+"Single spanning membrane"+"</center></td><td><center>"+single_entries_count+"</center></td><td><center>"+ single_percent +" %"+ "</center></td></tr>");

        $("#multi_entry_count").append(multi_entries_count);
        table_membraneType.append("<tr><td><center>"+"Multi spanning membrane"+"</center></td><td><center>"+multi_entries_count+"</center></td><td><center>"+ multi_percent +" %"+ "</center></td></tr>");

        $("#beta_entry_count").append(beta_entries_count);
        table_membraneType.append("<tr><td><center>"+"Beta-barrel membrane"+"</center></td><td><center>"+beta_entries_count+"</center></td><td><center>"+ beta_percent +" %"+ "</center></td></tr>");

        table_membraneType.append("<tr><td><center><b>"+"Total Membrane Count"+"</b></center></td><td><center><b>"+membrane_total+"</b></center></td><td><center><b>"+"100 %"+"</td></b></center></tr>");
      }
  }


  function showNonmembrane() {
      //Array to Table - Membrane Type
      var table_nonmem_head = $("#tblGridNonmembraneType > thead");
      var table_nonmembraneType = $("#tblGridNonmembraneType > tbody");

      var nonmembrane_total = secretory_entries_count + nonsecretory_entries_count;
      var secretory_percent = ((secretory_entries_count / nonmembrane_total)*100).toFixed(2);
      var nonsecretory_percent = ((nonsecretory_entries_count / nonmembrane_total)*100).toFixed(2);

      if(nonmembrane_total == 0) {
        document.getElementById("nonmembrane_div").innerHTML = "<b><center>No Non-Membrane table to show<center></b>";
      }
      else {
        table_nonmem_head.append("<h5 class='text-center'/><b>"+"Non-Membrane Type"+"</b></h5>");
        table_nonmem_head.append(
          "<tr id='text-center'/>"+
          "<th>"+"Non-Membrane Type"+"</th>"+
          "<th>"+"Count"+"</th>"+
          "<th>"+"Percent"+"</th>"+
          "</tr>");

        $("#secretory_entry_count").append(secretory_entries_count);
        table_nonmembraneType.append("<tr><td><center>"+"Secretory"+"</center></td><td><center>"+secretory_entries_count+"</center></td><td><center>"+ secretory_percent +" %"+ "</center></td></tr>");

        $("#nonsecretory_entry_count").append(nonsecretory_entries_count);
        table_nonmembraneType.append("<tr><td><center>"+"Non-Secretory"+"</center></td><td><center>"+nonsecretory_entries_count+"</center></td><td><center>"+ nonsecretory_percent +" %"+ "</center></td></tr>");

        table_nonmembraneType.append("<tr><td><center><b>"+"Total Non-Membrane Count"+"</b></center></td><td><center><b>"+nonmembrane_total+"</b></center></td><td><center><b>"+"100 %"+"</td></b></center></tr>");
      }
  }

  function showEvidence() {
      //Array to Table - Evidence Level
      var table_evi_head = $("#tblGridEvidenceLevel > thead");
      var table_evidenceLevel = $("#tblGridEvidenceLevel > tbody");

      var evidence_total = experimental_entries_count + nonexperimental_entries_count;
      var exp_percent = ((experimental_entries_count / evidence_total)*100).toFixed(2);
      var nonexp_percent = ((nonexperimental_entries_count / evidence_total)*100).toFixed(2);

      if(evidence_total == 0) {
        document.getElementById("evidence_div").innerHTML = "<b><center>No Evidence table to show<center></b>";
      }
      else {
        table_evi_head.append("<h5 class='text-center'/><b>"+"Evidence Level"+"</b></h5>");
        table_evi_head.append(
          "<tr id='text-center'/>"+
          "<th>"+"Evidence Level"+"</th>"+
          "<th>"+"Count"+"</th>"+
          "<th>"+"Percent"+"</th>"+
          "</tr>");

        $("#experimental_entry_count").append(experimental_entries_count);
        table_evidenceLevel.append("<tr><td><center>"+"Experimental Entries"+"</center></td><td><center>"+experimental_entries_count+"</center></td><td><center>"+ exp_percent +" %" + "<center></td></tr>");
        $("#nonexperimental_entry_count").append(nonexperimental_entries_count);
        table_evidenceLevel.append("<tr><td><center>"+"Non-Experimental Entries"+"</center></td><td><center>"+nonexperimental_entries_count+"</center></td><td><center>"+ nonexp_percent + " %" + "</center></td></tr>");

        table_evidenceLevel.append("<tr><td><center><b>"+"Total Evidence Count"+"</b></center></td><td><center><b>"+evidence_total+"</b></center></td><td><center><b>"+"100 %"+"</td></b></center></tr>");
      }
  }

  //show hide tables
      signal = JSON.parse(sessionStorage.getItem("peptide"));
      taxonomy = JSON.parse(sessionStorage.getItem("taxonomic_lineage"));
      protein = JSON.parse(sessionStorage.getItem("protein_type"));
      membrane = JSON.parse(sessionStorage.getItem("membrane_type"));
      nonmembrane = JSON.parse(sessionStorage.getItem("nonmembrane_type"));
      evidence = JSON.parse(sessionStorage.getItem("evidence"));


      if(taxonomy.filter_text == "All") {
        showTaxonomy();
      }
      else if(taxonomy.filter_text != "All")  {
        document.getElementById('dloadTaxonomy').style.display = "none";
      }
      if(protein.filter_text == "All") {
        showProtein();
        showMembrane();
        showNonmembrane();
      }
      else if(protein.filter_text != "All")  {
        document.getElementById('dloadProtein').style.display = "none";
        document.getElementById('dloadMembraneProtein').style.display = "none";
        document.getElementById('dloadNonmembraneProtein').style.display = "none";
      }
      if(membrane.filter_text == "All") {
        showMembrane();
        document.getElementById('dloadNonmembrane').style.display = "none";
      }
      else if(membrane.filter_text != "All")  {
        document.getElementById('dloadMembrane').style.display = "none";
      }
      if(nonmembrane.filter_text == "All") {
          showNonmembrane();
          document.getElementById('dloadMembrane').style.display = "none";
      }
      else if(nonmembrane.filter_text != "All")
      {
          document.getElementById('dloadNonmembrane').style.display = "none";
      }
      if(evidence.filter_text == "All") {
        showEvidence();
      }
      else if(evidence.filter_text != "All")  {
        document.getElementById('dloadEvidence').style.display = "none";
      }
      else {
        noTable();
      }
  }
</script>
