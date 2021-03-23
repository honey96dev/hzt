<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-body">
    <!-- forgot password start -->
    <section class="row flexbox-container">
        <div class="col-xl-7 col-md-9 col-10  px-0">
            <div class="card bg-authentication mb-0">
                <div class="row m-0">
                    <!-- left section-forgot password -->
                    <div class="col-md-6 col-12 px-0">
                        <div class="card disable-rounded-right mb-0 p-2">
                            <div class="card-header pb-1">
                                <div class="card-title">
                                    <h4 class="text-center mb-2">Forgot Password?</h4>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between align-items-center mb-2">
                                <div class="text-left">
                                    <div class="ml-3 ml-md-2 mr-1"><a href="<?= $signin_url?>" class="card-link btn btn-primary text-nowrap">Sign
                                            in</a></div>
                                </div>
                                <div class="mr-3"><a href="<?= $signup_url?>" class="card-link btn btn-primary text-nowrap">Sign
                                        up</a></div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="text-muted text-center mb-2"><small>Enter the email or phone number you
                                            used
                                            when you joined
                                            and we will send you temporary password</small></div>
                                    <form class="mb-2" action="index.html">
                                        <div class="form-group mb-2">
                                            <label class="text-bold-600" for="exampleInputEmailPhone1">Email or
                                                Phone</label>
                                            <input type="text" class="form-control" id="exampleInputEmailPhone1" placeholder="Email or Phone"></div>
                                        <button type="submit" class="btn btn-primary glow position-relative w-100">SEND
                                            PASSWORD<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                    </form>
                                    <div class="text-center mb-2"><a href="auth-login.html"><small class="text-muted">I
                                                remembered my
                                                password</small></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- right section image -->
                    <div class="col-md-6 d-md-block d-none text-center align-self-center">
                        <img class="img-fluid" src="<?= base_url()?>app-assets/images/pages/forgot-password.png" alt="branding logo" width="300">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- forgot password ends -->
</div>