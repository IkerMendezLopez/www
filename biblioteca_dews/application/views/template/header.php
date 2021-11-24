<html>

<head>
	<title>Biblioteca</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel = "stylesheet" type = "text/css" 
         href = "<?php echo base_url(); ?>css/style.css"> 
</head>

<body>
	<div id="header">
		<h1>Biblioteca</h1>
	</div>
	<div id="menu">
		<a href="<?=site_url()?>">Home</a>
		<a href="<?=site_url() . '/calendar'?>">Calendario</a>
	</div>
	<div id="container">
		<div id="bar">
			<?php require("bar.php"); ?>
		</div>
		<div id="main">