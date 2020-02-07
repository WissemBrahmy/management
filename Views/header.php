<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Thermoplastics</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body style="">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Ad</span>min
				<span><img src="img/thermoplastics.png"  height="40" width="70" style=" display:inline-block;background-color: #f1f4f7;margin-top:-7px;"/></span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php @print($_SESSION["login"]); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						
					
							<li><a href="index.php?logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
			<div class="form-group">
				
			</div>
	
		<ul class="nav menu">
		<br><br><br><br><br>
			<li class=""><a href="index.php"> Home <svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> </a></li>
			
	
		
		
					<li class="parent ">
				<a href="index.php?page=articles">
					 Articles&nbsp; <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
				</a>
				
			</li>
				<li><a href="index.php?page=machines"> Machines <span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> </a></li>

				</li>
					<li><a href="index.php?page=prices"> Prices <span class="glyphicon glyphicon-th" aria-hidden="true"></span> </a></li>

				</li>
					</li>
					<li><a href="index.php?page=materials">Materials <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span> </a></li>

				</li>
				<li><a href="index.php?page=tickets">Tickets/Quantity <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> </a></li>

				</li>
					<li><a href="index.php?page=orders">Manufacturing orders <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> </a></li>

				</li>
						<li class=""><a href="index.php?page=daily_production"> Daily Production <span class="glyphicon glyphicon-list" aria-hidden="true"></span> </a></li>

							<li class=""><a href="index.php?page=exportations"> Exportations <span class="glyphicon glyphicon-list" aria-hidden="true"></span> </a></li>
		
	
			
			
		</ul>

	</div><!--/.sidebar-->