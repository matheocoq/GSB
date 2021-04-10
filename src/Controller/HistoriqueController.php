<?php

namespace App\Controller;
use App\Entity\Etat;
use App\Entity\Forfaitaire;
use App\Entity\HorsForfait;
use App\Entity\Type;
use App\Entity\FicheFrais;
use App\Entity\Visiteur;
use App\Form\FicheType;
use App\Form\ForfaitaireType;
use App\Form\HorsForfaitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HistoriqueController extends AbstractController
{
    /**
     * @Route("/historique", name="historique")
     */
    public function index(Request $request): Response
    {
        //$cookies = $request->cookies;
        //$iduser=$cookies->get('id');
        //$iduser='root';
        $iduser=$this->getUser()->getIdentifiant();
        if( $_POST)
        {
        $repository= $this->getDoctrine()->getRepository(FicheFrais::class);
        $ficheA=$repository->FicheUtilisateurDate($iduser,$_POST['annee']);
        $fiche=$repository->FicheUtilisateur($iduser);
        }
        else{
            $repository= $this->getDoctrine()->getRepository(FicheFrais::class);
            $fiche=$repository->FicheUtilisateur($iduser);
            $ficheA=$repository->FicheUtilisateurDate($iduser,2020);
        }
        
        
        return $this->render('historique/index.html.twig', [
            'controller_name' => 'HistoriqueController',
            'listeFiche'=>$fiche,
            'listeFicheA'=>$ficheA
        ]);
    }
    /**
     * @Route("/historiqueJson/{iduser}", name="historiqueJSON")
     */
    public function historiqueJSON($iduser): JsonResponse
    {
        //$idUtilisateur='root';
        $repository= $this->getDoctrine()->getRepository(FicheFrais::class);
        $fiche=$repository->FicheUtilisateur($iduser);
        
        $data = [];

    foreach ($fiche as $customer) {
        $data[] = [
            'idFiche' => $customer->getIdFiche(),
            'date' => $customer->getDate(),
            'etat' => $customer->getIdEtat()->getEtatActuel(),
            'identifiant' => $customer->getIdentifiant()->getIdentifiant(),
            //'phoneNumber' => $customer->getPhoneNumber(),
        ];
    }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/detail/{idfiche}", name="detail")
     */
    public function detail($idfiche): Response
    {
        $repository= $this->getDoctrine()->getRepository(FicheFrais::class);
        $fiche=$repository->find($idfiche);
        $repository= $this->getDoctrine()->getRepository(Forfaitaire::class);
        $lesForfaitaire=$repository->findLesForfaitaire($fiche->getIdFiche());
        $repository= $this->getDoctrine()->getRepository(HorsForfait::class);
        $lesHorsForfait=$repository->findLesHorsForfait($fiche->getIdFiche());
        return $this->render('historique/detail.html.twig', [
            'controller_name' => 'HistoriqueController',
            'listeForfaitaire'=>$lesForfaitaire,
            'listeHorsforfait'=>$lesHorsForfait

        ]);
    }

   
}
