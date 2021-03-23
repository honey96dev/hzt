<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-body">
    <!-- login page start -->
    <section id="auth-login" class="row flexbox-container">
        <div class="col-xl-8 col-11">
            <div class="card bg-authentication mb-0">
                <div class="row m-0">
                    <!-- left section-login -->
                    <div class="col-md-6 col-12 px-0">
                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                            <div class="card-header pb-1">
                                <div class="card-title">
                                    <h4 class="text-center mb-2">Welcome</h4>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form id="auth-login-form" action="<?= $login_action_url ?>" method="POST">
                                        <div class="form-group mb-50">
                                            <label class="text-bold-600" for="identity">Email address or Username</label>
                                            <input type="text" class="form-control" id="identity" name="identity" placeholder="Email address or Username" data-validation-required-message="This field is required."></div>
                                        <div class="form-group">
                                            <label class="text-bold-600" for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" data-validation-required-message="This field is required.">
                                        </div>
                                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                            <div class="text-left">
                                                <div class="checkbox checkbox-sm">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="checkboxsmall" for="exampleCheck1"><small>Keep me logged
                                                            in</small></label>
                                                </div>
                                            </div>
                                            <div class="text-right"><a href="<?= $forgot_password_url ?>" class="card-link"><small>Forgot Password?</small></a></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary glow w-100 position-relative">Login<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                    </form>
                                    <hr>
                                    <div class="text-center"><small class="mr-25">Don't have an account?</small><a href="<?= $signup_url ?>"><small>Sign up</small></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- right section image -->
                    <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                        <div class="card-content">
                            <img class="img-fluid" src="<?= base_url()?>app-assets/images/pages/login.png" alt="branding logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login page ends -->
</div>