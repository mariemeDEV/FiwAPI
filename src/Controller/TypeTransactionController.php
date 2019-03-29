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
use App\Entity\Typedetransaction;

class TypeTransactionController extends FOSRestController{

     
//Fonction pour récuprer les données de tous les Comptes.
/**
* @Rest\Get("/typeTransaction")
* 
*/
public function listeTypes() : Response{
    $typesRepository  = $this->getDoctrine()->getRepository(Typedetransaction::class);
    $types          = $typesRepository->findAll();
    if(empty($types)){
        $response=array('message'=>'erreur','result'=>null);
        return new JsonResponse($response , Response::HTTP_NOT_FOUND);
    }else{
        $typesData = $this->get('jms_serializer')->serialize($types,'json');
        $response=array('message'=>'Données types','data'=>json_decode($typesData));
        return new JsonResponse($response, 200);
    }
}
    
}
