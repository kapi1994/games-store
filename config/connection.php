<?php



try {
    require 'config.php';
    $connection = new PDO("mysql:host=" . MYSQLHOST . ';dbname=' . DBNAME, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException  $ex) {
    echo $ex->getMessage();
}
logPages();

function logPages()
{
    $path = PAGE_LOG_DOCS;
    $file = fopen($path, "a");
    if ($file) {
        $date = date("d-m-y H:i:s");
        $ip = $_SERVER["REMOTE_ADDR"];
        $path = $_SERVER['PHP_SELF'];
        $query = $_SERVER['QUERY_STRING'];
        $data = "{$path}?{$query}\t{$date}\t{$ip}\n";
        fwrite($file, $data);
        fclose($file);
    }
}
