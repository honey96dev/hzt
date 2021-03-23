<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section class="card">
		<div class="card-header">
			<h4 class="card-title">Customer Information</h4>
		</div>
		<div class="card-content">
			<div class="card-body">
                <form class="form-horizontal" novalidate id="customer-create-form" action="<?= $create_action_url?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <div class="controls">
                                    <input type="text" name="username" class="form-control" data-validation-required-message="Username needs to be at least 3 characters." minlength="3" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="controls">
                                    <input type="email" name="email" class="form-control" data-validation-required-message="Email format looks not good. Please check it again." placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="controls">
                                    <input type="password" name="password" class="form-control" data-validation-required-message="This field is required" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="controls">
                                    <input type="password" name="password2" data-validation-match-match="password" class="form-control" data-validation-required-message="Confirm password needs to match" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <div class="controls">
                                    <input type="text" name="first_name" class="form-control" data-validation-required-message="First name is required." placeholder="First Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <div class="controls">
                                    <input type="text" name="last_name" class="form-control" data-validation-required-message="Last name is required." placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Goal</label>
                                <div class="controls">
                                    <input type="text" name="goal" class="form-control" data-validation-regex-regex="([^a-z]*[A-Z]*)*" data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" min="0" data-validation-containsnumber-message="Enter Number needs to be over 0" required placeholder="Goal">
                                </div>
                            </div>
                            <div class="checkbox mr-2 mt-2 mb-1">
                                <input type="checkbox" name="status" class="checkbox-input" id="status" value="off">
                                <label for="status">Status</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="role" class="checkbox-input" id="role" value="off">
                                <label for="role">Is Admin?</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-warning" href="<?= base_url('customers')?>">Back</a>
                </form>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>