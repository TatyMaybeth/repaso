<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pedidos;
use AppBundle\Form\PedidosType;
use AppBundle\Entity\Platos;

class PedidoController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/pedido", name="registrar")
     */
    public function registarAction(Request $request)
    {
    	$ped=new Pedidos();
    	$plat=new Platos();
    	
    	$form=$this->createForm(PedidosType::class, $ped);
    	
    	if($form->isSubmitted() && $form->isValid()){
    		
    		$total=$ped->getCantidad()*$plat->getPrecio();
    		$ped->setTotal($total);
    		dump($ped);
    		die();
    		$em=$this->getDoctrine()->getManager();
    		$em->persist($ped);
    		$em->flush();
    		
    		$this->addFlash('success', 'Pedido registrado');
    		
    		$platos=$this->platAll();
    		$pedi=$this->pedAll();
    		
    		return $this->render('empleado/pedido.html.twig', array('ped'=>$pedi,'plat'=>$platos,'form'=>$form->createView()));
    	}
    	
    	
    	$form->handleRequest($request);
    	 
    	return $this->render('empleado/pedido.html.twig',array('ped'=>$ped,'plat'=>$plat,'form'=>$form->createView()));
    }
    
    
    private function pedAll(){
    	$em=$this->getDoctrine()->getManager();
    	$ped=$em->getRepository('AppBundle:Pedidos')->findAll();
    	return $ped;
    }
    
    private function platAll(){
    	$em=$this->getDoctrine()->getManager();
    	$plat=$em->getRepository('AppBundle:Platos')->findAll();
    	return $plat;
    }
    
    
}
