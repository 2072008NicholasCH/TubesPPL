<?php

class Semester implements JsonSerializable
{
    private $idSemester;
    private $nama;
    private $status;

    /**
     * @return mixed
     */
    public function getIdSemester()
    {
        return $this->idSemester;
    }

    /**
     * @param mixed $idSemester
     */
    public function setIdSemester($idSemester): void
    {
        $this->idSemester = $idSemester;
    }

    /**
     * @return mixed
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * @param mixed $nama
     */
    public function setNama($nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }



    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}