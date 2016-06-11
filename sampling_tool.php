
<!--DOCTYPE html-->
<html lang="en">
<head>

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
        div.padded {
            padding-top: 10px;
            padding-right: 50px;
            padding-bottom: 0.25in;
            padding-left: 450px;
        }
        body {
            font-family: sans-serif;;
            font-size: 2pt;
        }
        table {
        }
        table th {
            background-color: #F7F7F7;
            color: #333;
            font-weight: bold;
        }
        table th, table td {
            padding: 5px;
            border-color: #ccc;
        }
        .intall-content-info {
            height: 400px;
            overflow-y: scroll;
            /*border: 1px;*/
            border-color: #333;
            width: 500px;
            border-radius: 5px;
            box-shadow: 0 3px 5px #ccc inset, 0 -1px 1px #ccc inset;
            margin-bottom: 1em;
          }
          .intall-content-info label{
            position: fixed;
            margin-bottom: 20px;
            background-color: #fff;
          }
          .install-status-label {
            padding: 20px;
          }
          pre {
            width: 95%;
            height: 8em;
            font-family: monospace;
            font-size: 0.9em;
            padding: 1px 2px;
            margin: 0 0 1em auto;
            border: 1px inset #666;
            background-color: #eee;
            overflow: auto;
          }
          #result {
            padding: 0 10px;
            /*margin: 1em 0;*/
            /*border: 1px solid #999;*/

              height: 400px;
              overflow-y: scroll;
              /*border: 1px;*/
              /*border-color: #333;*/
              width: 500px;
              border-radius: 5px;
              box-shadow: 0 3px 5px #ccc inset, 0 -1px 1px #ccc inset;
              margin-bottom: 1em;
          }
          #dvCSV
          {
            padding: 0 10px;
            /*margin: 1em 0;*/
            /*border: 1px solid #999;*/

              height: 400px;
              overflow-y: scroll;
              /*border: 1px;*/
              /*border-color: #333;*/
              width: 500px;
              border-radius: 5px;
              box-shadow: 0 3px 5px #ccc inset, 0 -1px 1px #ccc inset;
              margin-bottom: 1em;
          }
          #sampling-tool-loader {
              border: 1px solid black;
              width: 500px;
              height: 50px;
          }
          #inner-sampling-tool-loader {
              background: red;
              height: 100%;
              width: 2px;
          }

          .fileUpload {
            position: relative;
            overflow: hidden;
          }
          .fileUpload input {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            cursor: pointer;
            opacity: 0;
          }/*
          .progress {
              margin-bottom: 0;
          }
*/
          input[type=file]{
      float:left;
    }
    </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Protein Sequence Profiler</title>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet"> -->
        <script src="js/jquery.tmpl.min.js"></script>
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Navigation -->
    <?php include_once('menu.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sampling Tool</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Sampling Tool</li>
                </ol>
            </div>
        </div>

    <form class="form-inline">
      <div class="form-group">
        <label for="exampleInputName2">Sample Size (%): </label>
        <input type="text" class="form-control" id="samplesize" placeholder="%" required>
      </div>
      <div class="form-group">
        <label>Population: </label>
        <label id="randomset"></label>
      </div>
      <div class="form-group">
        <label># of entries from sampling: </label>
        <label id="sampleresult"></label>
      </div>
    </form>
<!--
    <label>Sample size: <input type="text" id="samplesize" size="2" required></input>% </label>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
    <label>Population: <label id="randomset" padding-right="20px" padding-left="20px"></label></label><br> -->
    <hr>
    <form action="#">
      <input type="file" id="fileUpload" name="image" >
      <button class="btn btn-info upload" type="submit" onclick="Upload()">Perform Sampling</button>
      <!-- <button type="button" class="btn btn-sm btn-danger cancel">Cancel</button> -->
      <button type="button" onclick="javascript:window.location.reload()" class="btn btn-warning" data-dismiss="modal">Reset</button><br><br>
      <div class="progress progress-striped active">
        <div class="progress-bar" style="width:0%"></div>
      </div>
    </form>
    <center>
        <table>
            <tr>
                <td>
                    <center>
                    <label>The file chosen contains the following proteins:</label><br>
                        <!-- <div class="intall-content-info"> -->
                            <pre id="dvCSV"></pre>
                        <!-- </div> -->
                    </center>
                </td>

                <td>
                    <center>
                    <label>Result Data set from Systematic Sampling:</label><br></center>
                        <!-- <div class="intall-content-info"> -->
                            <pre id="result"></pre>

                        <!-- </div> -->

                </td>
            </tr>
        </table>
      </center>
        <center><a href="#" class="btn btn-success" id="downloadLink">Download Sampling Result</a></center>
</div>
<footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="wow shake" data-wow-delay="0.4s">
          <div class="page-scroll marginbot-30">
          </div>
          </div>
          <div class="col-lg-12">
          <p class="navbar-text pull-left">&copy;2012 PROTEIN SEQUENCE PROFILER. ALL RIGHTS RESERVED.</p>
          </div>
      </div>
    </div>
  </footer>

</body>
</html>


  <script>

    $(document).on('submit','form',function(e){
      e.preventDefault();

      $form = $(this);

      uploadImage($form);

    });

    function uploadImage($form){
      $form.find('.progress-bar').removeClass('progress-bar-success')
                    .removeClass('progress-bar-danger');

      var formdata = new FormData($form[0]); //formelement
      var request = new XMLHttpRequest();

      //progress event...
      request.upload.addEventListener('progress',function(e){
        var percent = Math.round(e.loaded/e.total * 100);
        $form.find('.progress-bar').width(percent+'%').html(percent+'%');
      });

      //progress completed load event
      request.addEventListener('load',function(e){
        $form.find('.progress-bar').addClass('progress-bar-success').html('upload completed....');
      });

      request.open('post', 'server.php');
      request.send(formdata);

      $form.on('click','.cancel',function(){
        request.abort();

        $form.find('.progress-bar')
          .addClass('progress-bar-danger')
          .removeClass('progress-bar-success')
          .html('upload aborted...');
      });

    }

    function Upload() {

        var sample = document.getElementById("samplesize").value;

            var fileUpload = document.getElementById("fileUpload");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.txt)$/;
            if (regex.test(fileUpload.value)) {

                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var table = document.createElement("table");
                        var replace = e.target.result.split("://").join("");
                        var rows = replace.split('//');
                        for (var i = 0; i < rows.length; i++) {

                          if (rows[i].indexOf('ID   ')!== -1) {
                            var row = table.insertRow(-1);
                            var cells = rows[i].slice(0,25).split("ID");
                            for (var j = 0; j < cells.length; j++) {
                                //create counter
                                  var cell = row.insertCell(-1);
                                  cell.innerHTML += cells[j];
                            }
                            cell.innerHTML = i+1 + ". " + cell.innerHTML;

                            // var a = $("#inner-sampling-tool-loader");
                            // $("#inner-sampling-tool-loader").width(  a.width() + 0.5  );
                          }
                        }


                        console.log(sample);

                          var min = 0;
                          var max = sample - 1; //here
                          console.log(max);

                          var firstrandom = rows[ Math.floor(Math.random() * max + 1)];
                          var nextrandom = rows.indexOf(firstrandom);
                          var sampling;

                          for(var j = 0; j < rows.length; j++)
                          {
                            sampling = rows[nextrandom] + "//";
                            nextrandom = nextrandom + (max + 1) ; //here

                            if (sampling == "undefined//") {
                                break;
                            } else
                            document.getElementById("result").innerText += sampling;

                          }
                          console.log(j);
                        document.getElementById("sampleresult").innerHTML = j;
                        var dvCSV = document.getElementById("dvCSV");
                        dvCSV.innerHTML = "";
                        dvCSV.appendChild(table);
                        var randomset = document.getElementById("randomset");
                        randomset.innerHTML = rows.length-1;
                    }
                    reader.readAsText(fileUpload.files[0]);
                } else {
                    alert("This browser does not support HTML5.");
                }
            } else {
                alert("Please upload a valid text file.");
            }
    }


    function downloadInnerHtml(filename, elId, mimeType) {
        var elHtml = document.getElementById(elId).innerHTML;
        var file = elHtml.replace(/<br\s*\/?>/mg,"\n");
        var link = document.createElement('a');
        mimeType = mimeType || 'text/plain';

        link.setAttribute('download', filename);
        link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(file));
        link.click();
    }

    var fileName =  'sampling.txt'; // You can use the .txt extension if you want

    $('#downloadLink').click(function(){
        downloadInnerHtml(fileName, 'result','text/html');
    });
</script>
