<?php

/*
 * load_orderdetails_data.php
 */

include 'config.php';

$output = '';
if (isset($_POST["order_id"])) {

    if ($_POST["order_id"] != '') {
        $sql = "SELECT t.* FROM orderdetails t "
                . "where t.orderNumber = " . $_POST["order_id"] . " "
                . "order by orderLineNumber";
    }

    $result = mysqli_query($conn, $sql);

    $output .= "<table class='table table-bordered'>
                <tr>
                    <th>orderLineNumber</th>                
                    <th>Order No.</th>
                    <th>productCode</th>
                    <th>quantityOrdered</th>
                    <th>priceEach</th>
                    <th>Total</th>
                </tr>";

    $total_order = 0;

    while ($row = mysqli_fetch_array($result)) {

        $output .= "<tr>";
        $output .= "<td>" . $row['orderLineNumber'] . "</td>";
        $output .= "<td>" . $row['orderNumber'] . "</td>";
        $output .= "<td>" . $row['productCode'] . "</td>";
        $output .= "<td align='right'>" . $row['quantityOrdered'] . "</td>";
        $output .= "<td align='right'>" . $row['priceEach'] . "</td>";
        $output .= "<td align='right'>" . money_format('$%i', $row['quantityOrdered'] * $row['priceEach']) . "</td>";
        $output .= "</tr>";
        
        $total_order += $row['quantityOrdered'] * $row['priceEach'];
        
    }
    
    $output .= "<tr><td colspan='5' align='right'>Total:</td><td align='right'>".money_format('$%i', $total_order)."</td></tr>";

    $output .= "</table>";

    echo $output;
}