<?php
session_start();
$_SESSION['title'] = 'Kryptonix :: Activation';
include 'header.php';
include 'config.inc';
?>
<?php
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email'])) {
    $email = $_GET['email'];
} else
    $val = 'Oops !Your account could not be activated. Please recheck the link or contact the system administrator. <a href="/">Click here to continue</a>';
if (isset($_GET['key']) && (strlen($_GET['key']) == 32)) {//The Activation key will always be 32 since it is MD5 Hash
    $key = $_GET['key'];
} else
    $val = 'Oops !Your account could not be activated. Please recheck the link or contact the system administrator. <a href="/">Click here to continue</a>';

if (isset($email)) {
    // Update the database to set the "activation" field to null
   $query = "SELECT * FROM members WHERE Email ='$email'";

    $result = mysql_query($query) or die(mysql_error());
    echo mysql_num_rows($result);
    if (mysql_num_rows($result) > 0) {

        $user = mysql_fetch_array($result) or die(mysql_error());


        $query_activate_account = "UPDATE members SET Activation=NULL WHERE(Email ='$email' AND Activation='$key')LIMIT 1";


        $result_activate_account = mysql_query($query_activate_account);

        // Print a customized message:
        $quer = "SELECT * FROM members WHERE Email ='$email'";

        $resul = mysql_query($quer) or die(mysql_error());

        $use = mysql_fetch_array($resul) or die(mysql_error());

        $as = $use['Activation'];
        if (!isset($as)) {//if update query was successfull
            $val = 'Your account is now active. </br> <a href="home.php">Click here to continue';
        } else {
            $val = 'Oops !Your account could not be activated. Please recheck the link or contact the system administrator. <a href="/">Click here to continue</a>';
        }
    } else
        $val = 'Invalid Activation Link';
    mysql_close($dbhandle);
} else {
    $val = 'Error Occured';
}
?>
<body id="page-top" class="index">
    <?php
    include 'navigation.php';
    ?>
    <section style="min-height: 80%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Activate your account!</h2>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 col-md-offset-4">
                    <p class="text-muted"><?php echo $val ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php
    include 'footer.php';
    ?>
</body>
<script>
    $('#navHead').attr('class', 'navbar navbar-default navbar-fixed-top navbar-shrink');

</script>