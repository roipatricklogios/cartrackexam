<?php

    class Movies{
        private $connection;
        private $table = "movies";

        public $status;
        public $id;
        public $title;
        public $director;
        public $showing;
        public $casts;
        public $created_at;
        public $updated_at;

        public function __construct($db){
            $this->connection = $db;
        }

        public function read(){
            
            $querylist = '
                SELECT
                m.m_id,
                m.m_title,
                m.m_director,
                m.m_showing,
                m.m_casts,
                m.created_at,
                m.updated_at
                FROM
                ' . $this->table.' m

                LEFT JOIN
                directors d
                ON d.d_id = m.m_director
                ORDER BY
                m.created_at desc
            ';

            // var_dump($querylist);die();

            $statement = $this->connection->prepare($querylist);

            $statement->execute();

            return $statement;
        }



        //Search Function
        public function searchonly(){
            $querysingle = '
                SELECT
                    m.m_id,
                    m.m_title,
                    m.m_director,
                    m.m_showing,
                    m.m_casts,
                    m.created_at,
                    m.updated_at
                FROM
                    ' . $this->table.' m
                LEFT JOIN
                    directors d
                    ON d.d_id = m.m_director
                WHERE
                    m.m_id = ?
                LIMIT 1
            ';

            $statement = $this->connection->prepare($querysingle);

            $statement->bindParam(1, $this->id);

            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                $this->status = false;
            }else{
                $this->status = true;
                $this->title    = $row['m_title'];
                $this->director = $row['m_director'];
                $this->showing  = $row['m_showing'];
                $this->casts    = $row['m_casts'];
            }

            


            

        }

        public function checkdirector($d_id){
            $directorquery = '
                SELECT * FROM directors WHERE d_id = ?
            ';

            $statement = $this->connection->prepare($directorquery);

            $statement->bindParam(1, $d_id);
            $statement->execute();

            $num = $statement->rowCount();

            return $num;
        }

        public function createmovie(){
            $querycreate = '
                INSERT INTO '.
                $this->table
                .' VALUES (?,?,?,?)
            ';

            $statement = $this->connection->prepare($querycreate);

            $this->title = htmlspecialchars( strip_tags($this->title) );
            $this->director = htmlspecialchars( strip_tags($this->director) );
            $this->showing = htmlspecialchars( strip_tags($this->showing) );
            $this->casts = htmlspecialchars( strip_tags($this->casts) );


            $statement->bindParam(1, $this->title );
            $statement->bindParam(2, $this->director );
            $statement->bindParam(3, $this->showing );
            $statement->bindParam(4, $this->casts );



            // Check if Director Exists
            $isPresent = $this->checkdirector($this->director);
            if (!$isPresent) {
                echo json_encode(
                    array('message' => 'Director does not Exists')
                );
                return false;
            }else{
                if ($statement->execute()) {
                    return true;
                }
    
                printf("Error: %s.\n", $statement->error);
    
                return false;
            }



            
        }




        // Movie update
        public function updatemovie(){
            $querycreate = '
                UPDATE '.
                $this->table
                .' 
                SET
                    m_title = ?,
                    m_director = ?,
                    m_showing = ?,
                    m_casts = ?
                WHERE m_id = ?
            ';

            $statement = $this->connection->prepare($querycreate);

            $this->title = htmlspecialchars( strip_tags($this->title) );
            $this->director = htmlspecialchars( strip_tags($this->director) );
            $this->showing = htmlspecialchars( strip_tags($this->showing) );
            $this->casts = htmlspecialchars( strip_tags($this->casts) );
            $this->id = htmlspecialchars( strip_tags($this->id) );


            $statement->bindParam(1, $this->title );
            $statement->bindParam(2, $this->director );
            $statement->bindParam(3, $this->showing );
            $statement->bindParam(4, $this->casts );
            $statement->bindParam(5, $this->id );



            // Check if Director Exists
            $isPresent = $this->checkdirector($this->director);
            if (!$isPresent) {
                echo json_encode(
                    array('message' => 'Director does not Exists')
                );
                return false;
            }else{
                if ($statement->execute()) {
                    return true;
                }
    
                printf("Error: %s.\n", $statement->error);
    
                return false;
            }
   
        }


        public function deletemovie(){

            $deletequery = 'DELETE FROM ' . $this->table . ' WHERE m_id = ?';

            $statement = $this->connection->prepare($deletequery);

            $this->id = htmlspecialchars( strip_tags($this->id) );

            $statement->bindParam(1, $this->id );

            if ($statement->execute()) {
                return true;
            }

            printf("Error: %s.\n", $statement->error);

            return false;
        }

    }

?>