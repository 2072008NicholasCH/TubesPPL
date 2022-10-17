<?php

class Connection
{
    public static function createConnection()
    {
        $conn = new PDO('mysql:host=34.126.99.40;dbname=beritaAcaraPerkuliahan', 'admindbs', '');
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
