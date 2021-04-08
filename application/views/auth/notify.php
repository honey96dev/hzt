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
                                    <?php if($info == 'success'): ?>
                                        <h4 class="text-center mb-2" data-i18n="">Password Reset Successfully.</h4>
                                    <?php else:?> 
                                        <h4 class="text-center mb-2" data-i18n="">Password Not Reset.</h4>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="text-muted text-center mb-2">
                                        <?php if($info == 'success'): ?>
                                            <small>
                                                Your password reset successfully. New password is your email. Thanks.
                                            </small>
                                        <?php else: ?>
                                            <small>
                                                We are sorry but your request is not accepted. Please try again later.
                                            </small>
                                        <?php endif;?>
                                    </div>
                                        <a class="btn btn-primary glow position-relative w-100" href="<?= $login_url?>">
                                            Back to Login<i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                        </a>
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