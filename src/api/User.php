<?php

class user
{
    private $pseudo;
    private $email;
    private $password;

    public function __construct($pseudo, $email, $password)
    {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }


    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function createNewUser($bdd)
    {
        try{
            $request = $bdd->prepare("SELECT * FROM user WHERE email = '$this->email' OR pseudo ='$this->pseudo'");
            $request->execute();

            $data = $request->fetchAll();
            if($data != null)
            {

                echo "Utilisateur déjà existant.";
            } else{

                $req = $bdd->prepare('INSERT INTO user(pseudo, email, mdp) VALUES(?, ?, ?)');
                if(filter_var($this->email, FILTER_VALIDATE_EMAIL))
                {
                    $req->execute([
                        $this->pseudo,
                        $this->email,
                        password_hash($this->password, PASSWORD_DEFAULT)
                    ]);
                    echo "Inscription réussie !";
                } else{
                    echo "Format email invalide.";
                }
            }
        } catch(Exception $e){
            die("Error createNewUser: ".$e->getMessage());
        }
    }

    public static function connectUser($bdd, $email, $mdp)
    {
        $req = $bdd->prepare("SELECT * FROM user WHERE email = '$email'");
        $req->execute();
        $data = $req->fetchAll();

        if($data != null)
        {

            foreach($data as $key)
            {
                if(password_verify($mdp, $key['mdp']))
                {
                    $_SESSION['connected'] = true;
                    $_SESSION['email'] = $key['email'];
                    $_SESSION['pseudo'] = $key['pseudo'];
                    $_SESSION['id'] = $key['id_user'];
                    $_SESSION['mdp'] = $key['mdp'];

                    //$currentUser = new User($key['pseudo'], $key['email'], $key['mdp']);
                    return true;

                } else {
                    return false;
                }
            }

        } else {
            return false;
        }
    }

}