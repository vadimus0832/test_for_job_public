<? 

$connect = mysqli_connect("localhost", "root", "");

if (version_compare(mysqli_get_server_info($connect), "5.7.8") <= -1) { // check mysql version
    echo "Update your mysql to 5.7.8 & better<br />";
    echo mysqli_close($connect) ? "Connection close<br />" : mysqli_connect_error();
    die;
}

echo $connect ? "Connection complite<br />" : mysqli_connect_error();

mysqli_set_charset($connect, "utf8");

$query_new_db = file_get_contents("sql/db_test.sql", FILE_USE_INCLUDE_PATH);

echo mysqli_query($connect, $query_new_db) ? $query_new_db.": <div style='color: green;'>Complite</div><br />" : mysqli_error($connect); // create data base

$query_new_table = file_get_contents("sql/table_test.sql", FILE_USE_INCLUDE_PATH);

echo mysqli_query($connect, $query_new_table) ? $query_new_table.": <div style='color: green;'>Complite</div><br />" : mysqli_error($connect); // create table

//$query_new_data = file_get_contents("sql/table_test_data.sql", FILE_USE_INCLUDE_PATH);

//echo mysqli_query($connect, $query_new_data) ? $query_new_data.": <div style='color: green;'>Complite</div><br />" : mysqli_error($connect); // create add data

echo mysqli_close($connect) ? "Connection close<br />" : mysqli_connect_error();

?>