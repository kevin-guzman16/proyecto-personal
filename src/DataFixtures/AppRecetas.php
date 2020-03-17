<?php

namespace App\DataFixtures;

use App\Entity\Receta;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppRecetas extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        /*$usuario = $manager->getRepository(User::class);
        $u = $usuario->findOneBy([
            'nombre' => 'Kevin'
        ]);*/

        $receta = new Receta();
        $receta->setNombre('Encebollado');
        $receta->setDescripcion('Comida típica de la costa ecuatoriana');
        $receta->setIngredientes("2 libras de atún fresco.". PHP_EOL .
        "1 libra de yuca fresca o congelada" . PHP_EOL .
        "2 cucharadas de aceite" . PHP_EOL .
        "2 tomates picados" . PHP_EOL .
        "½ cebolla picada" . PHP_EOL .
        "1 cucharadita de aji no picante en polvo se puede usar pimentón molido" . PHP_EOL .
        "2 cucharaditas de comino molido" . PHP_EOL .
        "8 tazas de agua" . PHP_EOL .
        "5 ramitas de cilantro o culantro" . PHP_EOL .
        "Sal al gusto");

        $receta->setPreparacion("1. Prepare un refrito con la cebolla, el tomate, al comino, el aji y la sal."  . PHP_EOL .
       "2. Añada el agua y las ramitas de cilantro.". PHP_EOL .
        "3. Añada el atún cuando el agua empiece a hervir, cocine hasta que el atún esté listo, aproximadamente unos 15 minutos." . PHP_EOL .
        "4. Cierna el caldo donde se cocinó el agua y guárdelo para cocinar la yuca." . PHP_EOL .
        "5. Separe el atún en lonjas, guarde para añadir más tarde." . PHP_EOL .
        "6. Haga hervir el caldo de atún y añada las yucas, cocine hasta que estén suaves." . PHP_EOL .
        "7. Saque las yucas y córtelos en pedazos pequeños." . PHP_EOL .
        "8. Vuelva a poner las yucas picadas y las lonjas de atún en el caldo, rectifique la sal y caliente hasta que esté listo para servir. Para darle más sabor, también se puede preparar una porción adicional de refrito y licuarlo con un poco del caldo, e incorporar esta mezcla a la sopa." . PHP_EOL .
        "9. Para servir el encebollado de pescado se pone una buena porción del curtido de cebolla y tomate encima de cada plato de sopa." . PHP_EOL .
        
        "Notas:" . PHP_EOL .
        "Puede preparar variaciones del encebollado mixto con camarones y otros mariscos." . PHP_EOL .
        "Se pueden agregar una variedad de hierbas diferentes para preparar el caldo, pero el culantro o cilantro es el principal."
        );

        $receta->setPais('Ecuador');
        $receta->setImagenes('encebollado.jpeg');
        //$receta->setUsuario($u);

        $manager->persist($receta);
        $manager->flush();


        $receta2 = new Receta();
        $receta2->setNombre('Paella');
        $receta2->setPais('España');
        $receta2->setDescripcion('Comida tipica española');
        $receta2->setImagenes('paella.jpeg');
        $receta2->setIngredientes('    400 gr de Arroz Brillante Sabroz
        200 grs. rape limpio cortado en dados
        200 grs. gambas peladas
        200 grs. almejas
        8 langostinos
        Caldo de pescado
        Sal
        Perejil
        1 cebolla picada fina
        1 zanahoria picada fina
        1 pimiento verde picado fino
        1 tomate picado fino
        2 dientes de ajo picados fino');

        $receta2->setPreparacion('En la paella (el recipiente para hacer el arroz), pochar o rehogar la verdura 5 minutos. Cuando esté bien pochada, añadir el pescado, las gambas, y las almejas. Rehogar bien e incorporar el arroz.
        Moverlo y agregar el caldo.
        Probar de sal y cuando empiece a hervir, poner encima los langostinos y dejar cocer 15 minutos a fuego suave hasta que este hecha.');

        $manager->persist($receta2);
        $manager->flush();
    }

}
