<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    #[Route("/get/{nom}", name:"club_getNom")]
    public function getNom(string $nom): Response
    {
        return $this->render('club/detail.html.twig', [
            'nom' => $nom
        ]);
    }

    #[Route("/list", name:"club_list")]
    public function list(): Response
    {
        $clubs = [ ["name" => "AIESEC", "inscriptionDate"=> "09/09/2022", "openSpots" => '50'], 
                    ["name" => "ENACTUS", "inscriptionDate"=> "30/09/2022", "openSpots" => '0'],  
                    ["name" => "AUTO CLUB", "inscriptionDate"=> "12/09/2022", "openSpots" => '30']       
        ];
        return $this->render('club/list.html.twig', [
            'clubs' => $clubs
        ]);
    }
}
