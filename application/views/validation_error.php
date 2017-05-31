<div class="container">
	<div id="error" class="alert alert-danger alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="close">×</button>
		<span> <h2><strong> ERROR! </strong></h2><br> <?php echo validation_errors(); ?> </span>
		<span> <?php var_dump ($error); ?> </span>
	</div>
</div>