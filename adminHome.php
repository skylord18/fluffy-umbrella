<?php
session_start();
if(!($_SESSION['loggedIn']==1)){
header("location: login.php");
}
$_SESSION['title'] = 'Kryptonix :: Admin';
include 'header.php';
include 'config.inc';
?>
<body id="page-top" class="index">
    <?php
    include 'navigation.php';
    ?>
    <section style="min-height: 80%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Welcome Admin!</h2>
                    <p class="text-muted">Please choose an option from the following:</p>
                </div>
            </div>
            <hr/>
            <div class="row text-center">
                <div class="col-md-12 center">
                    <a href="addQuestions.php" class="btn btn-lg btn-info img-thumbnail">ADD QUESTIONS</a>
                    <a href="editQuestions.php" class="btn btn-lg btn-warning">EDIT QUESTIONS</a>
                    <a href="userDetails.php" class="btn btn-lg btn-success">SEE USERS DETAILS</a>
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