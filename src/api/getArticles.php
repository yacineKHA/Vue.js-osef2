<?php

header("Access-control-Allow-Origin: *");
header('Access-Control-Request-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header("Access-Control-Request-Headers: X-Requested-With, Accept, Content-type");
header('Access-Control-Allow-Headers: X-Requested-With, Accept, Content-type');

require_once "bdd.php";


try {
    $req = $bdd->prepare("SELECT * INTO article");
    $req->execute();
    $data = $req->fetchAll();
    if ($data != null) {
        foreach ($data as $key) {
            $idArticle = $key['id_article'];
            $title = $key['title'];
            $text = $key['text'];
            $image = $key['image'];
            $date = $key['date'];

            $article = [
                $idArticle,
                $title,
                $text,
                $image,
                $date
            ];

            echo json_encode($article);
        }

    } else {
        return false;
    }

} catch (Exception $e) {
    echo "Erreur articles: " . $e;
}
