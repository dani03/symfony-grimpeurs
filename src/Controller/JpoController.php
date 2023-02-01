<?php

namespace App\Controller;

use App\Entity\Jpo;
use App\Form\JpoFormType;
use App\Repository\JpoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JpoController extends AbstractController
{


    public function __construct(public JpoRepository $jpoRepository)
    {

    }

    #[Route('/', name: 'app_jpo')]
    public function index(): Response
    {
        $jpos = $this->jpoRepository->findAll();
        return $this->render('jpo/index.html.twig', ["jpos" => $jpos]);
    }

    #[Route('/jpo/create', name: 'jpo_create')]
    public function create(Request $request): Response
    {
        $jpo = new Jpo();
        $form = $this->createForm(JpoFormType::class, $jpo);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            dd($form->isSubmitted(), $request);
        }
        return $this->render('jpo/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/jpo/{id}', methods:['GET'], name: 'jpo_show')]
    public function show(int $id): Response
    {
        $jpo = $this->jpoRepository->find($id);
        return $this->render('jpo/show.html.twig', ["jpo" => $jpo]);

    }




}
