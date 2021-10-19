<?php
    require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-end">
                <div class="col-lg-4">
                    <form action="<?= FRONT_ROOT ?>Company/ShowCompanyListView" method="post">
                        <div class="d-flex align-item-center">
                            <input type="text" class="flex-grow-1" name="fantasyName" value="<?=($fantasyName ? $fantasyName : "")?>">
                            <button type="submit" title="Search" class="btn" style="margin-left: 3px;"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <h2 class="mb-4">Companyes List</h2>

            <table class="table">
                <thead class="">
                    <tr>
                        <th class="text-center">Fantasy Name</th>
                        <th class="text-center">Cuil</th>
                        <th class="text-center">Phone Number</th>
                        <th class="text-center">Country</th>
                        <th class="text-center">Province</th>
                        <th class="text-center">City</th>
                        <th class="text-center">Direction</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php 
                        if($companyList) { 
                            foreach ($companyList as $company) { 
                    ?>
                        <tr>
                            <td class="text-center">
                                <input class="companyId hidden" value="<?= $company->getCompanyId() ?>"/>
                                <span class="fantasy-name"><?= $company->getFantasyName() ?></span>
                            </td>
                            <td class="text-center">
                                <span class="cuil"><?= $company->getCuil() ?></span>
                            </td>
                            <td class="text-center">
                                <span class="phone-number"><?= $company->getPhoneNumber() ?></span>
                            </td>
                            <td class="text-center">
                                <span class="country"><?= $company->getCountry() ?></span>
                            </td>
                            <td class="text-center">
                                <span class="province"><?= $company->getProvince() ?></span>
                            </td>
                            <td class="text-center">
                                <span class="city"><?= $company->getCity() ?></span>
                            </td>
                            <td class="text-center">
                                <span class="direction"><?= $company->getDirection() ?></span>
                            </td>
                            <td class="text-right">
                                <form action="<?php echo FRONT_ROOT . "Company/ShowCompanyView" ?>" method="post" class="mb-0">
                                    <button type="button" title="Edit" class="button-modal-edit btn btn-primary" data-id="<?= $company->getCompanyId() ?>" data-toggle="modal" data-target="#modalEditCompany"><i class="fas fa-edit"></i></button>
                                    <button type="button" title="Remove" class="button-modal-delete btn btn-danger" style="margin-left: 3px;"  data-toggle="modal" data-target="#modalDeleteCompany"><i class="fas fa-trash"></i></button>
                                    <input type="text" class="hidden" name="companyId" value="<?= $company->getCompanyId() ?>">
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

<div class="modal fade" id="modalEditCompany" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="signup-form">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="m-20" action="<?= FRONT_ROOT ?>Company/ModifyCompany" method="post">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h2 id="modal_edit_title">Edit Company </h2>
                    <p>You can edit the company, change the text fields that you want to modify.</p>
                    <hr>

                    <input type="text" id="company_id_edit" name="companyId" class="hidden" value="" >

                    <div class="form-group">
                        <label for="">Fantasy Name</label>
                        <input type="text" id="fantasy_name_edit" name="fantasyName" class="form-control" maxlength="15" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Cuil</label>
                        <input type="text" id="cuil_edit" name="cuil" class="form-control" maxlength="15" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" id="phone_number_edit" name="phoneNumber" class="form-control" maxlength="15" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" id="country_edit" name="country" class="form-control" maxlength="15" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Province</label>
                        <input type="text" id="province_edit" name="province" class="form-control" maxlength="15" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" id="city_edit" name="city" class="form-control" maxlength="15" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="">Direction</label>
                        <input type="text" id="direction_edit" name="direction" class="form-control" maxlength="15" value="" required />
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteCompany" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= FRONT_ROOT ?>Company/DeleteCompany" method="post">

                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">¿Are you sure to remove <strong id="company_name_todelete"></strong>? </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="number" id="company_id_todelete" name="companyId" value="" class="hidden">

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
                    $("#modal_edit_title").text("Edit Company: " + $row.find(".fantasy-name").text());

                    $("#company_id_edit").val($row.find(".companyId").val());
                    $("#fantasy_name_edit").val($row.find(".fantasy-name").text());
                    $("#cuil_edit").val($row.find(".cuil").text());
                    $("#phone_number_edit").val($row.find(".phone-number").text());
                    $("#country_edit").val($row.find(".country").text());
                    $("#province_edit").val($row.find(".province").text());
                    $("#city_edit").val($row.find(".city").text());
                    $("#direction_edit").val($row.find(".direction").text());
               }
          );

          $(".button-modal-delete").click(
               function () {
                    var $row = $(this).closest("tr");

                    $("#company_name_todelete").text($row.find(".fantasy-name").text());
                    $("#company_id_todelete").val($row.find(".companyId").val());
               }
          );
     });
</script>