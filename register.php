<?php
session_start();
$_SESSION['title'] = 'Kryptonix :: Register';
include 'header.php';
include 'config.inc';
if (isset($_POST['btnSubmit'])) {
    $error = array();
    $Email=$_POST['email'];
    $n = $_POST['n'];
    $Password = $_POST['password'];
    $s = $_POST['schoolname'];
    $query_verify_email = "SELECT * FROM members  WHERE Email ='$Email'";
    $result_verify_email = mysqli_query($dbc, $query_verify_email);
    if (!$result_verify_email) {
        echo "<script>alert('An account with same email already exists');</script>";
    }

    if (mysqli_num_rows($result_verify_email) == 0) { // IF no previous user is using this email .
        // Create a unique  activation code:
        $activation = md5(uniqid(rand(), true));
        $query_insert_user = "INSERT INTO `members` (  `Email`, `Password`, `Activation`, `name`, `school`) VALUES ( '$Email', '$Password', '$activation', '$n', '$s')";
        $result_insert_user = mysqli_query($dbc, $query_insert_user);
        if (!$result_insert_user) {
            echo '<script>Sorry!Please try again !!</script> ';
        }
        if (mysqli_affected_rows($dbc) == 1) { //If the Insert Query was successfull.
             echo "<script>alert('An email is sent to $Email .Please Click on activation link to Activate your account ');</script> ";  
            $link = $site . '/activate.php?email=' . urlencode($Email) . "&key=$activation";
            $message = " To activate your account, please click on this link or copy and paste it in your browser :\n\n";
            $message .= '<a href="' . $link . '">' . $link . '</a>';
            $headers = "From: " . $mail . "\r\n";
            $headers .= "Reply-To: " . $mail . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($Email, 'Registration Confirmation', $message, $headers);

            // Flush the buffered output.
            // Finish the page:
            echo '<div class="success"><p class="ta">Thanks for registering. Click on the activation link. </p></div>';
        } else { // If it did not run OK.
            echo '<div class="errormsgbox"><p class="ta"> You could not be registered due to a system error. We apologize for any inconvenience.Please try again later</p></div>';
        }
    } 

    mysqli_close($dbc); }
?>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<title>Kryptonix :: Register</title>
<body id="page-top" class="index">
    <?php
    include 'navigation.php';
    ?>
    <div class="login-form">
        <h1>Register</h1>
        <h2><a href="login.php">Login</a></h2>
        <form method="post">
          
            <li>
                <i class="icon user "></i><input type="text" class="text" name="n" id="n" required="required" placeholder="Your Name">
            </li>
            <li>
                <i class=" icon user"></i><input type="email" class="text" name="email" required="required"  placeholder="Your Email" >
            </li>
            <li>
                <i class="icon lock"></i><input type="password" name="password" required="required" placeholder="Password">

            </li><li>
                <i class="icon user"></i><input type="text" class="text" required="required"  name="schoolname" placeholder="Your School Name" >
            </li>

            <div class ="forgot">
                <h3><a href="forgot.php">Forgot Password?</a></h3>
                <i class="icon arrow"></i><input type="submit" name="btnSubmit" value="Register Now" >
				</div>
</form>
</div>
</body>
<?php
    include 'footer.php';
    ?>