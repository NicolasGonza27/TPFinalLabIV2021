<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Sign In as Employer</h2>
            
            <form action="<?php echo FRONT_ROOT ?>Employer/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if (isset($error) && $error == 1) { ?>
                            <span class="text-danger">The tags of Dni and/or email are not available</span>
                        <?php } ?>
                        <?php if (isset($error) && $error == 2) { ?>
                            <span class="text-danger">The tags of Fantasy Name and/or cuil are not available</span>
                        <?php } ?>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <h4 class="mb-4">Your Employer Information</h4>
                                
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" name="firstName" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="lastName" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Dni</label>
                                    <input type="text" name="dni" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" value="" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="mb-4">Your Company Information</h4>
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
                            <button type="submit" class="btn btn-dark d-block">Sign In</button>
                        </div>
                    </div>
                </div>
            </form>   
        </div>
    </section>
</main>

<?php require_once(VIEWS_PATH . "footer.php"); ?>

<script>
    $(document).ready(function() {

    });
</script>