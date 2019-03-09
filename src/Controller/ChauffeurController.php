<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Entity\Chauffeur;

class ChauffeurController extends FOSRestController
{
     //Getting the list of all chauffeurs
    /**
    * @Rest\Get("/chauffeurs")
    * 
    */
    public function listChauffeurs() : Response{ 
        $chauffeursRepository = $this->getDoctrine()->getRepository(Chauffeur::class);
        $chauffeurs           = $chauffeursRepository->findAll();

        if(empty($chauffeurs)){
            $response=array('message'=>'erreur','result'=>null);
            return new JsonResponse($response , Response::HTTP_NOT_FOUND);
        }else{
            $chauffeursData = $this->get('jms_serializer')->serialize($chauffeurs,'json');
            $response=array('message'=>'succes','result'=>json_decode($chauffeursData));
            return new JsonResponse($response, 200);
        }
    }
}
