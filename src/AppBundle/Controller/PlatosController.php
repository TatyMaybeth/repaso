<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\EmpleadosType;
use AppBundle\Entity\Platos;
use AppBundle\Form\PlatosType;

class PlatosController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/platos", name="register_platos")
     */
    public function registerAction(Request $request)
    {   
    	$platos=new Platos();
    	
    	$form=$this->createForm(PlatosType::class, $platos);
    	
    	$form->handleRequest($request);
    	
    	if($form->isSubmitted() && $form->isValid()){
    		
    		$em=$this->getDoctrine()->getManager();
    		$em->persist($platos);   		
    		$em->flush();
    		    		
    		$this->addFlash('success', 'Plato registrado');
    		
    		return $this->render('empleado/platos.html.twig',array('form'=>$form->createView()));	
    	}
    	return $this->render('empleado/platos.html.twig',array('form'=>$form->createView()));
    }
    
    
}
