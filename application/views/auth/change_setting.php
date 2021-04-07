<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section class="card">
		<div class="card-header">
			<h4 class="card-title" data-i18n="Settings">Settings</h4>
		</div>
		<div class="card-content">
			<div class="card-body">
                <form class="form-horizontal" novalidate id="change-settings-form" action="<?= $change_action_url?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="controls">
                                    <input type="email" name="email" class="form-control" data-validation-required-message="Email format looks not good. Please check it again." placeholder="Email" value="<?= $user['email']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Current Password">Current Password</label>
                                <div class="controls">
                                    <input type="password" name="current_password" class="form-control" placeholder="contraseña actual">
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Password">Password</label>
                                <div class="controls">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Confirm Password">Confirm Password</label>
                                <div class="controls">
                                    <input type="password" name="password2" data-validation-match-match="password" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label data-i18n="Username">Username</label>
                                <div class="controls">
                                    <input type="text" name="username" class="form-control" data-validation-required-message="Username needs to be at least 3 characters." minlength="3" placeholder="Nombre de usuario" value="<?= $user['user_name']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="First Name">First Name</label>
                                <div class="controls">
                                    <input type="text" name="first_name" class="form-control" data-validation-required-message="First name is required." placeholder="Primer nombre" value="<?= $user['first_name']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label data-i18n="Last Name">Last Name</label>
                                <div class="controls">
                                    <input type="text" name="last_name" class="form-control" data-validation-required-message="Last name is required." placeholder="Apellido" value="<?= $user['surname']?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" data-i18n="Submit">Submit</button>
                    <a class="btn btn-warning" href="<?= base_url('customers')?>" data-i18n="Back">Back</a>
                </form>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>