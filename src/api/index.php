<?php

require "UserController.php";
require "ArticleController.php";

$userController = new UserController();
$articleController = new ArticleController();

switch ($_GET["url"]) {
    case "connectionUser":
        $userController->connectUser();
        break;
    case "registration":
        $userController->registration();
        break;
    case "addArticle":
        $articleController->addArticle();
        break;
    case "getAllArticles":
        $articleController->getArticles();
        break;
}
?>