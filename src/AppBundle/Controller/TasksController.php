<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Task;
use AppBundle\Form\CommentType;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('ROLE_USER')")
 */
class TasksController extends Controller
{

    /**
     * @Route("/tasks/{name}/finish", name="finish_task")
     */
    public function finishTaskAction(Task $task)
    {
        $task->setIsCompleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return $this->redirectToRoute('show_task', ['name' => $task->getName()]);
    }

    /**
     * @Route("/projects/{name}/tasks/new", name="new_task")
     */
    public function createAction(Project $project, Request $request)
    {
        $taskForm = $this->createForm(TaskType::class);

        $taskForm->handleRequest($request);

        if ($taskForm->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            $task = $taskForm->getData();
            $task->setProject($project);

            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'Task successfully created');

            return $this->redirectToRoute('show_task', ['name' => $task->getName()]);
        }

        return $this->render('tasks/create.html.twig', [
           'taskForm' => $taskForm->createView(),
        ]);
    }

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