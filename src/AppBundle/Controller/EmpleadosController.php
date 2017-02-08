<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Empleados;
use AppBundle\Form\EmpleadosType;
use AppBundle\Entity\CliPed;

class EmpleadosController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/employee", name="register_employee")
     */
    public function registerAction(Request $request)
    {   
    	$empl=new Empleados();
    	$cliped=new CliPed();
    	$form=$this->createForm(EmpleadosType::class, $empl);
    	
    	$form->handleRequest($request);
    	
    	if($form->isSubmitted() && $form->isValid()){
    		
    		$password = $this->get('security.password_encoder')
    		->encodePassword($empl, $empl->getPlainPassword());
    		$empl->setClave($password);
    		
    		$em=$this->getDoctrine()->getManager();
    		$em->persist($empl);   		
    		$em->flush();
    	
    		$this->addFlash('success', 'Empleado registrado');
    		
    		return $this->render('empleado/empl.html.twig',array('form'=>$form->createView()));	
    	}
    	return $this->render('empleado/empl.html.twig',array('form'=>$form->createView()));
    }
    
    
}
