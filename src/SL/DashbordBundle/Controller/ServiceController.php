<?php

namespace SL\DashbordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServiceController extends Controller{

     public function listAdresseJsonAction()
    {                    
           
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:User');
        $lesUser=$repository->findAll();
        $myArray=array();
        foreach ($lesUser as $user){
            $tab=array();
            $tab['value']=$user->getId();
            $tab['text']=$user->getEmail();
            array_push($myArray, $tab);
        }
        
        return new JsonResponse($myArray);
    }
    
    public function changeStatutAction()
    {                    
           
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:User');
        $lesUser=$repository->findAll();
        $myArray=array();
        foreach ($lesUser as $user){
            $tab=array();
            $tab['value']=$user->getId();
            $tab['text']=$user->getEmail();
            array_push($myArray, $tab);
        }
        
        return new JsonResponse($myArray);
    }
}
