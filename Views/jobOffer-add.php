<?php
    $employerCompanyId = "";
    if (isset($_SESSION["employer"])) {
        require_once('employer-nav.php');
        $employerCompanyId = $_SESSION["employer"]->getCompanyId();
    }
    else {
        require_once('admin-nav.php');
    }
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Add new Job Offer</h2>
               
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-light-alpha p-5" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" name="description" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Publication Date</label>
                                    <input type="date" name="publicationDate" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Expiration Date</label>
                                    <input type="date" name="expirationDate" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Requirements</label>
                                    <input type="text" name="requirements" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Workload</label>
                                    <input type="number" name="workload" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Max Postulations</label>
                                    <input type="number" name="maxPostulations" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Job Position</label>
                                    <div class="form-control" required="required">
                                        <select name="jobPositionId" value="">
                                            <?php foreach ($jobPositionList as $jobPosition) { ?>
                                                <option value="<?=$jobPosition->getJobPositionId()?>"><?=$jobPosition->getDescription()?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if (!$employerCompanyId) { ?>
                                    <div class="form-group">
                                        <label for="">Company</label>
                                        <div class="form-control" required="required">
                                            <select name="companyId" value="">
                                                <?php foreach ($companyList as $company) { ?>
                                                    <option value="<?=$company->getCompanyId()?>"><?=$company->getFantasyName()?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <input class="hidden" name="companyId" value="<?= $employerCompanyId ?>">
                                <?php } ?>
                                <div class="form-group">
                                    <label for="">Flyer Image</label>
                                    <input name="flyer" type="file">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark d-block">Add</button>
                        </div>
                    </div>
                </div>
            </form>   
        </div>
    </section>
</main>