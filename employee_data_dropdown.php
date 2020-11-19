<?php

/* 
 * employee_data_dropdown.php
 */

include 'config.php';

$result = mysqli_query($conn, "SELECT t.employeeNumber, concat(t.lastName, ', ', t.firstName) employee_name
                FROM employees t order by 2");

$data = array();

while ( $row = mysqli_fetch_array($result) )
{
    $data[] = $row;
}
echo json_encode( $data ); 