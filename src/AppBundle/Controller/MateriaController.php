<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Materias;
use AppBundle\Form\MateriasType;

class MateriaController extends Controller
{
	/**
	 * @Route("/", name="index")
	 */
	public function indexAction()
	{
		return $this->render('default/index.html.twig');
	}
	
	/**
	 * @Route("/subject", name="register_subject")
	 */
	public function registerAction(Request $request)
	{
		//Creamos el formulario
		$subject= new Materias();
		$form=$this->createForm(MateriasType::class, $subject);
	
		//Esto solo sucedera en POST
		$form->handleRequest($request);
	
		//Bucle if que permite verificar si el form es valido y correcto
		if($form->isSubmitted() && $form->isValid()){
			//$student=$form->getData(); //Tomo los datos del form
				
			//guardando estudiante
			$em=$this->getDoctrine()->getManager();
			$em->persist($subject);
			$em->flush();
				
			//enviando mensaje
			$this->addFlash('success', 'Materia registrada');
				
			return $this->redirectToRoute('register_subject');
		}
	
		return $this->render('student/subject.html.twig',array('form'=>$form->createView()));
	}
}