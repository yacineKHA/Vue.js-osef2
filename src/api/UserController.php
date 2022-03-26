<?php

require "UserManager.php";


class UserController
{
    private $userManager;

    function __construct()
    {
        $this->userManager = new UserManager();
    }

    function connectUser()
    {
        $message = "Veuillez remplir tous les champs !";
        if (isset($_POST['mail'], $_POST['mdp'])) {
            if ($_POST['mail'] != null && $_POST['mdp'] != null) {
                $this->userManager->loginUser();
            } else {
                echo $message;
            }
        } else {
            return $message;
        }
    }

    function registration()
    {
        $message = "Veuillez compléter tous les champs !";
        if (isset($_POST['mailReg'], $_POST['pseudoReg'],$_POST['password1'], $_POST['password2'])){
            if ($_POST['mailReg'] != null && $_POST['pseudoReg'] != null && $_POST['password1'] && $_POST['password2'] ){
                $this->userManager->registerUser();
            } else{
                echo $message;
            }
        } else{
            echo $message;
        }
    }
}