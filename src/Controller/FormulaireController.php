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
use App\Controller\ResultSetMapping;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Query\ResultSetMapping as QueryResultSetMapping;

class FormulaireController extends AbstractController
{
    


     /**
     * @Route("/horsforfait/{idfiche}", name="horsforfait")
     */
    public function horsforfait($idfiche,Request $request): Response
    {
        $repository= $this->getDoctrine()->getRepository(HorsForfait::class);
        $fiche=new HorsForfait();
        $form=$this->createForm(HorsForfaitType::class,$fiche);
        $leform=$form->createView();
        $form->handleRequest($request);
            if($form->isSubmitted() and $form->isValid())
            {
                $repository= $this->getDoctrine()->getRepository(FicheFrais::class);
                $ficheid=$repository->find($idfiche);
                $fiche->setIdFiche($ficheid);
                $entityManger= $this->getDoctrine()->getManager();
                $entityManger->persist($fiche);
                $entityManger->flush();
                return $this->redirectToRoute('fiche');
            }

        return $this->render('formulaire/horsforfait.html.twig', [
            'controller_name' => 'FormulaireController',
            'leform'=>$leform,
        ]);
    }

    /**
     * @Route("/fiche", name="fiche")
     */
    public function fiche(Request $request): Response
    {
        
        $date=new \DateTime('now');
        //$date=new \DateTime('2023-12-20');
        
        
        
    
        
        //$idUtilisateur='root';
        $idUtilisateur=$this->getUser()->getIdentifiant();

        //$cookies = $request->cookies;
        //$idUtilisateur=$cookies->get('id');
        \dump($idUtilisateur);
        $repository= $this->getDoctrine()->getRepository(FicheFrais::class);
        $fiche=$repository->verifFiche($date-> format('Y-m'),$idUtilisateur);
        
        if($fiche==NULL)
        {
            $fiche=new FicheFrais();
            $repository= $this->getDoctrine()->getRepository(Visiteur::class);
            $user=$repository->find($idUtilisateur);
            $fiche->setIdentifiant($user);
            $repository= $this->getDoctrine()->getRepository(Etat::class);
            $etat=$repository->find(5);
            $fiche->setIdEtat($etat);
            $fiche->setDate($date);
            $entityManger= $this->getDoctrine()->getManager();
            $entityManger->persist($fiche);
            $entityManger->flush();
            $entityManger2= $this->getDoctrine()->getManager();
            for($i=1;$i<5;$i++){
                $forf=new Forfaitaire();
                $forf->setIdFiche($fiche);
                $repository= $this->getDoctrine()->getRepository(Type::class);
                $type=$repository->find($i);
                $forf->setIdType($type);
                $forf->setQte(0);
                $entityManger2->persist($forf);

            }
            $entityManger2->flush();
            
        }
        

       
      
        $repository= $this->getDoctrine()->getRepository(Forfaitaire::class);
        $lesForfaitaire=$repository->findLesForfaitaire($fiche->getIdFiche());
        $laSomme=$repository->listProc($fiche->getIdFiche());
        \dump($laSomme);
        $repository= $this->getDoctrine()->getRepository(HorsForfait::class);
        $lesHorsForfait=$repository->findLesHorsForfait($fiche->getIdFiche());
        
       
        return $this->render('formulaire/fiche.html.twig', [
            'controller_name' => 'FormulaireController',
            'lesForfaitaire'=>$lesForfaitaire,
            'lesHorsForfait'=>$lesHorsForfait,
            'date'=>$date-> format('Y-m'),
            'fiche'=>$fiche,
            'lesSomme'=>$laSomme,
        ]);
    }
    
    /**
     * @Route("/valid/{idfiche}", name="valid")
     */
    public function valid($idfiche): Response
    {
        
        $repository= $this->getDoctrine()->getRepository(Forfaitaire::class);
        $lesForfaitaire=$repository->findLesForfaitaire($idfiche);
        $entityManger= $this->getDoctrine()->getManager();
        \dump($_POST);
        
        foreach ($lesForfaitaire as $leForfait) {
            if($leForfait->getIdType()->getIdType()==1)
            {
                $leForfait->setQte(intval($_POST["qte1"]));
            }
            else if($leForfait->getIdType()->getIdType()==2)
            {
                $leForfait->setQte(intval($_POST["qte2"]));
            }
            else if($leForfait->getIdType()->getIdType()==3)
            {
                $leForfait->setQte(intval($_POST["qte3"]));
            }
            else
            {
                $leForfait->setQte(intval($_POST["qte4"]));
            }
            $entityManger->persist($leForfait);
        }
        
        
        
        $entityManger->flush();
       
        return $this->redirectToRoute('fiche');
        //return $this->render('accueil.html.twig', [
        //    'controller_name' => 'ConnexionController',
        //]);
    }
    /**
     * @Route("/supprimer/{idfrais}", name="supprimer")
     */
    public function Supprimer($idfrais): Response
    {
        $repository= $this->getDoctrine()->getRepository(HorsForfait::class);
        $fiche=$repository->find($idfrais);
        $entityManger= $this->getDoctrine()->getManager();
        $entityManger->remove($fiche);
        $entityManger->flush();
        return $this->redirectToRoute('fiche');
        
    }
     /**
     * @Route("/horsforfaitM/{idhorsforfait}", name="horsforfaitM")
     */
    public function horsforfaitM($idhorsforfait,Request $request): Response
    {
        $repository= $this->getDoctrine()->getRepository(HorsForfait::class);
        $fiche=$repository->find($idhorsforfait);
        $form=$this->createForm(HorsForfaitType::class,$fiche);
        \dump($form);
        $leform=$form->createView();
        $form->handleRequest($request);
            if($form->isSubmitted() and $form->isValid())
            {
                $entityManger= $this->getDoctrine()->getManager();
                $entityManger->persist($fiche);
                $entityManger->flush();
                return $this->redirectToRoute('fiche');
            }

        return $this->render('formulaire/horsforfait.html.twig', [
            'controller_name' => 'FormulaireController',
            'leform'=>$leform,
        ]);
    }

    /**
     * @Route("/ficheJson/{annee}/{mois}/{user}", name="ficheJSON")
     */
    public function ficheJSON($annee,$mois,$user): JsonResponse
    {
        //$idUtilisateur='root';
        $date=$annee."-".$mois;
        \dump($date);
        $repository= $this->getDoctrine()->getRepository(FicheFrais::class);
        $fiche=$repository->verifFiche($date,$user);
        $repository= $this->getDoctrine()->getRepository(Forfaitaire::class);
        $forfaitaire=$repository->findLesForfaitaire($fiche->getIdFiche());
        $var = $this->getDoctrine()->getConnection()->prepare('CALL FicheForfait(16);');
        $var->execute();
        $val=$var->fetchAll();
        $var->closeCursor();
        $nb=0;
        
        \dump($fiche);
        \dump($forfaitaire);
        \dump($val);
        $data = [];
        
        

    
        $data[] = [
            'idFiche' => $fiche->getIdFiche(),
            'date' => $fiche->getDate(),
            'etat' => $fiche->getIdEtat()->getEtatActuel(),
            'identifiant' => $fiche->getIdentifiant()->getIdentifiant(),
            
             

            //'phoneNumber' => $customer->getPhoneNumber(),
        ];
        $i=0;
        foreach($val as $leforfait)
        {
        
        $data[0][$i]=[
            'idforfaitaire'=>$leforfait['ID_TYPE'],
            'prix'=>$leforfait['Montant'],
        ];
        $i++;
        
        }
        
        return new JsonResponse($data,Response::HTTP_OK);
       //return new Response("test");
    }
    
}
