<?php

/*
 * load_data.php
 */

include 'config.php';

$output = '';
if (isset($_POST["emp_id"])) {
    if ($_POST["emp_id"] != '') {
        $sql = "SELECT t.* FROM employees t where t.employeeNumber = '" . $_POST["emp_id"] . "'";
    } else {
        $sql = "SELECT * FROM employees";
    }
    
    $result = mysqli_query($conn, $sql);
    
    $output .=  "<table class='table table-bordered'>
                <tr>
                <th width='45'>ID</th>
                <th width='110'>Lastname</th>
                <th width='110'>Firstname</th>
                <th width='80'>Ext</th>
                <th width='260'>Email</th>
                <th width='100'>Off Code</th>
                <th width='100'>Reports To</th>
                <th width='220'>Title</th>
                </tr>";
    
    while ($row = mysqli_fetch_array($result)) {
        
        $output .= "<tr>";
            $output .= "<td>" . $row['employeeNumber'] . "</td>";
            $output .= "<td>" . $row['lastName'] . "</td>";
            $output .= "<td>" . $row['firstName'] . "</td>";
            $output .= "<td>" . $row['extension'] . "</td>";
            $output .= "<td>" . $row['email'] . "</td>";
            $output .= "<td>" . $row['officeCode'] . "</td>";
            $output .= "<td>" . $row['reportsTo'] . "</td>";
            $output .= "<td>" . $row['jobTitle'] . "</td>";
            $output .= "</tr>";
        //$output .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">' . $row["product_name"] . '</div></div>';
    }
    
    $output .= "</table>";
    
    echo $output;
}  