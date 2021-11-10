<?php
    $careerList = "";
    $jobPositionList = "";
    require_once('student-nav.php');
    $careerList = $careerDAO->GetAll();
    $jobPositionList = $jobPositionDAO->GetAll();
    
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-end">
                <form action="<?= FRONT_ROOT ?>JobOffer/ShowJobOfferListStudentView" method="post">
                    <div class="col-lg-4">
                        <div class="d-flex align-item-center">
                            <select id="career_busqueda" name="careerId" class="" value="" style="width:200px">
                                <option value="" <?=($careerId == "" ? " selected" : "")?>>Select Career...</option>
                                <?php foreach($careerList as $career) { ?>
                                    <option value="<?=$career->getCareerId()?>" <?=($careerId == $career->getCareerId() ? " selected" : "")?>>
                                        <?=$career->getDescription()?>
                                    </option>
                                <?php } ?>
                            </select>
                            <select id="job_position_busqueda" name="jobPositionId" class="ml-3" value="" style="width:200px">
                                <option value="" <?=($jobPositionId == "" ? " selected" : "")?>>Select Job Position...</option>
                                <?php foreach($jobPositionList as $jobPosition) { ?>
                                    <option value="<?=$jobPosition->getJobPositionId()?>" <?=($jobPositionId == $jobPosition->getJobPositionId() ? " selected" : "")?>>
                                        <?=$jobPosition->getDescription()?>
                                    </option>
                                <?php } ?>
                            </select>
                            <input id="descripcion_busqueda" type="text" placeholder="Serch Description" class="ml-3" name="description" value="<?=($description != "" ? $description : "")?>" style="width:200px">
                            <button type="submit" title="Search" class="btn flex-grow-0 ml-3"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <h2 class="mb-4">Job Offers List</h2>

            <table class="table table-sm">
                <thead class="">
                    <tr>
                        <th class="text-center">Description</th>
                        <th class="text-center">Publication/Expiration Date</th><!-- requirements en detalles -->
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
                            <td class="text-left">
                                <input class="jobOfferId hidden" value="<?= $jobOffer->getJobOfferId() ?>"/>
                                <input class="requirements hidden" value="<?= $jobOffer->getRequirements() ?>"/>
                                <span class="description"><?= $jobOffer->getDescription() ?></span>
                            </td>
                            <td class="text-center">
                                <span class=""><?= $jobOffer->getPublicationDate() ?>/<?= $jobOffer->getExpirationDate() ?></span>
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