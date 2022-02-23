<?php

header("Access-control-Allow-Origin: *");
header("Access-control-Allow-Methods: POST, GET, PUT");
header("Access-control-Allow-Headers: Content-Type");

require_once "bdd.php";

    $request = json_decode(file_get_contents("php://input"));
    $mail = htmlspecialchars($request->mail);
    $mdp = htmlspecialchars($request->mdp);

    $req = $bdd->prepare("SELECT * FROM user WHERE email = ?");
    $req->execute([
        $mail
    ]);
    $data = $req->fetchAll();

    if($data != null)
    {
        foreach($data as $key)
        {
            if ($mdp == $key['mdp']){

                $id =$key['id_user'];
                $pseudo= $key['pseudo'];
                $mail = $key['email'];

                $userData = [
                    $id,
                    $pseudo,
                    $mail,
                ];

                echo json_encode($userData);
            } else{
                echo json_encode(false);
            }
        }

    } else {
        return false;
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
