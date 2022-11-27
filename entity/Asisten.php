<?php

class Asisten
{
    private $idAsistenDosen;
    private $nama;
    private $no_telp;
    private $status;

    /**
     * @return mixed
     */
    public function getidAsistenDosen()
    {
        return $this->idAsistenDosen;
    }

    /**
     * @param mixed $idAsistenDosen
     */
    public function setidAsistenDosen($idAsistenDosen): void
    {
        $this->idAsistenDosen = $idAsistenDosen;
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
    public function getNoTelp()
    {
        return $this->no_telp;
    }

    /**
     * @param mixed $no_telp
     */
    public function setNoTelp($no_telp): void
    {
        $this->no_telp = $no_telp;
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


}