<?php

    try {
        $myPDO = new PDO("pgsql:host=localhost;dbname=cartrackexam","root","Thu$$0661");
        echo "Connected to DB";
    } catch (PDOException $er) {
        echo $er->getMessage();
    }

?>