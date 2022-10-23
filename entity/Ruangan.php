<?php

class Ruangan
{
    private $idRuangan;
    private $nama;

    /**
     * @return mixed
     */
    public function getIdRuangan()
    {
        return $this->idRuangan;
    }

    /**
     * @param mixed $idRuangan
     */
    public function setIdRuangan($idRuangan): void
    {
        $this->idRuangan = $idRuangan;
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


}