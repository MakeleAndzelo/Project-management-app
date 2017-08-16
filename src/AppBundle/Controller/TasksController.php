<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends Controller
{
    /**
     * @Route("/tasks/get/{id}", name="get_tasks")
     * @Method("GET")
     */
    public function getTask($id)
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Task');
        $taskObject = $em->find($id);
        $task = [
            'id' => $taskObject->getId(),
            'name' => $taskObject->getName(),
            'description' => $taskObject->getDescription(),
            'comments' => $taskObject->getComments()
        ];

        return JsonResponse::create($task);
    }

}