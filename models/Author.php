<?php

    class Author{
        //DB Stuff
        private $conn;
        private $table = 'authors';


        //Author Properties
        public $author;
        public $id;
        public $title;
        public $body;
       

        //constructor with DB
        public function __construct($db){
        $this->conn = $db;

        }

     //GET authors
        public function read(){
            //create query
            $query = 'SELECT
            a.id,
            a.author,
            a.title,
            a.body
           FROM 
            ' . $this->$table . ' a
            ORDER BY
                a.id DESC';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;
        }
    
    
    //Get single author
    public function read_single(){
        $query = 'SELECT
        a.id,
        a.author,
        a.title,
        a.body;


        FROM ' . $this->$table . '
        WHERE
            a.id = ?
            LIMIT 0, 1';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //bind ID
        $stmt->bindParam(1, $this->id);

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //set properties
        $this->id = $row['id'];
        $this->author = $row['author'];
        $this->title = $row['title'];
        $this->body = $row['body'];
        }

    //create author
        public function create() {
            //create query
            $query = 'INSERT INTO ' . $this->table . '
            SET
                id = :id,
                author = :author
                title = :title,
                body = :body';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));

            //bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);

            //execute query
            if($stmt->execute()){
                return true;
            }
            //print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);

            return false;
        }

        //update author
        public function update() {
            //create query
            $query = 'UPDATE ' . $this->table . '
            SET
                id = :id,
                author = :author
                title = :title,
                body = :body
                WHERE
                id = ?';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));

            //bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);

            //execute query
            if($stmt->execute()){
                return true;
            }
            //print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);

            return false;
        }


        //delete author
        public function delete(){
            //create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':id, $this->id');

        //execute query
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
        printf("Error: %s. \n", $stmt->error);
        
        return false;
        }
     }
     ?>