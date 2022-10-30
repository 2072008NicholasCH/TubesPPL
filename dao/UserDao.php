<?php

class UserDao
{

    public function read($idUser, $password)
    {
        $conn = Connection::createConnection();
        $query = 'SELECT * FROM user WHERE idUser = ? AND password = MD5(?)';
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $idUser);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        return $stmt->fetchObject('User');
    }

    public function readAllDosen($id)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM user WHERE role_idRole = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchAll();
    }
    
    public function readOneDosen($id)
    {
        $conn = Connection::createConnection();
        $query = "SELECT * FROM user WHERE idUser = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $conn = Connection::close($conn);
        return $stmt->fetchObject('User');
    }

}