<?php

class Connection
{
    public static function createConnection()
    {
        $conn = new PDO('mysql:host=18.143.100.149;dbname=beritaacaraperkuliahan', 'admindbs', '');
        $conn->setAttribute(attribute: PDO::ATTR_AUTOCOMMIT, value: false);
        $conn->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public static function close($conn)
    {
        if ($conn != null) {
            $conn = null;
        }
        return $conn;
    }
}
