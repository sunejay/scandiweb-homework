<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?> - Scandiweb</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-light mb-4">
	  	<div class="container border-bottom border-light border-2 py-2">
		    <a class="navbar-brand fw-bold"><?= $navbar_title ?></a>
		    <div class="d-flex">
		    	<?= $navbar_links ?>
		    </div>
	  	</div>
	</nav>
	<section class="container" style="min-height: 28em;">
		<div class="row">
			<?= $content ?>
		</div>
	</section>
	<footer>
		<div class="container text-center border-top border-light border-2 p-4 mt-4">
			Scandiweb Test Assignment
		</div>
		<div class="d-flex justify-content-end align-item-center bg-light">
			<i class="fw-bold me-1">II</i>
		</div>
	</footer>
	<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>