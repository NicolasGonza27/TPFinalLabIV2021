<?php
    $jobPositionList = "";
    $companyList = "";
    if (isset($_SESSION["student"])) {
        require_once('student-nav.php');
    }
    else {
        require_once('admin-nav.php');
        $jobPositionList = $jobPositionDAO->GetAll();
        $companyList = $companyDAO->GetAll();
    }
    
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-end">
                <div class="col-lg-4">
                    <form action="<?= FRONT_ROOT ?>JobOffer/ShowJobOfferListView" method="post">
                        <div class="d-flex align-item-center">
                            <input type="text" class="flex-grow-1" name="description" value="<?=($description ? $description : "")?>">
                            <button type="submit" title="Search" class="btn" style="margin-left: 3px;"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
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
                                    <button type="button" title="Edit" class="button-modal-edit btn btn-primary" data-id="<?= $jobOffer->getJobOfferId() ?>" data-toggle="modal" data-target="#modalEditJobOffer"><i class="fas fa-edit"></i></button>
                                    <button type="button" title="Remove" class="button-modal-delete btn btn-danger" style="margin-left: 3px;"  data-toggle="modal" data-target="#modalDeleteJobOffer"><i class="fas fa-trash"></i></button>
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

<div class="modal fade" id="modalEditJobOffer" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="signup-form">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="m-20" action="<?= FRONT_ROOT ?>JobOffer/ModifyJobOffer" method="post">
                
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h2 id="modal_edit_title">Edit Job Offer </h2>
                    <p>You can edit the job Offer, change the text fields that you want to modify.</p>
                    <hr>

                    <input type="text" id="job_offer_id_edit" name="jobOfferId" class="hidden" value="" >

                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" id="description_edit" name="description" class="form-control" maxlength="15" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Publication Date</label>
                        <input type="date" id="publication_date_edit" name="publication_date" class="form-control" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Expiration Date</label>
                        <input type="date" id="expiration_date_edit" name="expiration_date" class="form-control" value="" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="">Requirements</label>
                        <input type="text" id="requirements_edit" name="requirements" class="form-control" maxlength="70" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Workload</label>
                        <input type="number" id="workload_edit" name="workload" class="form-control" min="1" max="24" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Job Position</label>
                        <select id="job_position_id_edit" name="jobPositionId" class="form-control" value="" required>
                            <?php foreach($jobPositionList as $jobPosition) { ?>
                                <option value="<?=$jobPosition->getJobPositionId()?>"><?=$jobPosition->getDescription()?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Company</label>
                        <select id="company_id_edit" name="companyId" class="form-control" value="" required>
                            <?php foreach($companyList as $company) { ?>
                                <option value="<?=$company->getCompanyId()?>"><?=$company->getFantasyName()?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteJobOffer" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= FRONT_ROOT ?>JobOffer/DeleteJobOffer" method="post">

                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">¿Are you sure to remove <strong id="job_offer_name_todelete"></strong>? </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="number" id="job_offer_id_todelete" name="jobOfferId" value="" class="hidden">

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
          $(".button-modal-edit").click(
               function () {
                    var $row = $(this).closest("tr");
                    $("#modal_edit_title").text("Edit Job Offer: " + $row.find(".description").text());
                    
                    $("#job_offer_id_edit").val($row.find(".jobOfferId").val());
                    $("#description_edit").val($row.find(".description").text());
                    $("#publication_date_edit").val($row.find(".publicationDate").text());
                    $("#expiration_date_edit").val($row.find(".expirationDate").text());
                    $("#requirements_edit").val($row.find(".requirements").val());
                    $("#workload_edit").val($row.find(".workload").text());
                    $("#job_position_id_edit option[value='"+ $row.find('.jobPositionId').data('id') +"']").attr("selected",true);
                    $("#company_id_edit option[value='"+ $row.find(".companyId").data("id") +"']").attr("selected",true);
               }
          );

          $(".button-modal-delete").click(
               function () {
                    var $row = $(this).closest("tr");

                    $("#job_offer_name_todelete").text($row.find(".description").text());
                    $("#job_offer_id_todelete").val($row.find(".jobOfferId").val());
               }
          );
     });
</script>