<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Sign In</h2>
            
            <form action="<?php echo FRONT_ROOT ?>Student/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <?php if (isset($error) && $error == 1) { ?>
                                    <span class="text-danger">The tags of Dni and/or email ar not available</span>
                                <?php } ?>
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
                                    <label for="">File Number</label>
                                    <input type="text" name="fileNumber" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <input type="text" name="gender" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Birth Date</label>
                                    <input type="date" name="birthDate" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phoneNumber" value="" class="form-control" required="required">
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