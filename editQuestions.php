<?php
session_start();
if(!($_SESSION['loggedIn']==1)){
header("location: login.php");
}
$_SESSION['title'] = 'Kryptonix :: Edit Question';
include 'header.php';
include 'config.inc';
if (isset($_POST['formsubmitted'])) {
    $error = array();
    $level = $_POST['drpSelect'];
    $ques = $_POST['ques'];

    $key = ($_POST['key']);
    $key = preg_replace('/[^\da-z]/i', "", $key);
    $key = strtolower($key);
    $code = $_POST['code'];
    $path = "questionImages/";
    $actual_image_name = '';
    $ie = 0;
     $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg"); {
        $name = $_FILES['photoimg']['name'];
        $size = $_FILES['photoimg']['size'];

        if (strlen($name)) {
            list($txt, $ext) = explode(".", $name);
            if (in_array($ext, $valid_formats)) {
                if ($size < (1024 * 1024)) {
                    $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
                    $tmp = $_FILES['photoimg']['tmp_name'];
                    if (move_uploaded_file($tmp, $path . $actual_image_name)) {
                        $fm = 'Question Edited!';
                    } else {
                        $fm = 'failed';
                        $ie = 1;
                    }
                } else {
                    $fm = 'Image file size max 1 MB';
                    $ie = 1;
                }
            } else {
                $fm = 'Invalid file format';
                $ie = 1;
            }
        }
    }
    if ($actual_image_name == '') {
        $query = "update questions set question='$ques',answer='$key',code='$code' where level=" . $level;
    }else{
        $query = "update questions set question='$ques',answer='$key',image='$actual_image_name',code='$code' where level=" . $level;
    }
        $result = mysql_query($query) or die(mysql_error());
    
}
?>
<script>

    function fillQuestionSection(level) {
        if (level === '') {
            $('#ques').val('');
            $('#key').val('');
            $('#code').val('');
            $('#formsubmitted').attr('style', 'visibility:hidden');
        }
        $('#ques').val('');
        $('#key').val('');
        $('#code').val('');
        $.ajax({
            type: 'GET',
            url: 'questionDetails.php?qId=' + level,
            success: function(data) {
                data = JSON.parse(data);
                $('#ques').val(data.question);
                $('#key').val(data.answer);
                $('#code').val(data.code);
                $('#formsubmitted').attr('style', '');

            }
        });

    }
</script>
<body id="page-top" class="index">
    <?php
    include 'navigation.php';
    ?>
    <section id="question" class="content">
        <div class="row text-center">
            <div class="col-md-12 center">
                <a href="addQuestions.php" class="btn btn-lg btn-info img-thumbnail">ADD QUESTIONS</a>
                <a href="editQuestions.php" class="btn btn-lg btn-warning">EDIT QUESTIONS</a>
                <a href="userDetails.php" class="btn btn-lg btn-success">SEE USERS DETAILS</a>
            </div>
        </div>
        <hr>
        <div class="row" id="divEditQuestion">
            <!-- left column -->
            <div class="col-md-6 col-md-offset-3">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title text-muted">Edit question</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" method="post">
                        <div class="box-body">

                            <div class = "form-group">
                                <?php
                                $query2 = "SELECT * FROM questions";
                                $result2 = mysql_query($query2);
                                ?>
                                <select name="drpSelect" class="form-control" id = "drpSelect" onchange=fillQuestionSection(this.value)>
                                    <option value = ""> -------------Select Question--------------------</option>
                                    <?php
                                    while ($row = mysql_fetch_assoc($result2)) {
                                        $rows1[] = $row;
                                        echo $row['level'];
                                        ?>
                                        <option value="<?php echo $row['level'] ?>"><?php echo $row['level'] ?></option>
                                    <?php }
                                    ?>
                                </select>

                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" id="ques" name="ques" placeholder="question">
                            </div>
                            <div class="form-group">

                                <input type="file" id="photoimg" name="photoimg">

                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" id="code" name="code" placeholder="Html Code">
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" id="key" name="key" placeholder="Enter Answer">
                            </div>


                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" style="visibility: hidden" name="formsubmitted" id="formsubmitted">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->



            </div><!--/.col (left) -->

        </div>   
        <div class="row" id="divEditQuestion" style="display:none">
            <!-- left column -->
            <div class="col-md-6 col-md-offset-3">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title text-muted">Question No.:</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" method="post">
                        <div class="box-body">

                            <div class="form-group">

                                <input type="text" class="form-control" id="ques" name="ques" placeholder="Enter Question">
                            </div>

                            <div class="form-group">

                                <input type="file" id="photoimg" name="photoimg">

                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" id="code" name="code" placeholder="Html Code">
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" id="key" name="key" placeholder="Enter Answer">
                            </div>


                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="formsubmitted" id="formsubmitted">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->



            </div><!--/.col (left) -->

        </div>   <!-- /.row -->
    </section><!-- /.content --></body>
<?php
include 'footer.php';
?>
</body>
<script>
    $('#navHead').attr('class', 'navbar navbar-default navbar-fixed-top navbar-shrink');
</script>