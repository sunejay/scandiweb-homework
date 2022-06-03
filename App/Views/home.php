<?php $title = 'Index Page' ?>
<?php ob_start() ?>
 	<nav class="navbar navbar-light mb-4">
	  	<div class="container border-bottom border-light border-2 py-2">
		    <a class="navbar-brand fw-bold">Product List</a>
		    <div class="d-flex">
		      <a href="/add-product" class="btn btn-outline-success btn-sm">ADD</a>
		      <a href="/mass-delete" class="btn btn-outline-success btn-sm ms-4" id="delete-product-btn">MASS DELETE</a>
		    </div>
	  	</div>
	</nav>
	<div class="container">
		<div class="row">
			<?php foreach ($products as $product): ?>
				<div class="col-md-3 mb-4" id="<?= $product['sku'] ?>">
					<div class="card">
						<div class="card-body">
							<div>
								<input name="product_sku[]" type="checkbox" class="delete-checkbox" value="<?= $product['sku'] ?>">
							</div>
							<div class="text-center mb-4">
								<ul style="list-style: none;">
									<li><?= $product['sku'] ?></li>
									<li><?= $product['name'] ?></li>
									<li><?= $product['price'] ?> $</li>
									<li><?= $product['type'] ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php $content = ob_get_clean() ?>
<?php require 'layout.php'; ?>