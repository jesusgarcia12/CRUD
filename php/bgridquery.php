<?php

include_once("conex_pdo.php");
$params       =array();
$totalrecords = array();
$data         = array();


if (isset($params["current"])){
    $page = $page["current"];

}else{

    $page=1;
}

$sql = "SELECT * FROM students";

$queryTot  = mysqli_query($conn,$sql) or die ("Database error". mysqli_error($conn));
$totalRecords = mysqli_num_rows($queryTot);
$queryRecords =mysqli_query($conn,$sql) or die("Query error");

while($row = mysqli_fetch_assoc($queryRecords)){
$data[]=$row;
}

$json_data = array(

"current" => intval($params['current']),
"rowCount" => 10,
"rows"=> $data,
"total"=> $totalRecords,

);