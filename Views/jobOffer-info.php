<?php
    $student = "";
    $admin = "";
    $postLista = "";
    if (isset($_SESSION["student"])) {
        $student = $_SESSION["student"];
        require_once('student-nav.php');
    }
    elseif (isset($_SESSION["employer"])) {
        require_once('employer-nav.php');
        $postLista = 1;
    }
    else {
        require_once('admin-nav.php');
        $postLista = 1;
        $admin = 1;
    }
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">The Job Offer Information</h2>
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 white-box">
                            <div class="d-flex align-item-center">
                                <img src="<?= $jobOffer->getFlyer() != "" ? FRONT_ROOT.$jobOffer->getFlyer() : FRONT_ROOT.VIEWS_PATH."temp/no_img.jpg" ?>" style="width: 350px;">
                            </div>
                        </div>
                        <div class="col-lg-8 white-box">
                            <div class="row">
                                <span class="col-lg-6">Description:</span>
                                <span class="col-lg-6"><?= $jobOffer->getDescription() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Publication Date:</span>
                                <span class="col-lg-6"><?= $jobOffer->getPublicationDate() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Expiration Date:</span>
                                <span class="col-lg-6"><?= $jobOffer->getExpirationDate() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Requirements:</span>
                                <span class="col-lg-6"><?= $jobOffer->getRequirements() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Workload:</span>
                                <span class="col-lg-6"><?= $jobOffer->getWorkload() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Max Postulations:</span>
                                <span class="col-lg-6"><?= $jobOffer->getMaxPostulations() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Job Position:</span>
                                <span class="col-lg-6"><?= $jobPosition->getDescription() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Career:</span>
                                <span class="col-lg-6"><?= $career->getDescription() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Company:</span>
                                <span class="col-lg-6"><?= $company->getFantasyName() ?></span>
                            </div>
                            <!-- ACA VA LO BUENOOOOOO   -->
                            <?php if ($student != "" && !$already_post && !$no_post_left) { ?>
                                <form action="<?php echo FRONT_ROOT . "Postulation/Add" ?>" method="post" enctype="multipart/form-data">
                                    <div class="d-flex justify-content-between mt-5">
                                    
                                        <input class="hidden" name="jobOfferId" value="<?= $jobOffer->getJobOfferId() ?>">
                                        <input class="hidden" name="studentId" value="<?= $student->getStudentId() ?>">
                                        <input class="hidden" name="studentFullName" value="<?= ($student->getFirstName() ." ". $student->getLastName()) ?>">
                                        <input class="hidden" name="postulationDate" value="<?= date("Y-m-d") ?>">

                                        <div class="">
                                            <label for="">Insert your Curiculim here</label>
                                            <input name="curriculum" type="file" required="required">
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-success d-block mr-3">Postulate</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } elseif ($already_post) {?>
                                <div class="d-flex justify-content-end">
                                    <span class=""><i class="fas fa-check mr-3"></i>Inscripted</span>
                                </div>
                            <?php } elseif ($no_post_left) {?>
                                <div class="d-flex justify-content-end">
                                    <span class=""><i class="fas fa-times mr-3"></i>Inscriptions are full</span>
                                </div>
                            <?php } ?>
                            <?php if ($admin != "") { ?>
                                <div class="d-flex justify-content-end">
                                    <form action="<?php echo FRONT_ROOT . "JobOffer/ListPostulationsInPdf" ?>" method="post" class="row">
                                        <input class="hidden" name="jobOfferId" value="<?= $jobOffer->getJobOfferId() ?>">
                                        <button type="submit" class="btn d-block mr-3">Get Postulation List (.PDF)</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if ($postLista) { ?>

            <h4 class="mt-5">Postulation List</h4>
            <table class="table table-sm ">
                <thead class="">
                    <tr>
                        <th class="text-left">Description</th>
                        <th class="text-center">Student</th>
                        <th class="text-center">Workload</th>
                        <th class="text-center">Job Position</th><!-- career en detalles -->
                        <th class="text-center">Company</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php 
                        if($postulationsLista) { 
                            foreach ($postulationsLista as $postulation) {
                                $jobOffer = $jobOfferDAO->GetOne($postulation->getJobOfferId());
                                $jobPosition = $jobPositionDAO->GetOne($jobOffer->getJobPositionId());
                                $company = $companyDAO->GetOne($jobOffer->getCompanyId());
                    ?>
                        <tr>
                            <td class="text-left">
                                <input class="postulationId hidden" value="<?= $postulation->getPostulationId() ?>"/>
                                <span class="description"><?= $jobOffer->getDescription() ?></span>
                            </td>
                            <td class="text-left">
                                <span class=""><?= $postulation->getStudentFullName() ?></span>
                            </td>
                            <td class="text-center">
                                <span class=""><?= $jobOffer->getWorkload() ?></span>hs
                            </td>
                            <td class="text-center">
                                <span class="" data-id="<?=$jobPosition->getJobPositionId()?>">
                                    <?= $jobPosition->getDescription() ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="" data-id="<?=$company->getCompanyId()?>">
                                    <?= $company->getFantasyName() ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <button type="button" title="Remove" class="button-modal-delete btn btn-danger" style="margin-left: 3px;"  data-toggle="modal" data-target="#modalDeletePostulation"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>

                    <?php   } 
                        } 
                        else { 
                    ?>

                        <td colspan = 7 class="text-center"><strong>THIS TABLE IS EMPTY</strong></td>              

                    <?php  } ?>
                </tbody>
            </table>

            <?php  } ?>
        </div>
    </section>
</main>

<div class="modal fade" id="modalDeletePostulation" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= FRONT_ROOT ?>Postulation/DeletePostulation" method="post">

                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">¿Are you sure to remove <strong id="postulation_name_todelete"></strong>? </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="number" id="postulation_id_todelete" name="postulationId" value="" class="hidden">

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" onclick="this.form.submit(); this.disabled=true; this.value='Sending…';">Remove</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require_once(VIEWS_PATH . "footer.php"); ?>

<script>
    $(document).ready(function() {
        $(".button-modal-delete").click(
            function () {
                var $row = $(this).closest("tr");

                $("#postulation_name_todelete").text($row.find(".description").text());
                $("#postulation_id_todelete").val($row.find(".postulationId").val());
            }
        );
    });
</script>