<?php
    require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Admin Terminal</h2>
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 white-box">
                            <div class="row">
                                <span class="col-lg-6">First Name:</span>
                                <span class="col-lg-6"><?= $admin->getFirstName() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Last Name:</span>
                                <span class="col-lg-6"><?= $admin->getLastName() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">DNI:</span>
                                <span class="col-lg-6"><?= $admin->getDni() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Email:</span>
                                <span class="col-lg-6"><?= $admin->getEmail() ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </section>
</main>