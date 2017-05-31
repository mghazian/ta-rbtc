<!DOCTYPE html>
<html lang="en">
<head>
    <title>Repositori Poster TA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="stylesheet" href="<?php echo base_url ('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url ('assets/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url ('assets/css/common.css'); ?>">
    <?php if (isset ($css))
        foreach ($css as $file)
		    echo "<link rel=\"stylesheet\" href=\"" . base_url ($file) . "\">";
	?>
    
    <script src="<?php echo base_url ('assets/jquery/jquery-2.2.3.min.js'); ?>"></script>
    <script src="<?php echo base_url ('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
</head>

<body style="background-color: #c3ec92">
	<div class="wrapper" style="min-height: 100vh">