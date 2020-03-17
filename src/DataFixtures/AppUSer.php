<?php

namespace App\DataFixtures;

use App\Entity\Receta;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

class AppUSer extends Fixture
{
    private $encode_password;

    public function __construct(UserPasswordEncoderInterface $encode_password)
    {
        $this->encode_password = $encode_password;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $recetas = $manager->getRepository(Receta::class);
        $r = $recetas->findOneBy([
            'nombre' => 'Encebollado'
        ]);

        $r2 = $recetas->findOneBy([
            'nombre' => 'Paella'
        ]);

        $usuario = new User();
        $usuario->setNombre('Kevin');
        $usuario->setApellidos('Guzmán');
        $usuario->setPassword($this->encode_password->encodePassword($usuario, '1234'));
        $usuario->setEmail('kevin@gmail.com');
        $usuario->setEdad(19);
        $usuario->setRoles(['ROLE_USER']);
        $usuario->addReceta($r);

        $manager->persist($usuario);
        $manager->flush();

        $usuario2 = new User();
        $usuario2->setNombre('Cecilia');
        $usuario2->setApellidos('Pazmiño');
        $usuario2->setEmail('cecilia@gmail.com');
        $usuario2->setRoles(["ROLE_USER"]);
        $usuario2->setEdad(49);
        $usuario2->setPassword($this->encode_password->encodePassword($usuario2, '1234'));
        $usuario2->addReceta($r2);

        $manager->persist($usuario2);
        $manager->flush();
    }
}
