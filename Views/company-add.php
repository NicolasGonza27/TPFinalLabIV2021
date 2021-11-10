<?php
    require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Add new Company</h2>
               
            <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <?php if (isset($error) && $error == 1) { ?>
                                    <span class="text-danger">The tags of Cuil and/or Fantasy Name ar not available</span>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="">Fantasy Name</label>
                                    <input type="text" name="fantasyName" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Cuil</label>
                                    <input type="text" name="cuil" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phoneNumber" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" name="country" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Province</label>
                                    <input type="text" name="province" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" name="city" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Direction</label>
                                    <input type="text" name="direction" value="" class="form-control" required="required">
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