<?php

namespace App\Controller;

use App\Repository\RecetaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    /**
     * @Route("/perfil/", name="perfil")
     * @IsGranted("ROLE_USER");
     */
    public function index(RecetaRepository $recetas)
    {
        $r = $recetas->findAll();
        return $this->render('perfil/index.html.twig', [
            'recetas' => $r,
        ]);
    }
}
