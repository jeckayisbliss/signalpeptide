<!DOCTYPE html>
<html lang="en">

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
    <style type="text/css">
        .btn-file {
          position: relative;
          overflow: hidden;
        }
        .btn-file input[type=file] {
          position: absolute;
          top: 0;
          right: 0;
          min-width: 100%;
          min-height: 100%;
          font-size: 100px;
          text-align: right;
          filter: alpha(opacity=0);
          opacity: 0;
          background: red;
          cursor: inherit;
          display: block;
        }
        input[readonly] {
          background-color: white !important;
          cursor: text !important;
        }

        .intall-content-info {
          height: 200px;
          overflow-y: scroll;
        }
        .intall-content-info label{
          position: fixed;
          margin-bottom: 20px;
          background-color: #fff;
        }
        .install-status-label {
          padding: 20px;
        }

    </style>

</head>
<body>
    <!-- Navigation -->
    <?php include_once('menu.php'); ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Import</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Import</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <input type="hidden" id="uploaded_filename" />
        <div class="row">
            <div class="col-sm-6">
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            Choose a file <input type="file" id="file" onchange="uploadFile()">
                        </span>
                    </span>
                    <input type="text" class="form-control" readonly>
                </div>
            </div>

            <div  class="col-sm-6"> </div>

                <!-- Trigger the modal with a button -->
                <button id="load_btn" type="button" class="btn btn-success" data-toggle="modal" data-target="#installUploadedFileModal" disabled>Load File</button>
                <!-- Modal -->
                <div id="installUploadedFileModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Import</h4>
                      </div>
                      <div class="modal-body">

                        <div class="row">
                          <div class="intall-content-info col-md-12">
                            <label>The uploaded file contains new proteins:</label><br>
                            <p id="new"></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="intall-content-info col-md-12">
                            <label>The uploaded file contains updates for:</label><br>
                            <p id="updates"></p>
                          </div>
                        </div>

                      </div>
                      <div class="modal-footer" align="center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input id="install" class="btn btn-success" type="button" value="Perform Changes" onclick="installUploadedFile()" data-dismiss="modal">
                      </div>
                    </div>

                  </div>
                </div> <!--end modal content-->
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
         <center>
        <!-- Footer -->
        <?php include_once('footer.php'); ?>
        </center>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).on('change', '.btn-file :file', function() {
          var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });

        $(document).ready( function() {

            $("#install").css("display", "none");
            $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
        });

        var new_proteins;
        var startTime = 0;
        var endTime = 0;
        var execTime = 0;

        function installUploadedFile() {

            var uploaded_filename = $("#uploaded_filename").val();
            startTime = performance.now();

            $.ajax({
              url: "/signal-peptide/controller/protein_upload_install.php",
              data: {
                file: uploaded_filename
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


        function uploadFile() {
          //"use strict";
            $("#install").css("display", "none");
            $(".headerInstall").css("display", "inline");

            var html = "";
            var data = new FormData();

            $.each($("#file")[0].files, function(i, file) {
                data.append("file", file);
            });

            $.ajax({
                url: "/signal-peptide/controller/protein_upload.php",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: "POST",
                beforeSend: function() {
                  $("#loader").html('<center><img id="loading-status" class="loading-image" src="img/Preloader_3.gif" alt="loading..."></center>');
                },
                success: function(data) {
                  $("#loader").html('');
                  $('#load_btn').attr('disabled', false);

                    var response = jQuery.parseJSON(data);
                    var message = response.message;

                  //  console.log(message);
                    if (message == "Success")  {
                        var result = response.result;
                        var updates = result.updates;
                        new_proteins = result.new;
                        var uploaded_filename = response.file;

                        $("#updates").html("");
                        $("#new").html("");
                        $("#uploaded_filename").val(uploaded_filename);

                        if (updates.length == 0) {
                            $("#updates").append("There are no existing proteins to be updated.");
                        } else {
                            html = "<ol>"
                            for (i = 0; i < updates.length; i++) {
                                var protein = updates[i];
                                html += "<li>" + protein.entryName + "</li>";
                            }
                            html += "</ol>";
                            $("#updates").html(html);
                        }

                        if (new_proteins.length == 0) {
                            $("#new").html("There are no proteins to be inserted.");
                        } else {
                            html = "<ol>"
                            for (i = 0; i < new_proteins.length; i++) {
                                var protein = new_proteins[i];
                                html += "<li>" + protein.entryName + "</li>";
                            }
                            html += "</ol>";
                            $("#new").html(html);
                        }

                        if(updates.length > 1 || new_proteins.length > 1){
                            $("#install").css("display", "inline");
                        }
                        else{
                            $("#install").css("display", "none");
                        }
                    }
                    else {
                        $("#failed_message").html("Upload failed.");
                    }
                }
            });
        }
    </script>
</body>
</html>
