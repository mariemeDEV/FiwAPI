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

class UtilisateurController extends FOSRestController
{
    //Getting the list of all users
    /**
    * @Rest\Get("/users")
    * 
    */
    public function listUsers() : Response{ 
        $usersRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateurs    = $usersRepository->findAll();

        if(empty($utilisateurs)){
            $response=array('message'=>'erreur','result'=>null);
            return new JsonResponse($response , Response::HTTP_NOT_FOUND);
        }else{
            $usersData = $this->get('jms_serializer')->serialize($utilisateurs,'json');
            $response=array('message'=>'succes','result'=>json_decode($usersData));
            return new JsonResponse($response, 200);
        }
       
    }

  
    

       
    
   

}
