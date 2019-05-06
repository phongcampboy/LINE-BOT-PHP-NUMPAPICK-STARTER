<style type="text/css">
<!--
body,td,th {
	font-family: Tahoma;
	font-size: 12px;
}
-->
</style>
<?php

$hostname = "103.4.217.49"; //ชื่อโฮสต์
$user = "chawtai_user"; //ชื่อผู้ใช้
$password = "wsx96300"; //รหัสผ่าน
$dbname = "chawtai_user"; //ชื่อฐานข้อมูล
$tblname = " member"; //ชื่อตาราง
// เริ่มติดต่อฐานข้อมูล
mysql_connect($hostname, $user, $password) or die("Error conect db");
// เลือกฐานข้อมูล
mysql_select_db($dbname) or die("Error connet db");
// คำสั่ง SQL และสั่งให้ทำงาน
	  $globals_test = @ini_get('register_globals');
if ( isset($globals_test) && empty($globals_test) ) {
   $types_to_register = array('GET', 'POST', 'COOKIE', 'SESSION', 'SERVER');
   foreach ($types_to_register as $type) {
      $arr = @${'_' . $type};
      if (@count($arr) > 0)
         extract($arr, EXTR_SKIP);
   }
}
?>
