<?php

namespace Controller;

use Model\Entities\Comment;
use Model\Entities\Post;
use Model\Managers\Manager;

class FrontendController extends Controller
{
    private $comments = [];

    public function __construct()
    {
        $this->controllerName = __CLASS__;
    }

    public function showHome()
    {
        $this->generatePage("home");
    }

    public function detailsOfPost($id)
    {
        /** @var \Model\Managers\PostsManager $postsManager */
        $postsManager = Manager::getManagerOf("Posts");
        /** @var \Model\Managers\CommentsManager $commentsManager */
        $commentsManager = Manager::getManagerOf("Comments");

        $postData = $postsManager->getPostById($id);

        if(!is_array($postData)) {
            header("Location: /articles");
        }

        $post = new Post($postData);
        $validatedComments = $commentsManager->getValidatedCommentsOfPost($post);

        foreach ($validatedComments as $key => $data) {
            $this->comments[] = new Comment($data);
        }

        $comments = $this->comments;

        $this->generatePage("post", compact("post", "comments"));
    }

    public function addComment()
    {

    }

    public function getAllPosts()
    {

    }

    public function loginForm()
    {

    }

    public function loginValidation()
    {

    }
}