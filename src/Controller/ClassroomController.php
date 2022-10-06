<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route('/classroom', name: 'classroom')]
class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/list', name: 'classroom_list')]
    public function list(ManagerRegistry $doctrine): Response // Call ManagerRegistry: to inject Doctrine as a service
    {
        $classrooms = $doctrine->getRepository(Classroom::class)->findAll();
        return $this->render('classroom/list.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    #[Route('/list2', name: 'classroom_list2')]
    public function list2(ClassroomRepository $repo): Response
    {
        $classrooms = $repo->findAll();
        return $this->render('classroom/list.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    #[Route('/show/{id}', name: 'classroom_detail')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $classroom = $doctrine->getRepository(Classroom::class)->find($id);
        // if (!$classroom) {
        //     throw $this->createNotFoundException(
        //         'No classroom found for id '.$id
        //     );
        // }
        return $this->render('classroom/show.html.twig', [
            'classroom' => $classroom,
        ]);
    }

    #[Route('/show2/{id}', name: 'classroom_detail2')]
    public function show2(ClassroomRepository $repo, int $id): Response
    {
        $classroom = $repo->find($id);
        return $this->render('classroom/show.html.twig', [
            'classroom' => $classroom,
        ]);
    }

    #[Route('/show3/{id}', name: 'classroom_detail3')]
    public function show3(Classroom $classroom=null): Response
    {
        return $this->render('classroom/show.html.twig', [
            'classroom' => $classroom,
        ]);
    }

    #[Route('/delete/{id}', name: 'classroom_delete')]
    public function delete(Classroom $classroom=null, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($classroom);
        $entityManager->flush();

        return new Response("Deleted");
    }

    #[Route('/add', name: 'classroom_add')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $classroom = new Classroom();
        // $classroom->setName('TEST');
        $form = $this->createFormBuilder($classroom)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Classroom'])
            ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$classroom` variable has also been updated
            $classroom = $form->getData();

            // ... perform some action, such as saving the classroom to the database
            $entityManager = $doctrine->getManager(); //gets Doctrine's entity manager object - its responsible for saving objects to and fetching objects from the DB
            
            $entityManager->persist($classroom); // doctrine prepares the object but no query is executed

            $entityManager->flush(); // executes the query in this case INSERT

            return new Response('classroom success');
        }
        
        return $this->render('classroom/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add2', name: 'classroom_add2')]
    public function add2(Request $request): Response
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$classroom` variable has also been updated
            $classroom = $form->getData();

            // ... perform some action, such as saving the classroom to the database

            return new Response('classroom success 2');
        }
        
        return $this->render('classroom/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
