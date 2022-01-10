<?php  
    session_start();
    require_once '../config/database.php';
    date_default_timezone_set("Asia/Dhaka");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!empty($_POST['loginbtn'])) {

            if(!empty($_POST['mobile_user']) && !empty($_POST['passwords'])) {
                
                $mobile_user = (!empty($_POST["mobile_user"])) ? $_POST["mobile_user"] : '';
                $passwords = (!empty($_POST["passwords"])) ? $_POST["passwords"] : '';

                $login_sql = "SELECT * FROM users WHERE username = '$mobile_user' AND password = '$passwords' LIMIT 1";
                $login_result = mysqli_query($conn, $login_sql);
                
                if(mysqli_num_rows($login_result) > 0) {
                    $login_row = mysqli_fetch_assoc($login_result);
                    if($login_row['username'] == $mobile_user && $login_row['password'] == $passwords ) {

                        $_SESSION['userid'] = $login_row['id'];
                        $_SESSION['fullname'] = $login_row['name'];
                        $_SESSION['username'] = $login_row['username'];
   
                        if((isset($_SESSION['userid']) && $_SESSION['userid'] != "") && (isset($_SESSION['username']) && $_SESSION['username'] != ""))
                        {
                            header("Location: dashboard.php");
                            exit;
                        }
                    }
                    else {
                        $_SESSION['errorMsg'] = "<div class='alert alert-danger' role='alert'>Invalid Credentials!</div>";
                    }
                }
                else {
                    $_SESSION['errorMsg'] = "<div class='alert alert-danger' role='alert'>Invalid Login Credentials or Deactivate!</div>";
                }
            }
            else {
                $_SESSION['errorMsg'] = "<div class='alert alert-danger' role='alert'>Enter Username & Password to Login!</div>";
            }
        }
    }
    else {
        if((isset($_SESSION['userid']) && $_SESSION['userid'] != "") && (isset($_SESSION['username']) && $_SESSION['username'] != ""))
        {
            header("Location: dashboard.php");
            exit;
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title>bKash Banner Portal | Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section class="ftco-section">
            <div class="container">
              <!--   <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <h2 class="heading-section">Login #07</h2>
                    </div>
                </div> -->
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                                <div class="text w-100">
                                    <svg id="logo" class="center" width="120" height="120" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 398 374">
									    <g id="shapes">
									        <path fill="#fff" d="M14.2 9c1.1 2.6 131.4 167.8 131.9 167.2.8-.9 41-146.4 40.6-146.9-.2-.1-38.1-4.8-84.3-10.3C56.3 13.5 17.5 8.9 16.2 8.7c-1.2-.3-2.1-.1-2 .3z"></path>
									        <path fill="#fff" d="M191 31.2c0 .4-9.2 34-20.5 74.7l-20.4 73.9 11.1 50.1 11.1 50 62.6-31.6c34.4-17.3 67.2-34 72.8-37l10.2-5.4-15.2-21.2c-8.4-11.7-36.2-50.2-61.6-85.7C197.6 38.6 191 29.6 191 31.2z"></path>
									        <path fill="#fff" d="M16 41.5c1.9 1.8 15.7 14.7 30.5 28.6C61.4 84.1 76.1 98 79.4 101c5.4 5.1-5-8.7-42.7-56.7l-4.9-6.2H12.5l3.5 3.4z"></path>
									        <path fill="#fff" d="M312.5 128c-20.3 3.8-37.7 7-38.6 7.2-1.2.2 4.8 9.2 22.2 33.3 13.2 18.1 24.5 33.9 25.2 34.9 1.1 1.6 3.2-3.2 16.1-38.2 8.1-22.1 15-41 15.3-42.2.4-1.5.1-2-1.3-1.9-1.1.1-18.5 3.2-38.9 6.9z"></path>
									        <path fill="#fff" d="M352.5 138.1c-3.3 8.9-6.1 16.5-6.3 17-.4 1 40.5 1 43.1 0 1.4-.6-1.2-3.8-13.9-17-8.6-8.9-15.9-16.2-16.3-16.2-.3 0-3.3 7.3-6.6 16.2z"></path>
									        <path fill="#fff" d="M138.1 213.2C104 332.5 94.5 366.8 95.4 366.3c1.1-.7 74.1-59.7 76.4-61.8 1-.9-1.2-12.4-11.8-60.1-7.2-32.4-13.2-59.3-13.3-59.7-.1-.5-4 12.3-8.6 28.5z"></path>
									        <path fill="#fff" d="M256.5 242c-33.5 17-60.8 31-60.5 31 .3 0 27.1-10.7 59.5-23.8l58.8-23.7 1.7-5c3-8.7 3.2-9.5 2.3-9.5-.4 0-28.2 14-61.8 31z"></path>
									    </g>
									</svg>
                                </div>
                            </div>
                            <div class="login-wrap p-4 p-lg-5">
                                <div class="d-flex">
                                    <div class="w-100">
                                        <h3 class="mb-4">Sign In</h3><hr>
                                    </div>
                                    <!-- <div class="w-100"> -->
                                        <!-- <p class="social-media d-flex justify-content-end">
                                            <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                            <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                        </p> -->
                                    <!-- </div> -->
                                </div>
                                <?php 
                                    if(isset($_SESSION['errorMsg']))
                                    {    
                                        echo $_SESSION['errorMsg'];
                                    } 
                                    elseif(isset($_SESSION['successMsg'])) 
                                    { 
                                        echo $_SESSION['successMsg']; 
                                    } 
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="signin-form" method="post">
                                    <div class="form-group mb-3">
                                        <label class="label" for="name">Mobile</label>
                                        <input type="text" class="form-control" placeholder="Mobile" name="mobile_user" required autofocus autocomplete="off" maxlength="11">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="password">Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="passwords" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="loginbtn" class="form-control btn btn-primary submit px-3" value="Sign In">
                                    </div>
                                    <!-- <div class="form-group d-md-flex">
                                        <div class="w-50 text-left">
                                            <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="w-50 text-md-right">
                                            <a href="#">Forgot Password</a>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <p align="center"><a href="https://www.bkash.com/" target="_blank">bKash</a> &#169; <?= date("Y") ?></p>
        </section>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

<?php 
    if (isset($_SESSION['errorMsg'])) {
        unset($_SESSION['errorMsg']);
    }
    if(isset($_SESSION['successMsg'])) {
        unset($_SESSION['successMsg']);
    }
?>