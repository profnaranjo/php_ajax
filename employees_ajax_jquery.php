<?php
/*
 * employees_ajax_jquery.php
 * 
 */

include("page_top.php");
?>

<div class="row">
    <h2>PHP Ajax Option 2: using JQuery</h2>
</div>

<div class="row">

    <div class="col-md-2">
        <h3>Employees</h3>
        <select id="emp_dropdown" size="10">
        </select>
    </div>

    <div class="col-md-10">
        <h3>Employee Details</h3>
        <div id="emp_details">
            Select an employee name from the list
        </div>
    </div>

</div>

<script>
    $(function () {

        var items = "";
        items += "<option value='' selected>-select employee-</option>";
        $.getJSON("employee_data_dropdown.php", function (data) {

            $.each(data, function (index, item)
            {
                items += "<option value='" + item.employeeNumber + "'>" + item.employee_name + "</option>";
            });
            $("#emp_dropdown").html(items);
        });

    });


    // on select change
    $(document).ready(function () {
        $('#emp_dropdown').change(function () {
            var emp_id = $(this).val();
            $.ajax({
                url: "load_data.php",
                method: "POST",
                data: {emp_id: emp_id},
                success: function (data) {
                    $('#emp_details').html(data);
                }
            });
        });
    });


</script>

<div class="row">
    
    <div class="col-md-6">
        <h3></h3>
    </div>
    
    <div class="col-md-6"></div>
    
</div>

<?php
include 'page_bot.php';
