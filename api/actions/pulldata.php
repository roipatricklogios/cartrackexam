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

    $result = $movies->read();

    $num = $result->rowCount();


    if ($num > 0) {
        $movies_arr = array();
        $movies_arr['data'] = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $movies_items = array(
                'id'         => $m_id,
                'title'      => $m_title,
                'director'   => $m_director,
                'casts'      => $m_casts,
                'showing'    => $m_showing,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            );

            array_push($movies_arr['data'], $movies_items);
        }

        echo json_encode($movies_arr);

    } else {
        echo json_encode(
            array('message' => 'No Movies Found')
        );
    }

?>