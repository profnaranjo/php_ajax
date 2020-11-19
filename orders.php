<?php
/*
 * orders.php
 */

include 'page_top.php';
?>

<h2>Classic Models Orders</h2>

<div class="row">

    <div class="col-md-2">
        <h3>Orders</h3>
        <select id="orders_dropdown" size="10">
        </select>
        <br>
        <br>
        <div id="order"></div>
        
        
    </div>

    <div class="col-md-10">
        <h3>Order Details</h3>
        <div id="order_details">
            Select an order number from the list
        </div>
    </div>

</div>

<div class="row">
    
    <div class="col-md-6">
        <h3><code>order_data_dropdown.php</code></h3>
        
        <pre>
include 'config.php';

$result = mysqli_query($conn, "select orderNumber "
        . "from orders order by orderNumber");

$data = array();

while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}
echo json_encode($data);
        </pre>
        
        <h3><code>load_order_data.php</code></h3>
        
        <pre>
include 'config.php';

$output = '';

if (isset($_POST["order_id"])) {

    if ($_POST["order_id"] != '') {
        
        $sql = "select * from orders t where t.orderNumber = " . 
               $_POST["order_id"] . " ";
        
    }

    $result = mysqli_query($conn, $sql);

    $output .= "&lt;table width='100%' border='1'>";

    while ($row = mysqli_fetch_array($result)) {

        $output .= "&lt;tr>".
                   "&lt;td style='tdTitle'>Ord.No.:&lt;/td>&lt;/tr>".
                   "&lt;tr>&lt;td>" . $row['orderNumber'] . "&lt;/td>&lt;/tr>";
        $output .= "&lt;tr>&lt;td class='tdTitle'>order Date:&lt;/td>&lt;/tr>".
                   "&lt;tr>&lt;td>" . $row['orderDate'] . "&lt;/td>&lt;/tr>";
        $output .= "&lt;tr>&lt;td class='tdTitle'>Req.Date:&lt;/td>&lt;/tr>".
                   "&lt;tr>&lt;td>" . $row['requiredDate'] . "&lt;/td>&lt;/tr>";
        $output .= "&lt;tr>&lt;td class='tdTitle'>Ship.Date:&lt;/td>&lt;/tr>".
                   "&lt;tr>&lt;td>" . $row['shippedDate'] . "&lt;/td>&lt;/tr>";
        $output .= "&lt;tr>&lt;td class='tdTitle'>Status:&lt;/td>&lt;/tr>".
                   "&lt;tr>&lt;td>" . $row['status'] . "&lt;/td>&lt;/tr>";
        $output .= "&lt;tr>&lt;td class='tdTitle'>Comments:&lt;/td>&lt;/tr>".
                   "&lt;tr>&lt;td>" . $row['comments'] . "&lt;/td>&lt;/tr>";
        $output .= "&lt;tr>&lt;td class='tdTitle'>Cust.No.:&lt;/td>&lt;/tr>".
                   "&lt;tr>&lt;td>" . $row['customerNumber'] . "&lt;/td>&lt;/tr>";

    }

    $output .= "&lt;/table>";

    echo $output;
}
        </pre>
        
    </div>
    
    <div class="col-md-6">
        <h3><code>load_orderdetails_data.php</code></h3>
        
        <pre>
 include 'config.php';

$output = '';
if (isset($_POST["order_id"])) {

    if ($_POST["order_id"] != '') {
        $sql = "SELECT t.* FROM orderdetails t "
                . "where t.orderNumber = " . $_POST["order_id"] . " "
                . "order by orderLineNumber";
    }

    $result = mysqli_query($conn, $sql);

    $output .= "&lt;table class='table table-bordered'>
                &lt;tr>
                    &lt;th>orderLineNumber&lt;/th>                
                    &lt;th>Order No.&lt;/th>
                    &lt;th>productCode&lt;/th>
                    &lt;th>quantityOrdered&lt;/th>
                    &lt;th>priceEach&lt;/th>
                    &lt;th>Total&lt;/th>
                &lt;/tr>";

    $total_order = 0;

    while ($row = mysqli_fetch_array($result)) {

        $output .= "&lt;tr>";
        $output .= "&lt;td>" . $row['orderLineNumber'] . "&lt;/td>";
        $output .= "&lt;td>" . $row['orderNumber'] . "&lt;/td>";
        $output .= "&lt;td>" . $row['productCode'] . "&lt;/td>";
        $output .= "&lt;td align='right'>" . $row['quantityOrdered'] . "&lt;/td>";
        $output .= "&lt;td align='right'>" . $row['priceEach'] . "&lt;/td>";
        $output .= "&lt;td align='right'>" . 
          $row['quantityOrdered'] * $row['priceEach'] . "&lt;/td>";
        $output .= "&lt;/tr>";
        
        $total_order += $row['quantityOrdered'] * $row['priceEach'];
        
    }
    
    $output .= "&lt;tr>".
               "&lt;td colspan='5' align='right'>Total:&lt;/td>".
               "&lt;td align='right'>".$total_order."&lt;/td>".
               "&lt;/tr>";

    $output .= "&lt;/table>";

    echo $output;
}
        </pre>
        
    </div>
    
</div>

<script>
    $(function () {

        var items = "";
        items += "<option value='' selected>-select order-</option>";
        $.getJSON("order_data_dropdown.php", function (data) {

            $.each(data, function (index, item)
            {
                items += "<option value='" + item.orderNumber + "'>" + item.orderNumber + "</option>";
            });
            $("#orders_dropdown").html(items);
        });

    });

    $(document).ready(function () {
        $('#orders_dropdown').change(function () {
            
            // get selected order number
            var order_id = $(this).val();
            
            // load order data
            $.ajax({
                url: "load_order_data.php",
                method: "POST",
                data: {order_id: order_id},
                success: function (data) {
                    $('#order').html(data);
                }
            });
            
            
            // load order details data
            $.ajax({
                url: "load_orderdetails_data.php",
                method: "POST",
                data: {order_id: order_id},
                success: function (data) {
                    $('#order_details').html(data);
                }
            });
        });
    });


</script>


<?php
include 'page_bot.php';
