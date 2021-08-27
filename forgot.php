<?php
session_start();
$_SESSION['title'] = 'Kryptonix :: Rules';
include 'config.inc';
include 'header.php';

if ($_POST['btnSubmit']) {

    $un = $_POST['txtEmail'];

    $query = "SELECT * FROM members WHERE Email = '$un'";
    $result = mysql_query($query);
  $query;
    mysql_num_rows($result);
    ?>
    <script>alert('form submitted');</script>
    <?php
    if (mysql_num_rows($result) == 0) {
        ?>
        <script>
            alert('Account Not Found');
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Email will be sent');
        </script>
        <?php
        $user = mysql_fetch_array($result) or die(mysql_error());
        $uu = $user['email'];
        $up = $user['Password'];
        $message = " The password for username $uu is $up ";
        mail($un, 'Password', $message, '');
        $error[] = 'Password sent via Email Successfully!';
    }
}
?>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<body id="page-top" class="index">
    <?php
    include 'navigation.php';
    ?>

    <!-----start-main---->
    <div class="login-form">
        <h1>Reset Password</h1>
        <h2><a href="Register.php">Create Account</a></h2>
        <form method="post" id="frmForgetPass">
            <ul>
                <li>
                    <i class="icon user"></i><input type="email" name="txtEmail" id="txtEmail" required="required" class="text" placeholder="Your Email" >
                </li>


            </ul>

            <div class ="forgot">
                <h3><a href="login.php">Log In</a></h3>
                <i class="icon arrow"></i><input type="submit" value="Go" name="btnSubmit">                                                                                                                                                                                                                              
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