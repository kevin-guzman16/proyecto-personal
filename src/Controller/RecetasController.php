<?php

namespace App\Controller;

use App\Entity\Receta;
use App\Form\ReceType;
use App\Repository\RecetaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecetasController extends AbstractController
{
    /**
     * @Route("/recetas", name="recetas")
     */
    public function index(RecetaRepository $r)
    {
        $recetas = $r->findAll();

        return $this->render('recetas/index.html.twig', [
            'lista_recetas' => $recetas,
        ]);
    }

    /**
     * @Route("/recetas/{id<\d+>}", name="receta-detalle")
     * @IsGranted("ROLE_USER")
     */
    public function detalle(Receta $receta)
    {
        return $this->render('recetas/detalle.html.twig', [
            'receta' => $receta,
        ]);
    }

    /**
     * @Route("/recetas/nueva", name="receta-nueva")
     * @IsGranted("ROLE_USER")
     */
    public function nueva(Request $request)
    {
        $receta = new Receta();
        $form = $this->createForm(ReceType::class, $receta);
        $form->handleRequest(($request));

        if ($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $img */
            $img = $form->get('imagenes')->getData();

            if ($img) {
                $originalFilename = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = $originalFilename.'-'.uniqid().'.'.$img->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $img->move(
                        $this->getParameter('imgs_directory'),
                        $newFilename
                    );
                    $entityManager = $this->getDoctrine()->getManager();

                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $receta->setImagenes($newFilename);
            }

                $entityManager->persist($receta);
                $entityManager->flush();

            return $this->redirect($this->generateUrl('recetas'));

        }

        return $this->render('recetas/nueva.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
