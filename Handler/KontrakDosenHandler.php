<?php

namespace Ais\KontrakDosenBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Ais\KontrakDosenBundle\Model\KontrakDosenInterface;
use Ais\KontrakDosenBundle\Form\KontrakDosenType;
use Ais\KontrakDosenBundle\Exception\InvalidFormException;

class KontrakDosenHandler implements KontrakDosenHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a KontrakDosen.
     *
     * @param mixed $id
     *
     * @return KontrakDosenInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of KontrakDosens.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new KontrakDosen.
     *
     * @param array $parameters
     *
     * @return KontrakDosenInterface
     */
    public function post(array $parameters)
    {
        $kontrak_dosen = $this->createKontrakDosen();

        return $this->processForm($kontrak_dosen, $parameters, 'POST');
    }

    /**
     * Edit a KontrakDosen.
     *
     * @param KontrakDosenInterface $kontrak_dosen
     * @param array         $parameters
     *
     * @return KontrakDosenInterface
     */
    public function put(KontrakDosenInterface $kontrak_dosen, array $parameters)
    {
        return $this->processForm($kontrak_dosen, $parameters, 'PUT');
    }

    /**
     * Partially update a KontrakDosen.
     *
     * @param KontrakDosenInterface $kontrak_dosen
     * @param array         $parameters
     *
     * @return KontrakDosenInterface
     */
    public function patch(KontrakDosenInterface $kontrak_dosen, array $parameters)
    {
        return $this->processForm($kontrak_dosen, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param KontrakDosenInterface $kontrak_dosen
     * @param array         $parameters
     * @param String        $method
     *
     * @return KontrakDosenInterface
     *
     * @throws \Ais\KontrakDosenBundle\Exception\InvalidFormException
     */
    private function processForm(KontrakDosenInterface $kontrak_dosen, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new KontrakDosenType(), $kontrak_dosen, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $kontrak_dosen = $form->getData();
            $this->om->persist($kontrak_dosen);
            $this->om->flush($kontrak_dosen);

            return $kontrak_dosen;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createKontrakDosen()
    {
        return new $this->entityClass();
    }

}
