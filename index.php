<?php
// top of all pages
include("page_top.php");
?>
<div class="row">
    <h2>PHP Ajax Option 1: XMLHttpRequest()</h2>
    <p>I'm using the classicmodels database (MySQL), table employees. Option 1, using the <code>XMLHttpRequest()</code> method...</p>
</div>

<div class="row">
    <div class="col-md-2">   
        <h3>Employees</h3>
        <?php
        $sql = "SELECT t.employeeNumber, concat(t.lastName, ', ', t.firstName) employee_name
                FROM employees t
                order by 2";
        $result = mysqli_query($conn, $sql);

        echo "<select name='employees' onchange='showEmployee(this.value)' size='10' class='form-control'>";
        echo "<option value='' selected>-employee-</option>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['employeeNumber'] . "'>" . $row['employee_name'] . "</option>";
        }
        echo "</select>";
        ?>
    </div>
    <div class="col-md-10">
        <h3>Employee Details</h3>
        <div id="emp_details">
            Select an employee name from the list
        </div>
    </div>

</div>




<div class="row">

    <div class="col-md-6">
        <br>
        <pre>
-- Database Code for the dropdown

SELECT t.employeeNumber, 
       concat(t.lastName, ', ', t.firstName) employee_name
FROM employees t
order by 2
        </pre>

        <br>

        <pre>
-- Database Code for the employee details
-- with the passed employeeNumber

SELECT t.*
FROM employees t
where t.employeeNumber = 2000
        </pre>
    </div>

    <div class="col-md-6">
        <br>
        <pre>
// JavaScript Code to get employee details

function showEmployee(str) {
  if (str == "") {
    document.getElementById("emp_details").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("emp_details").innerHTML = 
          this.responseText;
      }
    };
    xmlhttp.open("GET", "getemployee.php?q=" + str, true);
    xmlhttp.send();
  }
}
        </pre>
    </div>

</div>

<div class="row">

    <h3>getemployee.php code</h3>
    <pre>
&lt;?php
$q = intval($_GET['q']);

include 'config.php';

$sql = "SELECT t.* FROM employees t where t.employeeNumber = '" . $q . "'";

$result = mysqli_query($conn, $sql);

echo "&lt;table class='table table-bordered'>
    &lt;tr>
        &lt;th width='45'>ID&lt;/th>
        &lt;th width='110'>Lastname&lt;/th>
        &lt;th width='110'>Firstname&lt;/th>
        &lt;th width='80'>Ext&lt;/th>
        &lt;th width='260'>Email&lt;/th>
        &lt;th width='100'>Off Code&lt;/th>
        &lt;th width='100'>Reports To&lt;/th>
        &lt;th width='220'>Title&lt;/th>
    &lt;/tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "&lt;tr>";
    echo "&lt;td>" . $row['employeeNumber'] . "&lt;/td>";
    echo "&lt;td>" . $row['lastName'] . "&lt;/td>";
    echo "&lt;td>" . $row['firstName'] . "&lt;/td>";
    echo "&lt;td>" . $row['extension'] . "&lt;/td>";
    echo "&lt;td>" . $row['email'] . "&lt;/td>";
    echo "&lt;td>" . $row['officeCode'] . "&lt;/td>";
    echo "&lt;td>" . $row['reportsTo'] . "&lt;/td>";
    echo "&lt;td>" . $row['jobTitle'] . "&lt;/td>";
    echo "&lt;/tr>";
}
echo "&lt;/table>";
mysqli_close($conn);
    </pre>
</div>



<?php
// top of all pages
include("page_bot.php");
