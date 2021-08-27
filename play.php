<?php
session_start();
if(!($_SESSION['loggedIn']==1)){
header("location: login.php");
}
include 'header.php';
include 'config.inc';
$sql = "select * from questions where level=" . ($user['currentLevel'] + 1);
$result = mysql_query($sql);
$resultObj = mysql_fetch_object($result);
?>
<head>
<link href="txt.css" rel="stylesheet" type="text/css">
<title>Kryptonix :: Play</title>
</head>
<script>
$(document).ready(function() {
$("#targetform").submit(function( event ) {
  event.preventDefault();
  checkAnswer(<?php echo $resultObj->level; ?>);
});
});
    function checkAnswer(questionId) {
$.post( "checkAnswer.php", { qid: questionId, answer: $('#txtAnswer').val() })
  .done(function( data ) {
                    event.preventDefault();
                if (data == 'success') {
                    $('#paraSuccess').css('visibility', 'visible');
                    $('#paraError').css('visibility', 'hidden');
                    setTimeout(function(){ window.location='play.php'; }, 3000);
                }
                else {
                    $('#paraError').css('visibility', 'visible');
                    $('#paraSuccess').css('visibility', 'hidden');
                }
  });
    }
</script>
<body id="page-top" class="index">
    <?php
    include 'navigation.php';
    ?>
    <section id="services" style="background: #ebebeb">
        <div class="container" style="background: #fff" >
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <p id="paraError" class="bg-danger" style="visibility: hidden" >Wrong Answer..<br>Think deeper</p>
                    <p id="paraSuccess" class="bg-success" style="visibility: hidden">Right Answer..<br></p>
                    <h2 class="section-heading"><font face="Alpha Sentry" size="20">Level <?php echo $resultObj->level; ?></font></h2>
                   <p class="text-muted"><?php echo $resultObj->question; ?></p>
                    <?php if ($resultObj->image != '') { ?>
                        <img src="questionImages/<?php echo $resultObj->image; ?>" class="img-responsive img-thumbnail" >
                    <?php } ?>
                    <?php if ($resultObj->code != '') { ?>
                        <p class="text-muted"><?php echo $resultObj->code; ?></p><br /><br />
<?php } ?>
                 <div class="cor">
<form id="targetform">
    
    <div class="group">      
    <input type="text" required="required" name="txtAnswer" id="txtAnswer">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Your Answer</label>
  </div>   
  </form>
</div>
      
                    
                    <input type="button" value="Submit" onclick="checkAnswer(<?php echo $resultObj->level; ?>)" name="btnAnswerSubmit" id="btnAnswerSubmit">
                    <hr>
                </div>
            </div>

        </div>
    </section>
    <?php
    include 'footer.php';
    ?>
</body>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<script src="js/dataTables.bootstrap.js" type="text/javascript"></script>
<script>
                        $('#navHead').attr('class', 'navbar navbar-default navbar-fixed-top navbar-shrink');
</script>