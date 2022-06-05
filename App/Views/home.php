<?php ob_start() ?>
	<?php 
		$title = 'Index Page';
 		$navbar_title = 'Product List'; 
 	?>
 	<?php ob_start() ?>
 		<a href="/add-product" class="btn btn-outline-success btn-sm">ADD</a>
      	<a href="/mass-delete" class="btn btn-outline-success btn-sm ms-4" id="delete-product-btn">MASS DELETE</a>
  	<?php $navbar_links = ob_get_clean() ?>
  	<?php if ($products->num_rows > 0): ?>
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
	<?php else: ?>
	    <div class="text-center">
	        <p>
	        	<h1>No product created yet</h1>
        	</p>
	        <p>
	        	<h3>Please click on the ADD button above to create new product</h3>
        	</p>
	    </div>
	<?php endif; ?>
<?php $content = ob_get_clean() ?>
<?php require 'layout.php'; ?>