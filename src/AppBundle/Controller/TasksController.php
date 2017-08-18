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

        $comments = [];
        foreach($taskObject->getComments() as $comment) {
            $comments[] = [
                'body' => $comment->getBody(),
            ];
        }

        $task = [
            'id' => $taskObject->getId(),
            'name' => $taskObject->getName(),
            'description' => $taskObject->getDescription(),
            'comments' => $comments,
        ];

        return JsonResponse::create($task);
    }

}