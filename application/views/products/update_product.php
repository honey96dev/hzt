<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section class="card">
		<div class="card-header">
			<h4 class="card-title" data-i18n="Cusomter Information">Customer Information</h4>
		</div>
		<div class="card-content">
			<div class="card-body">
                <form class="form-horizontal" novalidate id="product-update-form" action="<?= $update_action_url?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label data-i18n="Product Name">Product Name</label>
                                <div class="controls">
                                    <input type="text" name="product_name" class="form-control" data-validation-required-message="Product name needs to be at least 3 characters." minlength="3" placeholder="nombre del producto" value="<?= $product['product_name'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" data-i18n="Submit">Submit</button>
                    <a class="btn btn-warning" href="<?= base_url('products')?>" data-i18n="Back">Back</a>
                </form>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>