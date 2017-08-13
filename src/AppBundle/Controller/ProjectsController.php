<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/project/new", name="new_project")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(ProjectType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $project = $form->getData();
            $project->onPrePersist();

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirect('/');
        }

        return $this->render('projects/new.html.twig',[
            'projectForm' => $form->createView(),
        ]);
    }
}