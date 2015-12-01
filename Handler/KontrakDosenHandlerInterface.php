<?php

namespace Ais\KontrakDosenBundle\Handler;

use Ais\KontrakDosenBundle\Model\KontrakDosenInterface;

interface KontrakDosenHandlerInterface
{
    /**
     * Get a KontrakDosen given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return KontrakDosenInterface
     */
    public function get($id);

    /**
     * Get a list of KontrakDosens.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post KontrakDosen, creates a new KontrakDosen.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return KontrakDosenInterface
     */
    public function post(array $parameters);

    /**
     * Edit a KontrakDosen.
     *
     * @api
     *
     * @param KontrakDosenInterface   $kontrak_dosen
     * @param array           $parameters
     *
     * @return KontrakDosenInterface
     */
    public function put(KontrakDosenInterface $kontrak_dosen, array $parameters);

    /**
     * Partially update a KontrakDosen.
     *
     * @api
     *
     * @param KontrakDosenInterface   $kontrak_dosen
     * @param array           $parameters
     *
     * @return KontrakDosenInterface
     */
    public function patch(KontrakDosenInterface $kontrak_dosen, array $parameters);
}
