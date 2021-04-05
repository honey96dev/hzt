<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-body">
    <!-- register section starts -->
    <section class="row flexbox-container">
        <div class="col-xl-8 col-10">
            <div class="card bg-authentication mb-0">
                <div class="row m-0">
                    <!-- register section left -->
                    <div class="col-md-6 col-12 px-0">
                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                            <div class="card-header pb-1">
                                <div class="card-title">
                                    <h4 class="text-center mb-2">Regístrate</h4>
                                </div>
                            </div>
                            <div class="text-center">
                                <p> <small> Ingrese sus datos para registrarse y ser parte de nuestra gran comunidad.</small>
                                </p>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="<?= $signup_action_url?>" id="auth-signup-form" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mb-50">
                                                <label for="first_name" data-i18n="First Name">first name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Primer nombre" data-validation-required-message="This field is required.">
                                            </div>
                                            <div class="form-group col-md-6 mb-50">
                                                <label for="surname" data-i18n="Last Name">last name</label>
                                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Apellido" data-validation-required-message="This field is required.">
                                            </div>
                                        </div>
                                        <div class="form-group mb-50">
                                            <label class="text-bold-600" for="user_name" data-i18n="Username">username</label>
                                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nombre de usuario" data-validation-required-message="This field is required.">
                                        </div>
                                        <div class="form-group mb-50">
                                            <label class="text-bold-600" for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-validation-required-message="This field is required.">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="text-bold-600" for="password" data-i18n="Password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" >
                                        </div>
                                        <button type="submit" class="btn btn-primary glow position-relative w-100">Regístrate<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                    </form>
                                    <hr>
                                    <div class="text-center"><small class="mr-25">Ya tiene una cuenta?</small><a href="<?= $signin_url?>"><small>Iniciar sesión</small> </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- image section right -->
                    <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                        <img class="img-fluid" src="<?= base_url()?>app-assets/images/pages/register.png" alt="branding logo">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- register section endss -->
</div>