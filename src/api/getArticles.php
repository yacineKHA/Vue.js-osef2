<?php

header("Access-control-Allow-Origin: *");
header('Access-Control-Request-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header("Access-Control-Request-Headers: X-Requested-With, Accept, Content-type");
header('Access-Control-Allow-Headers: X-Requested-With, Accept, Content-type');

require_once "bdd.php";


try {
    $req = $bdd->prepare("SELECT * FROM article");
    $req->execute();
    $data = $req->fetchAll();
    if ($data != null) {
        echo json_encode($data);

    } else {
        return false;
    }

} catch (Exception $e) {
    echo "Erreur articles: " . $e;
}
