<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends Controller
{
    /**
     * @Route("/tasks/{name}", name="show_task")
     * @Method("GET")
     */
    public function showTask(Task $task)
    {
        $commentForm = $this->createForm(CommentType::class);

        return $this->render('tasks/show.html.twig', [
            'task' => $task,
            'commentForm' => $commentForm->createView(),
        ]);
    }
}