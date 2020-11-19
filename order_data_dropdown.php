<?php

/*
 * order_data_dropdown.php
 */

include 'config.php';

$result = mysqli_query($conn, "select orderNumber "
        . "from orders order by orderNumber");

$data = array();

while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}
echo json_encode($data);
