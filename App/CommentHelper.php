<?php

    namespace App;

    use Model\Managers\Manager;
    use Model\Managers\CommentsManager;

    abstract class CommentHelper extends Helper
    {
        public static function countAll()
        {
            /** @var CommentsManager $commentsManager */
            $commentsManager = Manager::getManagerOf("Comments");
            $countComments = $commentsManager->countComments();

            $nb["all"] = 0;
            $nb["accepted"] = 0;
            $nb["refused"] = 0;
            $nb["awaitingModeration"] = 0;

            foreach ($countComments as $result) {
                switch ($result["status_id"]) {
                    case 1:
                        $nb["all"]++;
                        $nb["awaitingModeration"]++;
                        break;
                    case 2:
                        $nb["all"]++;
                        $nb["accepted"]++;
                        break;
                    case 3:
                        $nb["all"]++;
                        $nb["refused"]++;
                        break;
                }
            }

            return $nb;
        }

        public static function verifyComment($commentData)
        {
            $pseudo = $commentData["author"];
            $message = $commentData["content"];

            $err = [];

            if(!isset($pseudo) || empty($pseudo) || !isset($message) || empty($message)) {
                $err["warning"] = "Tous les champs ne sont pas remplis";
            }

            if(strlen($pseudo) > 50) {
                $err["warning"] = "Le pseudo ne doit pas dépasser 50 caractères";
            }

            if(isset($err) && !empty($err)) {
                return $err;
            }

            return true;
        }
    }