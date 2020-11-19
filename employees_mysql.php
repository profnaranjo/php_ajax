<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost:8889", "root", "root", "classicmodels");

$result = $conn->query("SELECT t.* FROM employees t order by firstName, lastName");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"ID":"'  . $rs["employeeNumber"] . '",';
  $outp .= '"FName":"'  . $rs["firstName"] . '",';
  $outp .= '"LName":"'  . $rs["lastName"] . '",';
  $outp .= '"Ext":"'   . $rs["extension"]        . '",';
  $outp .= '"Email":"'. $rs["email"]     . '",';
  $outp .= '"OffCode":"'. $rs["officeCode"]     . '",';
  $outp .= '"ReportsTo":"'. $rs["reportsTo"]     . '",';
  $outp .= '"JobTitle":"'. $rs["jobTitle"]     . '"}';
  
  
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);