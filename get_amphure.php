<?php
include('config/connect.php');
$sql = "SELECT * FROM amphures WHERE province_id={$_GET['province_id']} order by name_th";
$query = mysqli_query($connn, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);