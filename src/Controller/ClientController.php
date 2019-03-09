<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Entity\Client;

class ClientController extends FOSRestController
{
   //Getting the list of all clients
    /**
    * @Rest\Get("/clients")
    * 
    */
    public function listClients() : Response{ 
        $clientsRepository = $this->getDoctrine()->getRepository(Client::class);
        $clients           = $clientsRepository->findAll();

        if(empty($clients)){
            $response=array('message'=>'erreur','result'=>null);
            return new JsonResponse($response , Response::HTTP_NOT_FOUND);
        }else{
            $clientsData = $this->get('jms_serializer')->serialize($clients,'json');
            $response=array('message'=>'succes','result'=>json_decode($clientsData));
            return new JsonResponse($response, 200);
        }
}
}