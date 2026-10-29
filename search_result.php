<?php
require_once "settings.php";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Unable to connect to the database.");
}

if (isset($_GET['model']) && trim($_GET['model']) !== "") {
    $model = mysqli_real_escape_string($conn, trim($_GET['model']));

    $sql = "SELECT * FROM cars WHERE model LIKE '%$model%'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        echo "<h1>Search Results</h1>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Make</th><th>Model</th>";
        echo "<th>Price</th><th>Year</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" .htmlspecialchars ($row['car_id'])."</td>";
            echo "<td>".htmlspecialchars ($row['make'])."</td>";
            echo "<td>".htmlspecialchars ($row['model'])."</td>";
            echo "<td>".htmlspecialchars ($row['price'])."</td>";
            echo "<td>".htmlspecialchars ($row['yom'])."</td>";
            echo "</tr>";
        }

        echo "</table>";
        mysqli_free_result($result);
    }else{
        echo "No matching cars found.";
    }
}else{
    echo "Please enter a model to search.";
}

echo '<p><a
href="search_form.php">Search again</a></p>';

mysqli_close($conn);
?>
