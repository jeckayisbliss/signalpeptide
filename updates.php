<?php
include_once 'lib/PDO_connect.php';

$query_str = "SELECT DISTINCT date_last_modified FROM sp_protein WHERE date_last_modified = (SELECT MAX(date_last_modified) FROM sp_protein)";
$query = $db->prepare($query_str);
$query->execute();
$rows = $query->fetch();

$date = $rows["date_last_modified"];

?>

<!DOCTYPE html>
<html lang="en">

<style>
#myProgress {
  position: relative;
  width: 100%;
  height: 30px;
  background-color: #ddd;
}

#myBar {
  position: absolute;
  width: 1%;
  height: 100%;
  background-color: #4CAF50;
}
+</style>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Protein Sequence Profiler</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="html5shiv.js"></script>
        <script src="respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <!-- Navigation -->
    <?php include_once('menu.php'); ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Updates</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Updates</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <input type="hidden" id="update_filename" />
        <!--<div>
            Last update is on: <strong><?php echo "$date";?></strong>
        </div>
        <div>
            Click button to see if there are new updates
            <input type="button" class="btn btn-success" value="Check Updates" onclick="checkUpdates()" />
        </div>-->
        <div class="row">
            <div class="col-lg-12">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#checkUpdatesModal" onclick="checkUpdates()" >Check Updates</button>
        <!-- Modal -->
        <div id="checkUpdatesModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button"  onclick="javascript:window.location.reload()"class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Check Updates</h4>
              </div>
              <div class="modal-body">

                <div id="import_loader"></div>

                <div class="row">
                    <label class="headerUpdate" style="font-weight:bold;">Available protein updates from UniProt:</label><br>
                </div>

                <div id="updates" class="row"></div>
                <div class="row">
                    <label class="headerUpdate" style="font-weight:bold;">New available proteins from UniProt:</label><br>
                </div>
                <div id="new" class="row"></div>
                <strong><p id="result"></p></strong>

              </div>
              <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-default" data-dismiss="modal">Close</button>
                <input id="install" style="display:none" class="btn btn-success" type="button" value="Install Updates" onclick="installUpdates()" data-dismiss="modal">
              </div>
            </div>

          </div>
        </div> <!--end modal content-->
      </div>
  </div>
                    <div id="loader"></div>

            <div>
               <p id="failed_message"></p>
            </div>

        <br>
        <br>
        <div id="import_loader"></div>
        <strong><p id="install_status">

        </p></strong>

        <!-- <hr> -->
        <!-- Footer -->
        <?php include_once('footer.php'); ?>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        //var update_url = "http://www.uniprot.org/uniprot/?query=&limit=10&format=txt";
        // var update_url = "http://localhost/signal-peptide/upload/1428770972_sample_update.txt"
        var update_url = "http://www.uniprot.org/uniprot/?sort=score&desc=&compress=no&query=reviewed:yes%20AND%20annotation:(type:signal)&fil=&limit=20&force=no&preview=true&format=txt"
        var protein_update = "/signal-peptide/controller/protein_update.php"
        var new_proteins;

        $(document).ready(function(){
            $(".headerUpdate").css("display", "none");
        });
        function checkUpdates() {
            $("#update_filename").val("");

            $.ajax({
              url: protein_update,
              data: {
                update_url: update_url,
                action: "check"
              },
              type: "POST",
              beforeSend: function() {
                $("#import_loader").html('<center><img id="loading-status" class="loading-image" src="img/Preloader_3.gif.gif" alt="loading..."></center>');
              },
              success: function(data) {

                  $("#import_loader").html('');

                  var response = jQuery.parseJSON(data);
                  var message = response.message;
                  var result = response.result;
                  var updates = result.updates;
                  new_proteins = result.new;
                  $(".headerUpdate").css("display", "inline");
                  $("#updates").html("");
                  $("#new").html("");

                  if ("file" in response) {
                      var update_filename = response.file;
                      $("#update_filename").val(update_filename);
                  }
                  //console.log(updates.length);
                  //console.log(new_proteins.length);

                  if (updates.length == 0) {
                      $("#updates").append("There are no existing proteins to be updated.");
                  } else {
                      html = "<ol>"
                      for (i = 0; i < updates.length; i++) {
                          var protein = updates[i];
                          html += "<li>" + protein.entryName + "</li>";
                      }
                      html += "</ol>";
                      $("#updates").append(html);
                  }

                  if (new_proteins.length == 0) {
                      $("#new").append("There are no new proteins to be inserted.");
                  } else {
                      html = "<ol>"
                      for (i = 0; i < new_proteins.length; i++) {
                          var protein = new_proteins[i];
                          html += "<li>" + protein.entryName + "</li>";
                      }
                      html += "</ol>";
                      $("#new").append(html);
                  }

                  if(updates.length == 0 && new_proteins.length == 0){
                      $("#install").css("display", "none");
                  }
                  else{
                      $("#install").css("display", "inline");
                  }
              },
              error: function() {
                alert("an error has occured on getting update data");
              }

            });

            // TODO:
            // [1] Check if Uniprot is down.
            // [2] Disable "Install Updates" button when there are no data to show
        }

        // function installUpdates() {
        //     update_filename = $("#update_filename").val();
        //     $.post(protein_update,
        //         { update_url: update_url, action: "install", file: update_filename },
        //         function(data) {
        //             var response = jQuery.parseJSON(data);
        //             var message = response.message;
        //             $("#result").html(message);
        //         }
        //     );
        // }

        function installUpdates() {
          var update_filename = $("#update_filename").val();
          startTime = performance.now();

          $.ajax({
              url: protein_update,
              data: {
                update_url: update_url,
                action: "install",
                file: update_filename
              },
              type: "POST",
              beforeSend: function() {
                $("#import_loader").html('<center><img id="loading-status" class="loading-image" src="img/Preloader_3.gif" alt="loading..."></center>');
              },
              success: function(data) {
                endTime = performance.now();
                execTime = endTime - startTime;
                var import_results = new_proteins.length;
                var message = '<div class="col-lg-12"> <p align="center" class="bg-success install-status-label">Successfully imported ' +import_results+ ' entries to database. Execution time: ' +  execTime + '. </p> </div>';
                $("#import_loader").html('');

                //$("#install_status").html('<div class="col-lg-12"> <p align="center" class="bg-success install-status-label">Successfully imported  to //database</p> </div>');
                document.getElementById("install_status").innerHTML = message;
              },
              error: function() {
                alert("an error has occured on getting table data");
              }

            });

        }
    </script>
</body>
</html>
