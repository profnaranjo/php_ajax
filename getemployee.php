<?php

$q = intval($_GET['q']);

include 'config.php';

$sql = "SELECT t.* FROM employees t where t.employeeNumber = '" . $q . "'";

$result = mysqli_query($conn, $sql);

echo "<table class='table table-bordered'>
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
    echo "<tr>";
    echo "<td>" . $row['employeeNumber'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['extension'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['officeCode'] . "</td>";
    echo "<td>" . $row['reportsTo'] . "</td>";
    echo "<td>" . $row['jobTitle'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
