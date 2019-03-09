<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Entity\Compte;

class CompteController extends FOSRestController
{
//Getting the list of all comptes
/**
* @Rest\Get("/comptes")
* 
*/
    public function listComptes() : Response{ 
        $comptesRepository = $this->getDoctrine()->getRepository(Compte::class);
        $comptes           = $comptesRepository->findAll();

        if(empty($comptes)){
            $response=array('message'=>'erreur','result'=>null);
            return new JsonResponse($response , Response::HTTP_NOT_FOUND);
        }else{
            $comptesData = $this->get('jms_serializer')->serialize($comptes,'json');
            $response=array('message'=>'succes','result'=>json_decode($comptesData));
            return new JsonResponse($response, 200);
        }
    }
}
