<?php

namespace App\Controller;

use App\Entity\Jpo;
use App\Form\JpoFormType;
use App\Repository\JpoRepository;
use App\Repository\UserRepository;
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
    public function create(Request $request, EntityManagerInterface $entityManager ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_GOLD');
        $jpo = new Jpo();
        $jpo->setUser($this->getUser());
        $jpo->setCreatedAt(new \DateTimeImmutable());
        $jpo->setUpdatedAt(new \DateTimeImmutable());
        $form = $this->createForm(JpoFormType::class, $jpo);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jpo);
            $entityManager->flush();

            return $this->redirectToRoute('app_jpo', ['message'=> 'votre Journée porte ouverte a été ajouté']);
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

    #[Route('/jpo/suscribe/{jpo_id}', methods:['GET'], name: 'jpo_suscribe')]
    public function subscribe(int $jpo_id, UserRepository $userRepository, JpoRepository $jpoRepository, EntityManagerInterface $entityManager) {

        $jpo = $jpoRepository->find($jpo_id);
        $jpos = $jpoRepository->findAll();
        //augmente les points
        $user = $userRepository->find($this->getUser()->getId());

        $jpo->addUser($user);
        $user->addJpo($jpo);

        $places = $jpo->getPlaces();
        $places--;
        $jpo->setPlaces($places);



        $userPoints =  $user->getPoints();
        $user->setPoints($userPoints + 2);

        $user->getPoints() >= 10 ? $user->setRoles(['ROLE_ARGENT']) : null;

        $entityManager->persist($jpo);
        $entityManager->persist($user);

       /* $userRepository->save($user);
        $jpoRepository->save($jpo);*/

        $entityManager->flush();

        return $this->redirectToRoute('app_jpo');

    }




}
