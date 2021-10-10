<?php
    require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Companys List</h2>

            <table class="table">
                <thead class="">
                    
                    <tr>
                        <th class="text-center">Fantasy Name</th>
                        <th class="text-center">Country</th>
                        <th class="text-center">Province</th>
                        <th class="text-center">City</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php 
                        if($companyList) { 
                            foreach ($companyList as $company) { 
                    ?>
                        <tr>
                            <td class="text-center"><?= $company->getFantasyName() ?></td>
                            <td class="text-center"><?= $company->getCountry() ?></td>
                            <td class="text-center"><?= $company->getProvince() ?></td>
                            <td class="text-center"><?= $company->getCity() ?></td>
                            <td class="text-center row">
                                <form action="<?php echo FRONT_ROOT . "Sala/ShowSalaDashboardView" ?>" method="post">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal" . $company->getCompanyId(); ?>">Edit</button>
                                    <button type="button" class="btn btn-outline-danger" style="margin-left: 3px;"  data-toggle="modal" data-target="<?php echo "#modalEliminar" .  $company->getCompanyId();?>">Remove</button>
                                    <input type="text" class="hidden" name="id" value="<?php echo $company->getCompanyId() ?>">
                                    <button type="submit" class="btn btn-outline-success" style="margin-left: 3px;">Details</button>
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