<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function projectsListingAction()
    {
        $projects = $this->getDoctrine()
            ->getRepository("AppBundle:Project")
            ->findAll();

        return $this->render('default/projects_listing.html.twig', [
            'projects' => $projects,
        ]);
    }
}