<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class RoomsController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Environment $twig, RoomsRepository $roomsRepository): Response
    {
        return new Response($twig->render('Rooms/index.html.twig', [
            'rooms' => $roomsRepository->findAll(),
        ]));
    }
}