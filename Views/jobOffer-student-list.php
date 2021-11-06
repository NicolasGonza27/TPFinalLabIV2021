<?php
    $jobPositionList = "";
    $companyList = "";
    require_once('student-nav.php');
    $jobPositionList = $jobPositionDAO->GetAll();
    $companyList = $companyDAO->GetAll();
    
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-end">
                <form action="<?= FRONT_ROOT ?>JobOffer/ShowJobOfferListStudentView" method="post">
                    <div class="col-lg-4">
                        <div class="d-flex align-item-center">
                            <select id="job_position_busqueda" name="jobPositionId" class="flex-grow-1" value="">
                                <option value="" <?=($jobPositionId == "" ? " selected" : "")?>>Seleccionar...</option>
                                <?php foreach($jobPositionList as $jobPosition) { ?>
                                    <option value="<?=$jobPosition->getJobPositionId()?>" <?=($jobPositionId == $jobPosition->getJobPositionId() ? " selected" : "")?>>
                                        <?=$jobPosition->getDescription()?>
                                    </option>
                                <?php } ?>
                            </select>
                            <input id="descripcion_busqueda" type="text" class="flex-grow-1" name="description" value="<?=($description != "" ? $description : "")?>">
                            <button type="submit" title="Search" class="btn" style="margin-left: 3px;"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <h2 class="mb-4">Job Offers List</h2>

            <table class="table">
                <thead class="">
                    <tr>
                        <th class="text-center">Description</th>
                        <th class="text-center">Publication Date</th>
                        <th class="text-center">Expiration Date</th><!-- requirements en detalles -->
                        <th class="text-center">Workload</th>
                        <th class="text-center">Job Position</th><!-- career en detalles -->
                        <th class="text-center">Company</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php 
                        if($jobOfferList) { 
                            foreach ($jobOfferList as $jobOffer) {
                                $jobPosition = $jobPositionDAO->GetOne($jobOffer->getJobPositionId());
                                $company = $companyDAO->GetOne($jobOffer->getCompanyId());
                    ?>
                        <tr>
                            <td class="text-center">
                                <input class="jobOfferId hidden" value="<?= $jobOffer->getJobOfferId() ?>"/>
                                <input class="requirements hidden" value="<?= $jobOffer->getRequirements() ?>"/>
                                <span class="description"><?= $jobOffer->getDescription() ?></span>
                            </td>
                            <td class="text-center">
                                <span class="publicationDate"><?= $jobOffer->getPublicationDate() ?></span>
                            </td>
                            <td class="text-center">
                                <span class="expirationDate"><?= $jobOffer->getExpirationDate() ?></span>
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
                $("#descripcion_busqueda").val("");
            }
        );
        $("#descripcion_busqueda").change(
            function () {
                $("#job_position_busqueda").val("");
            }
        );
    });
</script>