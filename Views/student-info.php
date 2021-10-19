<?php
    require_once('student-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Your Student Information</h2>
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 white-box">
                            <div class="row">
                                <span class="col-lg-6">First Name:</span>
                                <span class="col-lg-6"><?= $student->getFirstName() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Last Name:</span>
                                <span class="col-lg-6"><?= $student->getLastName() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">DNI:</span>
                                <span class="col-lg-6"><?= $student->getDni() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">File Naumber:</span>
                                <span class="col-lg-6"><?= $student->getFileNumber() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Gender:</span>
                                <span class="col-lg-6"><?= $student->getGender() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Birth Date:</span>
                                <span class="col-lg-6"><?= date("Y-m-d H:i:s", strtotime($student->getBirthDate())) ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Email:</span>
                                <span class="col-lg-6"><?= $student->getEmail() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Phone Number:</span>
                                <span class="col-lg-6"><?= $student->getPhoneNumber() ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </section>
</main>