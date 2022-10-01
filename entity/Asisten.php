<?php

class Asisten
{
    private $nrp;
    private $nama;
    private $no_telp;

    /**
     * @return mixed
     */
    public function getNrp()
    {
        return $this->nrp;
    }

    /**
     * @param mixed $nrp
     */
    public function setNrp($nrp): void
    {
        $this->nrp = $nrp;
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


}