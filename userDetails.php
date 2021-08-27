<?php
session_start();
if(!($_SESSION['loggedIn']==1)){
header("location: login.php");
}
$_SESSION['title'] = 'Kryptonix :: User Details';
include 'header.php';
include 'config.inc';
?>
<link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
        <div class="row" >
            <div class="col-md-8 col-md-offset-2">
                <div class="box">

                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead style="background: #ccc">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>School</th>
                                    <th>Level</th>
                                    <th>Last level completed on</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "select * from members";
                                $result = mysql_query($sql);
                                while ($row = mysql_fetch_object($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->Email;?></td>
                                        <td><?php echo $row->school;?></td>
                                        <td><?php echo $row->currentLevel;?></td>
                                        <td><?php echo $row->levelCompletedOn;?></td>
                                    </tr>

                                    <?php
                                }
                                ?>


                            </tbody>
                            <tfoot style="background: #ccc">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>School</th>
                                    <th>Level</th>
                                    <th>Last level completed on</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>   <!-- /.row -->
    </section><!-- /.content --></body>
<?php
include 'footer.php';
?>
</body>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<script src="js/dataTables.bootstrap.js" type="text/javascript"></script>
<script>
    $(function() {

        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
    $('#navHead').attr('class', 'navbar navbar-default navbar-fixed-top navbar-shrink');
</script>