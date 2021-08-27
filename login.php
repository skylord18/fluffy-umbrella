<?php
session_start();
include 'header.php';
include 'config.inc';
if (isset($_POST['btnSubmit'])) {
    $error = array(); //this aaray will store all error messages
    if (empty($_POST['username'])) {//if the email supplied is empty 
        $error[] = 'You forgot to enter  your Email ';
    } else {
        $Username = $_POST['username'];
    }


    if (empty($_POST['password'])) {
        $error[] = 'Please Enter Your Password ';
    } else {
        $Password = $_POST['password'];
    }


    if (empty($error)) {//if the array is empty , it means no error found
        $query_check_credentials = "SELECT * FROM members WHERE (Email='$Username' AND Password='$Password') AND Activation IS NULL";
        $result_check_credentials = mysqli_query($dbc, $query_check_credentials);
        if (!$result_check_credentials) {//If the QUery Failed 
            $msg_error = 'Please enter correct credentials';
        }
        if (@mysqli_num_rows($result_check_credentials) == 1) {//if Query is successfull  // A match was made.
            $_SESSION = mysqli_fetch_array($result_check_credentials, MYSQLI_ASSOC);
            $_SESSION['loggedIn'] = 1;
            if ($_SESSION['userType'] == 2) {
                ?>
                <meta http-equiv="refresh" content="0; url=adminHome.php">
            <?php } else {
                ?>
                <meta http-equiv="refresh" content="0; url=play.php">
            <?php }
            ?>


            <?php
        } else {

            $msg_error = 'Either Your Account is inactive or Username /Password is Incorrect';
        }
    }

    if (isset($msg_error)) {
        ?>
        <script>
            alert('<?php echo $msg_error; ?>');
        </script>
        <?php
        unset($msg_error);
    }

    mysqli_close($dbc);
} // End of the main Submit conditional.
?>

<!---------------------------------------------------------------------------------------------->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<title>Kryptonix :: Login</title>
<body id="page-top" class="index">
    <?php
    include 'navigation.php';
    ?>

    <!-----start-main---->
    <div class="login-form">
        <h1>Sign In</h1>
        <h2><a href="register.php">Create Account</a></h2>
        <form method="post">
            <ul>
                <li>
                    <i class="icon user"></i><input type="text" name="username" class="text" placeholder="Your Email" required="required">
                </li>
                <li>
                    <i class="icon lock"></i><input type="password" name="password" placeholder="Your Password" required="required">
                </li>
            </ul>
            <div class ="forgot">
                <h3><a href="forgot.php">Forgot Password?</a></h3>
                <i class=" icon arrow"></i> <input type="submit" value="Sign In" name="btnSubmit" >                                                                                                      
            </div>
        </form>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
<script>
    $('#navHead').attr('class', 'navbar navbar-default navbar-fixed-top navbar-shrink');

</script>