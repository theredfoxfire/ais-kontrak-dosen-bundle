<?php

namespace Ais\KontrakDosenBundle\Model;

Interface KontrakDosenInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set matakuliahId
     *
     * @param integer $matakuliahId
     *
     * @return KontrakDosen
     */
    public function setMatakuliahId($matakuliahId);

    /**
     * Get matakuliahId
     *
     * @return integer
     */
    public function getMatakuliahId();

    /**
     * Set dosenId
     *
     * @param integer $dosenId
     *
     * @return KontrakDosen
     */
    public function setDosenId($dosenId);

    /**
     * Get dosenId
     *
     * @return integer
     */
    public function getDosenId();

    /**
     * Set semesterId
     *
     * @param integer $semesterId
     *
     * @return KontrakDosen
     */
    public function setSemesterId($semesterId);

    /**
     * Get semesterId
     *
     * @return integer
     */
    public function getSemesterId();

    /**
     * Set kelasId
     *
     * @param integer $kelasId
     *
     * @return KontrakDosen
     */
    public function setKelasId($kelasId);

    /**
     * Get kelasId
     *
     * @return integer
     */
    public function getKelasId();

    /**
     * Set maxSiswa
     *
     * @param integer $maxSiswa
     *
     * @return KontrakDosen
     */
    public function setMaxSiswa($maxSiswa);

    /**
     * Get maxSiswa
     *
     * @return integer
     */
    public function getMaxSiswa();

    /**
     * Set filterId
     *
     * @param integer $filterId
     *
     * @return KontrakDosen
     */
    public function setFilterId($filterId);

    /**
     * Get filterId
     *
     * @return integer
     */
    public function getFilterId();

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return KontrakDosen
     */
    public function setIsActive($isActive);

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return KontrakDosen
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
}
