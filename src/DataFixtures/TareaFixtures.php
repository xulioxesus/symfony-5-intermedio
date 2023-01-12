<?php

namespace App\DataFixtures;

use App\Entity\Tarea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TareaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 20; $i++) { 
            $tarea = new Tarea();
            $tarea->setDescripcion("Tarea de prueba admin - $i");
            $tarea->setUsuario($this->getReference(UserFixtures::USUARIO_ADMIN_REFERENCIA));
            $tarea->setFinalizada(false);
            $manager->persist($tarea);
        }

        for ($i=0; $i < 20; $i++) { 
            $tarea = new Tarea();
            $tarea->setDescripcion("Tarea de prueba user - $i");
            $tarea->setUsuario($this->getReference(UserFixtures::USUARIO_USER_REFERENCIA));
            $tarea->setFinalizada(false);
            $manager->persist($tarea);
        }

        $manager->flush();
    }

    public function getDependencies(){
        return [UserFixtures::class,];
    }
}
