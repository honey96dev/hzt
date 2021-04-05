<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section class="card">
		<div class="card-header">
			<h4 class="card-title" data-i18n="Bill Information">Bill Information</h4>
		</div>
		<div class="card-content">
			<div class="card-body">
                <form class="form-horizontal" novalidate id="bill-create-form" action="<?= $create_action_url?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label data-i18n="Bill Number">Bill Number</label>
                                <div class="controls">
                                    <input type="text" name="bill_number" class="form-control" data-validation-required-message="Bill number is required." placeholder="Bill Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Tax ID">Tax ID</label>
                                <div class="controls">
                                    <input type="text" name="tax_id" class="form-control" data-validation-required-message="Tax ID is required." placeholder="Tax ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Product Name">Product Name</label>
                                <div class="controls">
                                    <select name="product_name" class="form-control">
                                        <?php foreach($products as $product):?>
                                            <option value="<?= $product['id']?>"><?= $product['product_name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Quantity">Quantity</label>
                                <div class="input-group">
                                    <input type="text" name="quantity" class="form-control" data-validation-required-message="Quantity is required." placeholder="Quantity" aria-describedby="quantity-addon">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="quantity-addon">kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Total Amount">Total Amount</label>
                                <div class="input-group">
                                    <input type="text" name="total_amount" class="form-control" data-validation-required-message="Total amount is required." placeholder="Total Amount" aria-describedby="amount-addon">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="amount-addon">$ </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label data-i18n="Customer">Customer</label>
                                <div class="controls">
                                    <select class="select2 form-control" name="customer">
                                    <?php foreach($customers as $customer):?>
                                        <option value="<?= $customer['id']?>"><?= $customer['first_name'] . ' ' . $customer['surname'] ?></option>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Company">Company</label>
                                <div class="controls">
                                    <input type="text" name="company_name" class="form-control" data-validation-required-message="Company is required." placeholder="Company">
                                </div>
                            </div>
                            <div class="form-group position-relative">
                                <label data-i18n="Bill Date">Bill Date</label>
                                <div class="controls">
                                    <input type="text" name="bill_date" class="form-control pickadate" data-validation-required-message="Bill date is required." placeholder="Bill Date">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01" data-i18n="Bill Document">Bill Document File</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="bill-file" aria-describedby="inputGroupFileAddon01" name="bill_doc">
                                    <label class="custom-file-label" for="bill-file" data-i18n="Choose File">Choose file</label>
                                </div>
                            </div>
                            <div class="checkbox mr-2 mt-2 mb-1">
                                <input type="checkbox" name="status" class="checkbox-input" id="status" value="off">
                                <label for="status" data-i18n="Paid Status">Paid Status</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" data-i18n="Submit">Submit</button>
                    <a class="btn btn-warning" href="<?= base_url('bills')?>" data-i18n="Back">Back</a>
                </form>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>