<?php

namespace App\Controller;

use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Ticket;
use App\Form\TicketType;

final class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(Request $request, EntityManagerInterface $em, StatusRepository $statusRepository): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $defaultStatus = $statusRepository->findByOne(['name' => 'Nouveau']);
            $ticket->setStatus($defaultStatus);
            $em->persist($ticket);
            $em->flush();
            $this->addFlash('success','Votre ticket a bien été enregistré.');
            return $this->redirectToRoute('app_home');
        }
    
    
        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
