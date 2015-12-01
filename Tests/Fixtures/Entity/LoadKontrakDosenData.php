<?php

namespace Ais\KontrakDosenBundle\Tests\Fixtures\Entity;

use Ais\KontrakDosenBundle\Entity\KontrakDosen;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadKontrakDosenData implements FixtureInterface
{
    static public $kontrak_dosens = array();

    public function load(ObjectManager $manager)
    {
        $kontrak_dosen = new KontrakDosen();
        $kontrak_dosen->setTitle('title');
        $kontrak_dosen->setBody('body');

        $manager->persist($kontrak_dosen);
        $manager->flush();

        self::$kontrak_dosens[] = $kontrak_dosen;
    }
}
