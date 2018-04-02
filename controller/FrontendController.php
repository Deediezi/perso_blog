<?php

namespace Controller;

use Model\Entities\Comment;
use Model\Entities\Post;
use Model\Managers\CommentsManager;
use Model\Managers\Manager;
use Model\Managers\PostsManager;

class FrontendController extends Controller
{
    private $comments = [];
    private $posts = [];

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

        $this->generatePage("Post", compact("post", "comments"));
    }

    public function addComment($post_id)
    {
        /** @var CommentsManager $commentsManager */
        $commentsManager = Manager::getManagerOf("Comments");

        if(!$_POST["submit"]) {
            throw new \InvalidArgumentException("Unable find the form");
        }

        $data = [
            "author" => $_POST["pseudo"],
            "content" => $_POST["content"],
            "post_id" => $post_id
        ];

        $comment = new Comment($data);

        $verifyResult = $comment->verifyCommentData($data);

        $commentsManager->addComment($comment);
    }

    public function getAllPosts()
    {
        /** @var PostsManager $postsManager */
        $postsManager = Manager::getManagerOf("Posts");
        $posts = $postsManager->getAllPosts();

        foreach ($posts as $post) {
            $this->posts[] = new Post($post);
        }

        $posts = $this->posts;
        $this->generatePage("Blog", compact("posts"));
    }

    public function loginForm()
    {

    }

    public function loginValidation()
    {

    }
}