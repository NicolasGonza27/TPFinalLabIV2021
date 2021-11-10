<?php
    $careerList = "";
    $jobPositionList = "";
    $jobOfferList = "";
    $companyList = "";
    require_once('student-nav.php');
    
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">My Postulations</h2>

            <table class="table table-sm">
                <thead class="">
                    <tr>
                        <th class="text-center">Description</th>
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
                            <td class="text-center">
                                <span class="workload"><?= $jobOffer->getWorkload() ?></span>hs
                            </td>
                            <td class="text-center">
                                <span class="jobPositionId" data-id="<?=$jobPosition->getJobPositionId()?>">
                                    <?= $jobPosition->getDescription() ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="companyId" data-id="<?=$company->getCompanyId()?>">
                                    <?= $company->getFantasyName() ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <form action="<?php echo FRONT_ROOT . "JobOffer/ShowJobOfferView" ?>" method="post" class="mb-0">
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

<?php require_once(VIEWS_PATH . "footer.php"); ?>

<script>
    $(document).ready(function() {
        $("#job_position_busqueda").change(
            function () {
                $("#career_busqueda").val("");
                $("#descripcion_busqueda").val("");
            }
        );
        $("#descripcion_busqueda").change(
            function () {
                $("#career_busqueda").val("");
                $("#job_position_busqueda").val("");
            }
        );
        $("#career_busqueda").change(
            function () {
                $("#job_position_busqueda").val("");
                $("#descripcion_busqueda").val("");
            }
        );
    });
</script>