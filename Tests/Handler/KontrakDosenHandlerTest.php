<?php

namespace Ais\KontrakDosenBundle\Tests\Handler;

use Ais\KontrakDosenBundle\Handler\KontrakDosenHandler;
use Ais\KontrakDosenBundle\Model\KontrakDosenInterface;
use Ais\KontrakDosenBundle\Entity\KontrakDosen;

class KontrakDosenHandlerTest extends \PHPUnit_Framework_TestCase
{
    const DOSEN_CLASS = 'Ais\KontrakDosenBundle\Tests\Handler\DummyKontrakDosen';

    /** @var KontrakDosenHandler */
    protected $kontrak_dosenHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::DOSEN_CLASS));
    }


    public function testGet()
    {
        $id = 1;
        $kontrak_dosen = $this->getKontrakDosen();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($kontrak_dosen));

        $this->kontrak_dosenHandler = $this->createKontrakDosenHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $this->kontrak_dosenHandler->get($id);
    }

    public function testAll()
    {
        $offset = 1;
        $limit = 2;

        $kontrak_dosens = $this->getKontrakDosens(2);
        $this->repository->expects($this->once())->method('findBy')
            ->with(array(), null, $limit, $offset)
            ->will($this->returnValue($kontrak_dosens));

        $this->kontrak_dosenHandler = $this->createKontrakDosenHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $all = $this->kontrak_dosenHandler->all($limit, $offset);

        $this->assertEquals($kontrak_dosens, $all);
    }

    public function testPost()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $kontrak_dosen = $this->getKontrakDosen();
        $kontrak_dosen->setTitle($title);
        $kontrak_dosen->setBody($body);

        $form = $this->getMock('Ais\KontrakDosenBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($kontrak_dosen));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->kontrak_dosenHandler = $this->createKontrakDosenHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $kontrak_dosenObject = $this->kontrak_dosenHandler->post($parameters);

        $this->assertEquals($kontrak_dosenObject, $kontrak_dosen);
    }

    /**
     * @expectedException Ais\KontrakDosenBundle\Exception\InvalidFormException
     */
    public function testPostShouldRaiseException()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $kontrak_dosen = $this->getKontrakDosen();
        $kontrak_dosen->setTitle($title);
        $kontrak_dosen->setBody($body);

        $form = $this->getMock('Ais\KontrakDosenBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->kontrak_dosenHandler = $this->createKontrakDosenHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $this->kontrak_dosenHandler->post($parameters);
    }

    public function testPut()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $kontrak_dosen = $this->getKontrakDosen();
        $kontrak_dosen->setTitle($title);
        $kontrak_dosen->setBody($body);

        $form = $this->getMock('Ais\KontrakDosenBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($kontrak_dosen));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->kontrak_dosenHandler = $this->createKontrakDosenHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $kontrak_dosenObject = $this->kontrak_dosenHandler->put($kontrak_dosen, $parameters);

        $this->assertEquals($kontrak_dosenObject, $kontrak_dosen);
    }

    public function testPatch()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('body' => $body);

        $kontrak_dosen = $this->getKontrakDosen();
        $kontrak_dosen->setTitle($title);
        $kontrak_dosen->setBody($body);

        $form = $this->getMock('Ais\KontrakDosenBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($kontrak_dosen));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->kontrak_dosenHandler = $this->createKontrakDosenHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $kontrak_dosenObject = $this->kontrak_dosenHandler->patch($kontrak_dosen, $parameters);

        $this->assertEquals($kontrak_dosenObject, $kontrak_dosen);
    }


    protected function createKontrakDosenHandler($objectManager, $kontrak_dosenClass, $formFactory)
    {
        return new KontrakDosenHandler($objectManager, $kontrak_dosenClass, $formFactory);
    }

    protected function getKontrakDosen()
    {
        $kontrak_dosenClass = static::DOSEN_CLASS;

        return new $kontrak_dosenClass();
    }

    protected function getKontrakDosens($maxKontrakDosens = 5)
    {
        $kontrak_dosens = array();
        for($i = 0; $i < $maxKontrakDosens; $i++) {
            $kontrak_dosens[] = $this->getKontrakDosen();
        }

        return $kontrak_dosens;
    }
}

class DummyKontrakDosen extends KontrakDosen
{
}
