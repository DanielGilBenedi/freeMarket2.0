<?php

namespace App\Controller;

use App\Entity\Marcas;
use App\Form\MarcasType;
use App\Repository\MarcasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marcas")
 */
class MarcasController extends AbstractController
{
    /**
     * @Route("/", name="marcas_index", methods={"GET"})
     */
    public function index(MarcasRepository $marcasRepository): Response
    {
        return $this->render('marcas/index.html.twig', [
            'marcas' => $marcasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="marcas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $marca = new Marcas();
        $form = $this->createForm(MarcasType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imagen']->getData();

            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/marcas';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_BASENAME);

                $uploadedFile->move(
                    $destination,
                    $originalFilename
                );
                $marca->setImagen($originalFilename);
                $marca->setFecha(new \DateTime("now"));
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marca);
            $entityManager->flush();

            return $this->redirectToRoute('marcas_index');
        }

        return $this->render('marcas/new.html.twig', [
            'marca' => $marca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="marcas_show", methods={"GET"})
     */
    public function show(Marcas $marca): Response
    {
        return $this->render('marcas/show.html.twig', [
            'marca' => $marca,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="marcas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Marcas $marca): Response
    {
        $form = $this->createForm(MarcasType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('marcas_index');
        }

        return $this->render('marcas/edit.html.twig', [
            'marca' => $marca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="marcas_delete", methods={"POST"})
     */
    public function delete(Request $request, Marcas $marca): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marca->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($marca);
            $entityManager->flush();
        }

        return $this->redirectToRoute('marcas_index');
    }
}
