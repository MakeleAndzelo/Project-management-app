<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends Controller
{

    /**
     * @Route("/", name="projects_list")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Project');
        $projects = $em->findAll();

        return $this->render('projects/index.html.twig', [
            'projects' => $projects
        ]);
    }
}