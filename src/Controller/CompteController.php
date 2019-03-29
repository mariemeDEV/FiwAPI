<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Utilisateur;
use App\Entity\Compte;


class CompteController extends FOSRestController{
 
//Fonction pour récuprer les données de tous les Comptes.
/**
* @Rest\Get("/comptes")
* 
*/
public function listeComptes() : Response{
    $comptesRepository  = $this->getDoctrine()->getRepository(Compte::class);
    $comptes           = $comptesRepository->findAll();
    if(empty($comptes)){
        $response=array('message'=>'erreur','result'=>null);
        return new JsonResponse($response , Response::HTTP_NOT_FOUND);
    }else{
        $comptesData = $this->get('jms_serializer')->serialize($comptes,'json');
        $response=array('message'=>'Données comptes','data'=>json_decode($comptesData));
        return new JsonResponse($response, 200);
    }
}

//Fonction pour  récupérer les données d'un compte donné en fonction du propriétaire
/**
* @REST\Get("/compte/{userLogin}")
*/
public function getUserCompte($userLogin) : Response {
    $userRepository     = $this->getDoctrine()->getRepository(Utilisateur::class);
    $comptesRepository  = $this->getDoctrine()->getRepository(Compte::class);
    $user               = $userRepository->findBy(['login'=>$userLogin]);
    $compte             = $comptesRepository->findBy(['idUtilisateur'=>$user]);
    if(empty($user) || empty($compte)){
        $response=array('message'=>'erreur','result'=>null);
        return new JsonResponse($response , Response::HTTP_NOT_FOUND);
    }else{
        $userCompteData = $this->get('jms_serializer')->serialize($compte ,'json');
        $response = array('message'=>'Données du compte de l\'utilisateur '.$userLogin.' recupérées avec succés','data'=>json_decode($userCompteData));
        return new JsonResponse($response,200);
    }
}
   

  
}
