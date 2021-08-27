<?php
session_start();
include 'config.inc';
$qid=$_POST['qid'];
$answer=$_POST['answer'];
$sql = "SELECT * FROM questions WHERE (level='$qid' AND answer='$answer')";
$result=mysql_query($sql);
if (!$result) {//If the QUery Failed 
    echo 'failure';
} else {
	if(mysql_num_rows($result)>0){
		$date = date('Y-m-d H:i:s');
		$date = mysql_real_escape_string($date);
		$sql_s="UPDATE members SET currentLevel='$qid', levelCompletedOn='$date' WHERE memberId=".$_SESSION['memberId'];
			if(mysql_query($sql_s)){
				echo "success";
			} else {
				echo "failure";
			}
	} else {
		echo "failure";
	}
}
?>