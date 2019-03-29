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

      /**
    * @Rest\Get("/profils/{profil}")
    * 
    */
    public function getUsersByProfil($profil) :Response{
        $usersRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $usersWithProfil = $usersRepository->findBy(['profil'=>$profil]);
        if(empty($usersWithProfil)){
            $response = array('message'=>'erreur','result'=>null);
            return new JsonResponse($response , Response::HTTP_NOT_FOUND);
        }else{
            $data     = $this->get('jms_serializer')->serialize($usersWithProfil,'json');
            $response = array('message'=>'Données des '.$profil.'s'.' recupérées avec succés','data'=>json_decode($data));
            return new JsonResponse($response, 200);
        }
      
    }

//Données utilisateur en fontion de l'id
   /**
   * @Rest\Get("/user/{login}")
   * 
   */
    public function getUserData($login) : Response{
        $userRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $user           = $userRepository->findBy(['login'=>$login]);
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

    /**
    * @Rest\Post("/createUser")
    */
    //Le compte de l'utilisateur est crée au moment de son enregistrement avec un solde nul
    public function createUser(Request $request) : Response{
        $em             = $this->getDoctrine()->getManager();
        $requestContent = $request->getContent();
        $utilisateur    = $this->get('jms_serializer')->deserialize($requestContent,"App\Entity\Utilisateur", 'json'); 
        if($utilisateur == null){
            return new JsonResponse("le contenu des données à insérer est vide",Response::HTTP_BAD_REQUEST);
        }else{ 
            $utilisateur->setLogin($this->generateLogin($utilisateur->getPrenom()));
            $utilisateur->setPassword($this->generatePassword(5));
            $userProfil = $utilisateur->getProfil();
            $userLogin  = $utilisateur->getLogin();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           ;
            $em->persist($utilisateur);
            $em->flush();
            $userRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
            $insertedUser   = $userRepository->find($utilisateur->getId());
            $userData       = $this->get('jms_serializer')->serialize($insertedUser,'json');
            $compte         = new Compte();
            $compte->setSolde("0");
            $compte->setPoints("0");
            $compte->setIdUtilisateur($insertedUser);
            $em->persist($compte);
            $em->flush();
            return new JsonResponse(array("Utilisateur crée avec succés"=>'ok','Données insérées'=>json_decode($userData)));   
        }
    }

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