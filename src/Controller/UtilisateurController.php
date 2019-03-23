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
use App\Entity\Chauffeur;
use App\Entity\Client;



class UtilisateurController extends FOSRestController
{

    //Données de tous les utilisateurs
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
            $response=array('message'=>'Données recupérées avec succes','data'=>json_decode($usersData));
            return new JsonResponse($response, 200);
        }
    }

   //Données utilisateur en fontion du login
   /**
   * @Rest\Get("/user/{login}")
   * 
   */
  public function getUserData($login) : Response{
    $userRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
    $user           = $userRepository->find($login);
    if(empty($user)){
        $response=array('message'=>'erreur','result'=>null);
        return new JsonResponse($response , Response::HTTP_NOT_FOUND);
    }else{
        $userData = $this->get('jms_serializer')->serialize($user,'json');
        $response = array('message'=>'Données de l\'utilisateur avec l\'identifiant '.$login.' recupérées avec succés','data'=>json_decode($userData));
        return new JsonResponse($response,200);
    }
  }
    //function to generate a password
    public function generatePassword($length):string{
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@';
        $charactersLength = strlen($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $password;
    }

    //function to generate login
    public function generateLogin(string $userName):string{
        $generatedLogin = $userName.$this->generatePassword(3);
        return $generatedLogin;
    }

    //Ajouter un nouvel utilisateur
    /**
    * @Rest\Post("/createUser")
    */
    //Le compte de l'utilisateur est crée au moment de son enregistrement avec un solde nul
    public function createUser(Request $request) : Response{
        $em                 = $this->getDoctrine()->getManager();
        $requestContent     = $request->getContent();
        $utilisateur        = $this->get('jms_serializer')->deserialize($requestContent,"App\Entity\Utilisateur", 'json'); 
        if($utilisateur==null){
            return new JsonResponse("le contenu des données à insérer est vide",Response::HTTP_BAD_REQUEST);
        }else{ 
            $utilisateur->setLogin($this->generateLogin($utilisateur->getPrenom()));
            $utilisateur->setMotdepasse($this->generatePassword(5));
            $userProfil    = $utilisateur->getProfil();
            $userLogin     = $utilisateur->getLogin();
            
//L'utilisateur est un chauffeur donc la table chauffeur a un nouvel objet
            if($userProfil=="chauffeur"){
                $chauffeur = new Chauffeur();
                $chauffeur
                // ->setLogin($utilisateur->getLogin())
                ->setMatricule("DK-8521-BH");
                try{
                    $em->persist($utilisateur);
                    $em->persist($chauffeur);
                    $em->flush();
                    return new JsonResponse("Utilisateur crée avec succés",200);        
                }catch(Exception $exception){
                    return new JsonResponse("Une erreur s'est produite".$exception->message(),200);        
                }
            }

//L'utilisateur est un client donc la table chauffeur a un nouvel objet
            if($userProfil=="client"){
                return new JsonResponse($userProfil,200);        
            }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ;
            // $em->persist($utilisateur);
            // $em->flush();
        }
    }

     //Mettre à jour les informations
    /**
    * @Rest\Get("/updateUtilisateur/{login}")
    * 
    */
    public function updateUser($login) : Response{
        
        return new JsonResponse('updated',200);
    }


    //Supprimer un utilisateur methode à revoir
    /**
    * @Rest\Get("/removeUtilisateur/{login}")
    * 
    */
    // public function removeUser($login){

    //     // $response = $this->generateLogin('Marieme');
    //     // return new JsonResponse($response,200);
    //     // return new JsonResponse('supprimé',200);
    //     $userToDelete = $this->getUserData($login);
    //     return $userToDelete;   
    // }


   
   

  
    

       
    
   

}
