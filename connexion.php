<?php
  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92a061';
  $dbpass = 'IqNWYzl3';
  $dbname = 'nf92a061';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  mysqli_set_charset($connect, 'utf8');
?>
