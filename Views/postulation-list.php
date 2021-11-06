<?php
    $careerList = "";
    $jobPositionList = "";
    $jobOfferList = "";
    $companyList = "";
    require_once('admin-nav.php');
    
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Postulations List</h2>

            <table class="table">
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
                        if($postulationList) { 
                            foreach ($postulationList as $postulation) {
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
                                <form action="<?php echo FRONT_ROOT . "JobOffer/ShowJobOfferView" ?>" method="post" class="mb-0">
                                    <button type="button" title="Remove" class="button-modal-delete btn btn-danger" style="margin-left: 3px;"  data-toggle="modal" data-target="#modalDeletePostulation"><i class="fas fa-trash"></i></button>
                                    <input type="text" class="hidden" name="jobOfferId" value="<?= $jobOffer->getJobOfferId() ?>">
                                    <button type="submit" title="Details" class="btn btn-success" style="margin-left: 3px;"><i class="fas fa-file"></i></button>
                                </form>
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