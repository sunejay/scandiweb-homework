$(document).ready(function(){

	$('#productType').change(function() {
		var productType = $(this).val();

		if (productType === 'dvd') {
			$('#selectedSwitch').html(
				`<div id="DVD">
		  			<div class="mb-3 row">
					    <label for="size" class="col-sm-3 col-form-label text-white">Size (MB)</label>
					    <div class="col-sm-9">
					      	<input type="number" class="form-control" name="size" id="size" placeholder="#size" required>
					    </div>
				  	</div>
				  	<div class="text-white" id="dvd_desc">Please, provide size</div>
		  		</div>`
			);
		} else if (productType === 'furniture') {
			$('#selectedSwitch').html(
				`<div id="Furniture">
		  			<div class="mb-3 row">
					    <label for="height" class="col-sm-3 col-form-label text-white">Height (CM)</label>
					    <div class="col-sm-9">
					      	<input type="number" class="form-control" name="height" id="height" placeholder="#height" required>
					    </div>
				  	</div>
				  	<div class="mb-3 row">
					    <label for="width" class="col-sm-3 col-form-label text-white">Width (CM)</label>
					    <div class="col-sm-9">
					      	<input type="number" class="form-control" name="width" id="width" placeholder="#width" required>
					    </div>
				  	</div>
				  	<div class="mb-3 row">
					    <label for="length" class="col-sm-3 col-form-label text-white">Length (CM)</label>
					    <div class="col-sm-9">
					      	<input type="number" class="form-control" name="length" id="length" placeholder="#length" required>
					    </div>
				  	</div>
				  	<div class="text-white" id="furniture_desc">Please provide dimensions in HxWxL format</div>
		  		</div>`
			);
		} else if (productType === 'book') {
			$('#selectedSwitch').html(
				`<div id="Book">
				  	<div class="mb-3 row">
					    <label for="weight" class="col-sm-3 col-form-label text-white">Weight (KG)</label>
					    <div class="col-sm-9">
					      	<input type="number" class="form-control" name="weight" id="weight" placeholder="#weight" required>
					    </div>
				  	</div>
				  	<div class="text-white" id="book_desc">Please, provide weight</div>
		  		</div>`
			);
		}
	});

	$('#product_save').click(function(e) {
		e.preventDefault();
		
		var form = $('#product_form'); 
		var ptype = $('#productType').val();
		
		var height = Number($('#height').val());
		var width = Number($('#width').val());
		var length = Number($('#length').val());
		var weight = Number($('#weight').val());
		var size = Number($('#size').val());

		if (ptype === 'furniture' && (height == 0 || width == 0 || length == 0)) {
			$('#furniture_desc').removeClass("text-white").addClass("text-danger");
			return;
		} else if (ptype === 'book' && weight == 0) {
			$('#book_desc').removeClass("text-white").addClass("text-danger");
			return;
		} else if (ptype === 'dvd' && size == 0) {
			$('#dvd_desc').removeClass("text-white").addClass("text-danger");
			return;
		} else {
		    $.ajax({
			url: form.attr("action"),
			data: form.serialize(),
			type: form.attr("method"),
			dataType: "JSON",
			success: function(data) {
				if (data.ok) {
					window.location.replace('/');
				} else {
					$.each(data.form.errors, function(field, message) {
						if (field == 'type_switcher') {
							$(`#${field}`).html(
								`<select class="form-select is-invalid" name="type_switcher" id="productType">
								  	<option value="" selected>Type Switcher</option>
								  	<option value="dvd">DVD</option>
								  	<option value="furniture">Furniture</option>
								  	<option value="book">Book</option>
								</select>
						      	<div class="invalid-feedback">${message}</div>`
							);
						} else {
							$(`#${field}`).html(
								`<input type="text" class="form-control is-invalid" name="${field}" placeholder="#${field}">
						      	<div class="invalid-feedback">${message}</div>`
							);
						}
					});
				}
			}
		});
		}
		
	});

	$('#delete-product-btn').click(function(e) {
		e.preventDefault();

		var checked_product_sku = [];
		$.each($("input[name='product_sku[]']:checked"), function(){            
		    checked_product_sku.push($(this).val());
		});
		$.ajax({
			url: $(this).attr("href"),
			data: {"product_sku": checked_product_sku},
			type: 'POST',
			dataType: "JSON",
			success: function(data) {
				if (data.ok) {
					$.each(data.p_sku,  function(index, value) {
						$(`#${value}`).remove();
					});
				} 
			}
		});
	});
});