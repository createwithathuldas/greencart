  <?php
    include("/xamp/htdocs/GreenCart/Project/Assets/Connection/connection.php");
    ob_start();
    session_start();
    if (isset($_POST['btn_login'])) {
        $email = $_POST['txt_email'];
        $password = $_POST['txt_password'];
        $selQuery = "select * from tbl_user where user_email='$email' and user_password='$password'";
        $result = $conn->query($selQuery);
        $data = $result->fetch_assoc();

        if ($data) {
            $_SESSION['uid'] = $data['user_id'];
    ?>
          <script>
              window.location = '../User/UserHomepage.php';
          </script>
          <?php
        } else {
            $selQuery = "select * from tbl_admin where admin_email='$email' and admin_password='$password'";
            $result = $conn->query($selQuery);
            $data = $result->fetch_assoc();
            if ($data) {
                $_SESSION['aid'] = $data['admin_id'];
            ?>
              <script>
                  window.location = '../Admin/AdminHomepage.php';
              </script>
              <?php
            } else {
                $selQuery = "select * from tbl_shop where shop_email='$email' and shop_password='$password'";
                $result = $conn->query($selQuery);
                $data = $result->fetch_assoc();
                if ($data) {
                    $_SESSION['sid'] = $data['shop_id'];
                ?>
                  <script>
                      window.location = '../Shop/ShopHomepage.php';
                  </script>
  <?php
                }else{
                    ?>
                    <script>
                        alert('Incorrect')
                        window.location='../Guest/login.php'
                    </script>
                    <?php
                }
            }
        }
    }
    ?>
  <!-- login section  -->
  <section class="form-02-main">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="_lk_de">
                      <form class="form-03-main" method="post">
                          <br>
                          <br>
                          <br>
                          <div class="form-group">
                              <input type="email" name="txt_email" class="form-control _ge_de_ol" type="text" placeholder="Enter Email" required="" aria-required="true">
                          </div>

                          <div class="form-group">
                              <input type="password" name="txt_password" class="form-control _ge_de_ol" type="text" placeholder="Enter Password" required="" aria-required="true">
                          </div>

                          <div class="checkbox form-group">
                              <a href="" style="color: #ffff;">Forgot Password?</a>
                          </div>

                          <div class="form-group">
                              <div class="_btn_04" style="border: 2px solid #fff;">
                                  <input type="submit" name="btn_login" style="color: #ffff;font-weight: bold; font-size: 14pt;background-color: #548302;border:none;" value="Login">
                              </div>
                          </div>
                          <br>
                          <br>
                          <br>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- login section end -->

  <?php ob_flush(); ?>