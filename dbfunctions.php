<?php

// echo "asdsadasdasdsa";

// Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=hbz user=postgres password=postgres");
    // or die('Could not connect: ' . pg_last_error());

// Performing SQL query
$query = "SELECT name FROM Program";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    foreach ($line as $col_value) {
        echo "$col_value";
    }
}
echo "\n";

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);

?>