<?php session_start();
include("session.php");





$time = time()+86400;
$sql_unit = "SELECT * FROM units_table";
$query_unit=mysqli_query($con, $sql_unit);
$sql_count = "SELECT * FROM ";
$i = 1;
while($row = mysqli_fetch_array($query_unit)){

    if($i!=mysqli_num_rows($query_unit)){
     $sql_count.=$row['table_name']." WHERE request_status= 0 AND hou_time < $time UNION ALL SELECT * FROM ";
    }else{
      $sql_count.=$row['table_name']." WHERE request_status= 0 AND hou_time < $time ";
    }
$i++;
}                             


//$sql_count.=;
//echo "$sql_count";


//select * from ict_unit  where email='$email' union all select * from student_affairs_unit  where email='$email'

   /* echo $subject_id."<br>";
    echo $table_name."<br>";
    echo print_r($row)."<br>";*/

    // foreach ($obj as $key => $value) {
    //   #
    //   echo $value."<br>";
    // }




?>
