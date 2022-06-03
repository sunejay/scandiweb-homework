<?php $title = 'Add Product' ?>
<?php ob_start() ?>
 	<nav class="navbar navbar-light mb-4">
	  	<div class="container border-bottom border-light border-2 py-2">
		    <a class="navbar-brand fw-bold">Product Add</a>
		    <div class="d-flex">
		      <a href="#" class="btn btn-outline-success btn-sm" id="product_save">Save</a>
		      <a href="/" class="btn btn-outline-success btn-sm ms-4">Cancel</a>
		    </div>
	  	</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<form method="POST" action="/add-product" id="product_form">
					<div class="mb-3 row">
					    <label for="sku" class="col-sm-3 col-form-label">SKU</label>
					    <div class="col-sm-9" id="sku">
					      	<input type="text" class="form-control" name="sku" placeholder="#sku">
					    </div>
				  	</div>
				  	<div class="mb-3 row">
					    <label class="col-sm-3 col-form-label">Name</label>
					    <div class="col-sm-9" id="name">
					      	<input type="text" class="form-control" name="name" placeholder="#name">
					    </div>
				  	</div>
				  	<div class="mb-3 row">
					    <label class="col-sm-3 col-form-label">Price ($)</label>
					    <div class="col-sm-9" id="price">
					      	<input type="text" class="form-control" name="price" placeholder="#price">
					    </div>
				  	</div>
				  	<div class="mb-3 row">
					    <label class="col-sm-3 col-form-label">Type Switcher</label>
					    <div class="col-sm-9" id="type_switcher">
					      	<select class="form-select" name="type_switcher" id="productType">
							  	<option value="" selected>Type Switcher</option>
							  	<option value="dvd">DVD</option>
							  	<option value="furniture">Furniture</option>
							  	<option value="book">Book</option>
							</select>
					    </div>
				  	</div>
				  	<div class="rounded bg-secondary mb-3 p-3" id="selectedSwitch"> 
				  	</div>
				</form>
			</div>
		</div>
	</div>
<?php $content = ob_get_clean() ?>
<?php require 'layout.php'; ?>