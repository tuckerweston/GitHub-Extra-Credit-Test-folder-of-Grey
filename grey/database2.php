<?php include 'include/config.php'; ?>
<?php include 'include/header.php'; ?>
<h1>Our Second Database Page</h1> 
<p>Cool database stuff about Beer!</p>
<?php
$sql = "select * from Beers";

$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_error()));
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));
?>

<html>
<head>
<title>Beer Data</title>
</head>

<body>

<table width="600" border="1" cellpadding="1" cellspacing="1">
<tr>

<th>Beer #</th>
<th>Beer</th>
<th>Category</th>
<th>Style</th>
<th>Brewer</th>
<th>Appearance</th>
<th>Description</th>
<th>Alchohol Content</th>
<th>Calories</th>
<tr>

<?php

if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
    while ($row = mysqli_fetch_assoc($result))
    {
       echo "<tr>";
	   echo "<td>" . $row['BeerID'] . "</td>";
       echo "<td>" . $row['Beer'] . "</td>";
       echo "<td>" . $row['Category'] . "</td>";
       echo "<td>" . $row['Style'] . "</td>";
	   echo "<td>" . $row['Brewer'] . "</td>";
	   echo "<td>" . $row['Appearance'] . "</td>";
	   echo "<td>" . $row['Description'] . "</td>";
	   echo "<td>" . $row['AlcoholContent'] . "</td>";
	   echo "<td>" . $row['Calories'] . "</td>";
       echo "</tr>";
    }
}else{//no records
    echo '<div align="center">What! No customers?  There must be a mistake!!</div>';
}

?>

</table>
</body>
</html>

<?php include 'include/footer.php'; ?>
