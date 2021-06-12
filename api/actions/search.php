<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Connection.php');
    include_once('../../models/Movies.php');

    $databaseConn = new Connection();
    $db = $databaseConn->connect();

    $movies = new Movies($db);
    // var_dump($movies);
    // die();

    $movies->id = isset($_GET['id']) ? $_GET['id'] : die();

    $movies->searchonly();

    if (!$movies->status) {
        echo json_encode(
            array('message' => 'Movie with Id '.$movies->id.' does not exists.')
        );
    }else{
        $movies_arr = array(
            'id'         => $movies->id,
            'title'      => $movies->title,
            'director'   => $movies->director,
            'showing'    => $movies->showing,
            'casts'      => $movies->casts,
            'created_at' => $movies->created_at,
            'updated_at' => $movies->updated_at 
        );
    
        print_r(json_encode($movies_arr));
    }

    

?>