<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization,X-Requested-With');

    include_once('../../config/Connection.php');
    include_once('../../models/Movies.php');

    $databaseConn = new Connection();
    $db = $databaseConn->connect();

    $movies = new Movies($db);
    // var_dump($movies);
    // die();

    $data = json_decode(file_get_contents("php://input"));

    $movies->id = $data->id;


    if ($movies->deletemovie()) {
        echo json_encode(
            array('message' => 'Movie Deleted Successfully' )
        );
    }else{
        echo json_encode(
            array('message' => 'Movie Update Failed' )
        );
    }
    

?>