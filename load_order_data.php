<?php

/*
 * load_order_data.php
 */

include 'config.php';

$output = '';
if (isset($_POST["order_id"])) {

    if ($_POST["order_id"] != '') {
        
        $sql = "select * from orders t where t.orderNumber = " . $_POST["order_id"] . " ";
        
    }

    $result = mysqli_query($conn, $sql);

    $output .= "<table width='100%' border='1'>";


    while ($row = mysqli_fetch_array($result)) {

        $output .= "<tr><td class='tdTitle'>Ord.No.:</td></tr><tr><td>" . $row['orderNumber'] . "</td></tr>";
        $output .= "<tr><td class='tdTitle'>order Date:</td></tr><tr><td>" . $row['orderDate'] . "</td></tr>";
        $output .= "<tr><td class='tdTitle'>Req.Date:</td></tr><tr><td>" . $row['requiredDate'] . "</td></tr>";
        $output .= "<tr><td class='tdTitle'>Ship.Date:</td></tr><tr><td>" . $row['shippedDate'] . "</td></tr>";
        $output .= "<tr><td class='tdTitle'>Status:</td></tr><tr><td>" . $row['status'] . "</td></tr>";
        $output .= "<tr><td class='tdTitle'>Comments:</td></tr><tr><td>" . $row['comments'] . "</td></tr>";
        $output .= "<tr><td class='tdTitle'>Cust.No.:</td></tr><tr><td>" . $row['customerNumber'] . "</td></tr>";

        $output .= "</tr>";
    }

    $output .= "</table>";

    echo $output;
}
