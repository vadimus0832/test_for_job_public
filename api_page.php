<? 

include "filter.php";

$connect = mysqli_connect("localhost", "root", "", "test");

$page = $_GET['page'];
$limit = $_GET['limit'];
$offset = ($page-1) * $limit;

echo $connect ? "Connection complite<br />" : mysqli_connect_error();

$arVals = $jsonRes = $resData = array();

$sql_query = "SELECT * FROM test LIMIT ".$limit." OFFSET ".$offset;

$resData = mysqli_query($connect, $sql_query); 

$jsonRes["status"] = $resData ? 1 : 0;

$jsonRes["error"] = mysqli_error($connect);

while ($row = mysqli_fetch_array($resData)) {
    if (!$jsonRes["data"]["head"]) {
        $jsonRes["data"]["head"] = array_values(array_keys(mysqli_fetch_array($resData)));
    }
    $jsonRes["data"]["body"][] = array_values($row);
    
}

echo json_encode($jsonRes);

$obj = new DBaseObj($connect);

echo "<pre>";
print_r($obj->getData(array('id' => Array(21,34)), array(), $connect));
echo "</pre>";

?>