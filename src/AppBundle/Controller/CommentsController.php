<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Comment;
use AppBundle\Entity\Task;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends Controller
{
    /**
     * @Route("/tasks/{name}/comments/new", name="new_comment")
     * @Method("POST")
     */
    public function newCommentAction(Task $task, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $commentForm = $this->createForm(CommentType::class);
        $commentForm->handleRequest($request);

        $comment = $commentForm->getData();
        $comment->setTask($task);
        $comment->setUser($this->getUser());

        $em->persist($comment);
        $em->flush($comment);

        return $this->redirectToRoute('show_task', ['name' => $task->getName()]);
    }
}