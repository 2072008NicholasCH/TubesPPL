<?php

class ProgramStudiDao
{
    public function create()
    {

    }

    public function readAll()
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM program_studi";
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ProgramStudi");
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}