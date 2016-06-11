<!DOCTYPE html>
<html lang="en">
<?php
session_start();
session_destroy();

?>
<head>
    <style type="text/css">
    div.padded {
        padding-top: 10px;
        padding-right: 50px;
        padding-bottom: 0.25in;
        padding-left: 450px;
    }
    </style>

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
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="html5shiv.js"></script>
        <script src="respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#myModal" data-title="Data Filter">Data Filter</a></li>
                    <li><a href="import.php">Import</a></li>
                    <li><a href="updates.php">Updates</a></li>
                    <li><a href="sampling_tool.php">Sampling Tool</a></li>
                    <!-- <li><a href="documentation.php">Documentation</a></li> -->
                    <li><a href="about_us.php">About Us</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Header Carousel -->
    <?php include_once('header.php');?>
    <!-- Page Content -->
    <div class="container">
        <center>
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Protein Sequence Profiler</h2>
            </div>
            <div>
                <p>Providing a comprehensive and freely accessible resource of protein profiled according to desired results. Also providing graphs and up to date data for references and possible study.</p>
            </div>
        </div>
    </center>
            <!-- Section: services -->
            <section id="service" class="home-section text-center bg-gray">
        		<div class="container">
        		<div class="row">
        			<div class="col-lg-2 col-lg-offset-5">
        				<hr class="marginbot-50">
        			</div>
        		</div>
                <div class="row">
                    <div class="col-sm-3 col-md-3">
        				<div class="wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="service-box">
        					<div class="service-icon">
        						<a href="#" data-toggle="modal" data-target="#myModal" data-title="Data Filter"><img src="img\png\interface.png" alt="" /></a>
        					</div>
        					<div class="service-desc">
        						<h5><b>Data Filter</b></h5>
        						<!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
        					</div>
                        </div>
        				</div>
                    </div>
        			<div class="col-sm-3 col-md-3">
        				<div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-box">
        					<div class="service-icon">
        						<a href="import.php"><img src="img\png\import.png" alt="" /></a>
        					</div>
        					<div class="service-desc">
        						<h5><b>Import File</b></h5>
        						<!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
        					</div>
                        </div>
        				</div>
                    </div>
        			<div class="col-sm-3 col-md-3">
        				<div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-box">
        					<div class="service-icon">
        						<a href="updates.php"><img src="img/png/update-arrows.png" alt="" /></a>
        					</div>
        					<div class="service-desc">
        						<h5><b>Update</b></h5>
        						<!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
        					</div>
                        </div>
        				</div>
                    </div>
        			<div class="col-sm-3 col-md-3">
        				<div class="wow fadeInRight" data-wow-delay="0.2s">
                        <div class="service-box">
        					<div class="service-icon">
        						<a href="sampling_tool.php"><img src="img/png/settings.png" alt="" /></a>
        					</div>
        					<div class="service-desc">
        						<h5><b>Sampling Tool</b></h5>
        						<!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
        					</div>
                        </div>
        				</div>
                    </div>
                </div>
        		</div>
        	</section>
        	<!-- /Section: services -->
        <!-- /.row -->
        <!-- Dialog box --->
        <div class="padded">
        </div>
        <div class="padded">
        </div>
		<?php include_once('data_filter_dialog.php'); ?>
        <!-- end Dialog box-->
        <hr>
        <!-- Footer -->
        <?php include_once('footer.php'); ?>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 2000 //changes the speed
    })
    </script>

</body>

</html>
