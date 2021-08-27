<?php

include 'config.inc';
$qId=$_GET['qId'];
$sql="select * from questions where level=".$qId;
$result=mysql_query($sql);
$res=  mysql_fetch_object($result);
print(json_encode($res));