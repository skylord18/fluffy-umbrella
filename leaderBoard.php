<?php
session_start();
if(!($_SESSION['loggedIn']==1)){
header("location: login.php");
}
include 'header.php';
include 'config.inc';
?>
<title>Kryptonix :: Leaderboard</title>
<link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<body id="page-top" class="index">
    <?php
    include 'navigation.php';
    ?>
    <section id="question" class="content">

        <div class="row" >
            <div class="row">
                <div class="col-lg-12 text-center">
                   <i> <font face="Gulim"><h2 class="section-heading" style="color:#16a085">Leaderboard</h2></font></i>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="box">

                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead style="background: #ccc">
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>school</th>
                                    <th>Level</th>
                                    <th>Last level completed on</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "select * from members order by currentLevel desc, levelCompletedOn asc";
                                $result = mysql_query($sql);
                                $i = 1;
                                while ($row = mysql_fetch_object($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $row->school; 
?></td>

                                        <td><?php echo $row->currentLevel; ?></td>
                                        <td><?php echo $row->levelCompletedOn; ?></td>
                                    </tr>

                                    <?php
                                }
                                ?>


                            </tbody>
                            <tfoot style="background: #ccc">
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Email</th>

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