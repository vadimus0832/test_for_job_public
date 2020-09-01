<?

class DBaseObj {
    
    private $connect;
    
    function __construct(object $connect) {
       $this->connect = $connect;
    }
    
    function getData(array $filter = array(), array $select = array()) {
        if (!$select) {
            $sql_select = " * ";
        } else {
            $sql_select = " ";
            foreach ($select as $value) {
                $sql_select = $sql_select."`".$value."`,";
            }
            $sql_select[strlen($sql_select)-1] = " ";
        }
        
        if (!$filter) {
            $sql_filter = "";
        } else {
            $sql_filter = " WHERE ";
            foreach ($filter as $field => $value) {
                if (is_array($value)) {
                    strlen($sql_filter) > 7 ? $sql_filter." AND ": $sql_filter.""; 
                    $sql_filter = $sql_filter.$field." IN (";
                    foreach ($value as $znach) {
                        $sql_filter = $sql_filter.$znach.",";
                    }
                    $sql_filter[strlen($sql_filter)-1] = ") ";
                } else {
                    strlen($sql_filter) > 7 ? $sql_filter." AND ": $sql_filter.""; 
                    $sql_filter = $sql_filter.$field." = ".$value." ";
                }
            }
        }
        
        $sql_query = "SELECT ".$sql_select." FROM test".$sql_filter.";";
        $resData = mysqli_query($this->connect, $sql_query);
        $result = array();
        
        while ($row = mysqli_fetch_array($resData)) {
            $result[] = $row;
        }
        
        return $result;
        
    }
    
    public function __destruct() {
        echo mysqli_close($this->connect) ? "Connection close<br />" : mysqli_connect_error();
    }
    
}