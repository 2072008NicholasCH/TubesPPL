<?php

class UserDao
{

    public function read($idUser, $password)
    {
        $conn = Connection::createConnection();
        $query = 'SELECT * FROM user WHERE idUser = ? AND password = ?';
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $idUser);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        return $stmt->fetchObject('User');
    }

}