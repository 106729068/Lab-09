<?php
require_once "settings.php";

$dbconn = mysqli_connect($host, $user, $pwd, $sql_db);

if(!$dbconn) {
    die("Unable to connect to the database: ". mysqli_connect_error());
}

$query = "SELECT * FROM cars";
$result = mysqli_query($dbconn,$query);
?>

<!DOCTYOE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Used Cars</h1>

    <?php if ($result && mysqli_num_rows($result) > 0) {?>
        <table border="1">
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Year of Manufacture</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>". $row['car_id'] ."</td>";
                    echo "<td>". $row['make'] . "</td>";
                    echo "<td>". $row['model'] . "</td>";
                    echo "<td>". $row['price'] . "</td>";
                    echo "<td>". $row['yom'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php } else { ?>
            <p>There are no cars to display.</p>
        <?php } ?>
</body>
</html>

<?php
mysqli_free_result($result);
mysqli_close($dbconn);
?>