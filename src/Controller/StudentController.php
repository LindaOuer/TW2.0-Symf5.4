<?php 
namespace App\Controller;

use App\Entity\Student;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/student', name:'student')]
class StudentController extends AbstractController{

/**
 * @Route("/test", name="index_page")
 */
    public function index():Response {
        return new Response('Hello');
    }

#[Route('/index', name:'index')]
public function index1(Request $request):Response {
    return new Response($request->attributes->get('_route'));
}
#[Route('/extern', name:'external_redirect')]
public function index2():RedirectResponse {
    return $this->redirect('https://www.google.com');
}
#[Route('/intern', name:'internal_redirect')]
public function index3():RedirectResponse {
    return $this->redirectToRoute("index_page");
}

#[Route('/list', name:'student_list')]
public function list(ManagerRegistry $doctrine): Response
{
    $students = $doctrine->getRepository(Student::class)->findAll();
    return $this->render('student/list.html.twig', [
        'students' => $students,
    ]);
}
}