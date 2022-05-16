<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/clients', name: 'clients-')]
#[isGranted('IS_AUTHENTICATED_FULLY')]

class ClientController extends AbstractController
{
    // DISPLAY ALL DEVELOPERS
    #[Route('/all-clients', name: 'all-clients')]
    #[IsGranted('ROLE_ADMIN')]
    public function allClients(ClientRepository $cr, Request $request)
    {
        // FIND ALL CLIENTS
        $clients = $cr->findAll();

        // ADD NEW CLIENT
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $cr->add($client, true);
            return $this->redirectToRoute('clients-all-clients');
        }
        // DISPLAY ALL CLIENTS
        return $this->render('client/all-clients.html.twig', ['clients' => $clients, 'form' => $form->createView()]);
    }

    // ADD CLIENT
    #[Route('/add-client', name: 'add-client')]
    #[IsGranted('ROLE_ADMIN')]
    public function addClient(ClientRepository $cr, Request $request)
    {
        // $client = new Client();
        // $form = $this->createForm(ClientType::class, $client);

        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $client = $form->getData();
        //     $cr->add($client);
        //     return $this->redirectToRoute('clients-all-clients');
        // }
        // return $this->render('client/all-clients.html.twig', ['form' => $form->createView()]);
    }
}
