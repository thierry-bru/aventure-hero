<?php

namespace App\Controller;

use App\Entity\Aventure;
use App\Entity\Personnage;
use App\Form\PersonnageType;
use App\Entity\Partie;
use App\Form\PartieType;
use App\Repository\AventureRepository;
use App\Repository\EtapeRepository;
use App\Repository\PartieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PersonnageRepository;
use DateTime;

class JouerController extends AbstractController
{
    #[Route('/jouer', name: 'jouer')]
    public function index(AventureRepository $aventureRepository, PersonnageRepository $personnageRepository): Response
    {
        $aventuresJouables = $aventureRepository->findAll();
        $personnagesJouables = $personnageRepository->findAll();
        return $this->render('jouer/index.html.twig', [
            'controller_name' => 'JouerController','aventuresJouables'=>$aventuresJouables,'personnagesJouables'=>$personnagesJouables
        ]);
    }
    #[Route('/jouer/{idPartie}/', name: 'jouer_une_aventure')]
    public function jouer(PartieRepository$partieRepository, $idPartie): Response
        {
        $partie = $partieRepository->find($idPartie);
        $aventure = $partie->getAventure();
        $personnage = $partie->getPersonnage();
        return $this->render('jouer/start.html.twig', ['partie'=>$partie,'aventure'=>$aventure,'personnage'=>$personnage
        ]);
    }
    #[Route('/creer', name: 'creer_perso', methods: ['GET', 'POST'])]
    public function creerPersonnage(Request $request, PersonnageRepository $personnageRepository): Response
    {
        $personnage = new Personnage();
        $form = $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnageRepository->save($personnage, true);

            return $this->redirectToRoute('jouer', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jouer/new_personnage.html.twig', [
            'personnage' => $personnage,
            'form' => $form,
        ]);
    }
    #[Route('/jouer/creer/{idAventure}/{idPersonnage}', name: 'creer_partie', methods: ['GET', 'POST'])]
    public function creerPartie(AventureRepository $aventureRepository, PersonnageRepository $personnageRepository, PartieRepository $partieRepository,$idAventure,$idPersonnage): Response
    {
        $partie = new Partie();
        $aventure = $aventureRepository->find($idAventure);
        $personnage = $personnageRepository->find($idPersonnage);
        $partie->setDate(new DateTime());
        $partie->setEtape($aventure->getPremiereEtape());
        $partie->setEndurance(10);
        $partie->setPersonnage($personnage);
        $partie->setAventure($aventure);
        $partieRepository->save($partie, true);
        return $this->redirectToRoute('jouer_une_aventure', ['idPartie'=>$partie->getId()], Response::HTTP_SEE_OTHER);

    }
    #[Route('/jouer/demarrer/{idPartie}', name: 'jouer_partie', methods: ['GET', 'POST'])]
    public function jouerPartie( PartieRepository $partieRepository,$idPartie): Response
    {
        $partie = $partieRepository->find($idPartie);
        $aventure = $partie->getAventure();
        $personnage =$partie->getPersonnage();
        $etape = $partie->getEtape();
        return $this->render('jouer/etape.html.twig', [
            'partie'=>$partie,'aventure'=>$aventure,'partie'=>$partie,'etape'=>$etape,'personnage' => $personnage,
        ]);

    }
    #[Route('/jouer/etape/{idPartie}/{idEtape}', name: 'jouer_etape', methods: ['GET', 'POST'])]
    public function jouerEtape(AventureRepository $aventureRepository, PersonnageRepository $personnageRepository, PartieRepository $partieRepository,EtapeRepository $etapeRepository,$idPartie,$idEtape): Response
    {
        $partie = $partieRepository->find($idPartie);
        $etape = $etapeRepository->find($idEtape);
        $partie->setEtape($etape);
        $partieRepository->save($partie);
        $aventure = $aventureRepository->find($partie->getAventure());
        $personnage = $personnageRepository->find($partie->getPersonnage());
        $etape = $etapeRepository->find($partie->getEtape());
        if ( $etape->getId()==$aventure->getEtapeFinale()->getId())
            return $this->redirectToRoute('finir_une_aventure', ['idPartie'=>$partie->getId()], Response::HTTP_SEE_OTHER);
        return $this->render('jouer/etape.html.twig', [
            'partie'=>$partie,'aventure'=>$aventure,'partie'=>$partie,'etape'=>$etape,'personnage' => $personnage,
        ]);

    }
    #[Route('/jouer/finir/{idPartie}/', name: 'finir_une_aventure')]
    public function finir(PartieRepository$partieRepository, $idPartie): Response
        {
        $partie = $partieRepository->find($idPartie);
        $aventure = $partie->getAventure();
        $personnage = $partie->getPersonnage();
        return $this->render('jouer/end.html.twig', ['partie'=>$partie,'aventure'=>$aventure,'personnage'=>$personnage
        ]);
    }
}
