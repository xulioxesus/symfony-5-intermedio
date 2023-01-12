<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USUARIO_ADMIN_REFERENCIA = 'user-admin';
    public const USUARIO_USER_REFERENCIA = 'user-user';
    private $upei;

    public function __construct(UserPasswordEncoderInterface $upei){
        $this->upei = $upei;
    }

    public function load(ObjectManager $manager): void
    {
        $usuario = new User();
        $usuario->setEmail('admin@admin.com');
        $usuario->setRoles(['ROLE_ADMIN']);
        $usuario->setPassword($this->upei->encodePassword($usuario,'admin'));
        $manager->persist($usuario);
        $manager->flush();
        $this->addReference(self::USUARIO_ADMIN_REFERENCIA, $usuario);

        $usuario = new User();
        $usuario->setEmail('user@admin.com');
        $usuario->setRoles(['ROLE_USER']);
        $usuario->setPassword($this->upei->encodePassword($usuario,'admin'));
        $manager->persist($usuario);
        $manager->flush();
        $this->addReference(self::USUARIO_USER_REFERENCIA, $usuario);
    }
}
