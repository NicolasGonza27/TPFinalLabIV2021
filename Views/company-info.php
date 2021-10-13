<?php
    require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Your Company Information</h2>
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 white-box">
                            <div class="row">
                                <span class="col-lg-6">Fantasy Name:</span>
                                <span class="col-lg-6"><?= $company->getFantasyName() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Country:</span>
                                <span class="col-lg-6"><?= $company->getCountry() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Province:</span>
                                <span class="col-lg-6"><?= $company->getProvince() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">City:</span>
                                <span class="col-lg-6"><?= $company->getCity() ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </section>
</main>