<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div id="student_login">
                    <h2 class="mb-4">Student Login</h2>
                    <form action="<?php echo FRONT_ROOT ?>Student/ShowStudentSignInView" method="post" class="bg-light-alpha pr-5 pt-5">
                         <div class="row justify-content-end">
                              <button type="submit" class="btn btn-dark d-block">Sign In</button>
                         </div>
                    </form>
                    <form action="<?php echo FRONT_ROOT ?>Student/checkStudentEmail" method="post" class="bg-light-alpha pl-5 pb-5 pr-5">
                         <div class="row">
                              <div class="col-lg-4">
                                   <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="" class="form-control">
                                   </div>
                              </div>
                         </div>
                         <div class="row justify-content-between">
                              <button id="button_login_admin" type="button" class="btn btn-dark d-block mr-3">Login as Admin</button>
                              <button type="submit" class="btn btn-dark d-block">Login</button>
                         </div>
                    </form>
               </div>
               
               <div id="admin_login" class="hidden">
                    <h2 class="mb-4">Admin Login</h2>
                    <form action="<?php echo FRONT_ROOT ?>Admin/checkAdminLogin" method="post" class="bg-light-alpha p-5">
                         <div class="row">
                              <div class="col-lg-4">
                                   <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="" class="form-control">
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" value="" class="form-control">
                                   </div>
                              </div>
                         </div>
                         <div class="row justify-content-between">
                              <button id="button_login_student" type="button" class="btn btn-dark d-block mr-3">Login as Student</button>
                              <button type="submit" class="btn btn-dark d-block">Login</button>
                         </div>
                    </form>
               </div>
          </div>
     </section>
</main>

<?php require_once(VIEWS_PATH . "footer.php"); ?>

<script>
     $(document).ready(function() {
          $("#button_login_admin").click(
               function () {
                    $("#student_login").addClass("hidden");
                    $("#admin_login").removeClass("hidden");
               }
          );

          $("#button_login_student").click(
               function () {
                    $("#admin_login").addClass("hidden");
                    $("#student_login").removeClass("hidden");
               }
          );
     });
</script>