<?php

header("Access-control-Allow-Origin: *");
header("Access-control-Allow-Methods: POST, GET, PUT");
header("Access-control-Allow-Headers: Content-Type");

require_once "Database.php";

class UserManager
{
    function loginUser()
    {
        $mail = htmlspecialchars(strip_tags(trim($_POST['mail'])));
        $mdp = htmlspecialchars(strip_tags(trim($_POST['mdp'])));

        
        $req = Database::getBdd()->prepare("SELECT * FROM user WHERE email = ? ");
        $req->execute([
            $mail,
        ]);
        $data = $req->fetchAll();

        if ($data != null) {

            foreach ($data as $key) {
                if (password_verify($mdp, $key['mdp'])) {
                    $id = $key['id_user'];
                    $pseudo = $key['pseudo'];
                    $mail = $key['email'];

                    $userData = [
                        $id,
                        $pseudo,
                        $mail,
                    ];

                    echo json_encode($userData);
                } else {
                    echo json_encode("Email ou mot de passe erroné !1");
                }
            }
        } else {
            echo json_encode("Email ou mot de passe erroné !2");
        }
    }

    function registerUser(){
        $mail = htmlspecialchars(strip_tags(trim($_POST['mailReg'])));
        $pseudo = htmlspecialchars(strip_tags(trim($_POST['pseudoReg'])));
        $password = htmlspecialchars(strip_tags(trim($_POST['password1'])));

        $messages= [
            "Ce compte existe déjà !",
            "Inscription réussie, vous pouvez maintenant vous connecter",
            "Erreur, l'inscription n'a pas pu se dérouler comme prévu."
        ];

        $req = Database::getBdd()->prepare("SELECT * FROM user WHERE email = ? or pseudo = ?");
        $req->execute([
            $mail,
            $pseudo
        ]);
        $data = $req->fetchAll();
        if ($data != null){
            echo json_encode($messages[0]);
        } else{
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
                try {
                    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                    $req2 = $this->getBdd()->prepare("INSERT INTO user(pseudo, email, mdp) VALUES (?,?,?)");
                    $req2->execute([
                        $pseudo,
                        $mail,
                        $password_hashed
                    ]);
                    echo json_encode($messages[1]);
                } catch (Exception $e){
                    echo json_encode($messages[2].$e);
                }
            }

        }
    }
}


/*----------------PHP for Axios------------*/
/*
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$input = json_decode(file_get_contents('php://input'),true);


switch ($method) {
    case 'GET':
        $id = $_GET['id'];
        $sql = "select * from contacts".($id?" where id=$id":'');
        break;
    case 'POST':
        $name = $_POST["name"];
        $email = $_POST["email"];
        $country = $_POST["country"];
        $city = $_POST["city"];
        $job = $_POST["job"];

        $sql = "insert into contacts (name, email, city, country, job) values ('$name', '$email', '$city', '$country', '$job')";
        break;
}

// run SQL statement
$result = mysqli_query($con,$sql);

// die if SQL statement failed
if (!$result) {
    http_response_code(404);
    die(mysqli_error($con));
}

if ($method == 'GET') {
    if (!$id) echo '[';
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
        echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    if (!$id) echo ']';
} elseif ($method == 'POST') {
    echo json_encode($result);
} else {
    echo mysqli_affected_rows($con);
}

$con->close();
*/
