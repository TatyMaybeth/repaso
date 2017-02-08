<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Estudiante;
use AppBundle\Form\EstudianteType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EstudianteController extends Controller
{
	/**
	 * @Route("/", name="index")
	 */
	public function indexAction()
	{
		return $this->render('default/index.html.twig');
	}
	
	/**
	 * @Route("/student", name="register_student")
	 */
	public function registerAction(Request $request)
	{
		$students=$this->estAll();
		$subjects=$this->matAll();
		//Creamos el formulario
		$student= new Estudiante();
		$form=$this->createForm(EstudianteType::class, $student);
		
		//Esto solo sucedera en POST
		$form->handleRequest($request);
		
		//Bucle if que permite verificar si el form es valido y correcto
		if($form->isSubmitted() && $form->isValid()){
			//$student=$form->getData(); //Tomo los datos del form
						
			//guardando estudiante
			$em=$this->getDoctrine()->getManager();
			$em->persist($student);
			$em->flush();
			
			//Retorna todos los estudiantes registrados
			$students=$this->estAll();
			$subjects=$this->matAll();
			//enviando mensaje
			$this->addFlash('success', 'Estudiante registrado');
			
			//return $this->redirectToRoute('list');
			return $this->render('student/student.html.twig',array('students'=>$students, 'subjects'=>$subjects,'form'=>$form->createView()));
		}
				
		return $this->render('student/student.html.twig',array('students'=>$students, 'subjects'=>$subjects,'form'=>$form->createView()));
	}
	
	/**
	 * @Route("/list", name="list")
	 */
	public function listAction(Request $request)
	{	
		$students=$this->estAll();
		$subjects=$this->matAll();
		return $this->render('student/list.html.twig',array('students'=>$students, 'subjects'=>$subjects));
	}
	
	/**
	 * @Route("/list/editar/{id}", name="edit")
	 */
	public function editAction(Request $request,$id)
	{
		$students=$this->estAll();
		$em=$this->getDoctrine()->getManager();
		$student=$em->find('AppBundle:Estudiante', $id); //Obtiene el objeto usuario que se desea modificar
		dump($student);
		die();
		//Valida si el estudiante existe 
		if($student==null){
			$ms="El estudiante con id ".$id." no EXISTE";
			$this->addFlash('error',"$ms");
			return $this->redirectToRoute("list");
		}else{
			try{
				$student=$em->find('AppBundle:Estudiante', $id);//Obtiene el objeto usuario que se desea modificar
				/*$form = $this->createFormBuilder($student)
				->add('email',EmailType::class,array('required'=>true))
				->add('phone',TextType::class)
				->add('address',TextType::class)
				->add('userCredFk',EntityType::class,array(
						'label'=>'materia',
						'class' => 'AppBundle:Materias',
						'choice_label' => 'name',
				
				))
				->add('modificar',SubmitType::class)
				->getForm();*/
				$form =$this->createForm(EstudianteType::class, $student); //creo el formulario y  paso el objeto student para visualizar sus datos
				$form->handleRequest($request);
				
				if($form->isSubmitted() && $form->isValid()){
					
					$em=$this->getDoctrine()->getManager();
					$em->persist($student);
					$em->flush();
					$ms="Estudiante modificada con id ".$id;
					$this->addFlash('success',"$ms");
					return $this->redirectToRoute("list");
				}
			}catch (\PDOException $exception){
				$this->addFlash('error',"Error!, no puede editar");
				return $this->redirectToRoute("list");
			}
		}
		
		return $this->render('student/editar.html.twig',array('students'=>$students, 'student'=>$student, 'form'=>$form->createView()));
	}
	
	/**
	 * @Route("/list/delete/{id}", name="delete")
	 */
	public function deleteAction(Request $request,$id)
	{
		$students=$this->estAll();
		$em=$this->getDoctrine()->getManager();
		$student=$em->find('AppBundle:Estudiante', $id); //Obtiene el objeto usuario que se desea modificar
		
		//Valida si el estudiante existe
		if(!$student){
			$ms="El estudiante con id ".$id." no EXISTE";
			$this->addFlash('error',"$ms");
			return $this->redirectToRoute("list");
		}else{
			try{
				$student=$em->find('AppBundle:Estudiante', $id);//Obtiene el objeto usuario que se desea modificar
				$form = $this->createFormBuilder($student)
				 ->add('name',TextType::class)
				 ->add('userCredFk',EntityType::class,array(
				 'label'=>'materia',
				 'class' => 'AppBundle:Materias',
				 'choice_label' => 'name',
		
				 ))
				 ->add('Si',SubmitType::class)
				 ->getForm();
				 
				 $form->handleRequest($request);
				 
				 if($form->isSubmitted() && $form->isValid()){
				 	$em->remove($student);
				 	$em->flush();
				 	$ms="Estudiante removido con id ".$id;
				 	$this->addFlash('success',"$ms");
				 	return $this->redirectToRoute("list");
				 }				 
			}catch (\PDOException $exception){
				$this->addFlash('error',"Error!, no puede eliminar");
				return $this->redirectToRoute("list");
			}
			
			return $this->render('student/delete.html.twig',array('students'=>$students, 'student'=>$student, 'form'=>$form->createView()));
		}
	}
	
	
	private function estAll(){
		$em=$this->getDoctrine()->getManager();
		$student=$em->getRepository('AppBundle:Estudiante')->findAll();
		return $student;
	}
	
	private function matAll(){
		$em=$this->getDoctrine()->getManager();
		$subject=$em->getRepository('AppBundle:Materias')->findAll();
		return $subject;
	}
	
	
}