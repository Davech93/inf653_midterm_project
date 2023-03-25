<?php

    class Author{
        //DB Stuff
        private $conn;
        private $table = 'authors';


        //Author Properties
        public $author;
        public $id;
       

        //constructor with DB
        public function __construct($db){
        $this->conn = $db;
        }

     //GET authors
        public function read(){
            //create query
            $query = 'SELECT
            a.id,
            a.author
           FROM 
            ' . $this->table . ' a
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
        a.author
      FROM 
      ' . $this->table . ' a
        WHERE
            a.id = ?
            LIMIT 1 OFFSET 0';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //bind ID
        $stmt->bindParam(1, $this->id);

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            //set properties
            $this->id = $row['id'];
            $this->author = $row['author'];
        }
        else {
            $this->id = false;
            $this->author =false;
        }

        if($row>0){
            return true;
        } else {
            return false;
        }
    }

    //create author
        public function create() {
            //create query
            $query = 'INSERT INTO ' . $this->table . ' ( author)
            VALUES ( :author)';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
         
            $this->author = htmlspecialchars(strip_tags($this->author));
            

            //bind data
            
            $stmt->bindParam(':author', $this->author);

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
            SET (id, author) = (:id, :author)
            WHERE id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->author = htmlspecialchars(strip_tags($this->author));
           

            //bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);
    
            

            //execute query
            if($stmt->execute()){
                return true;
            }
            //print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);

            return false;
        }


         //delete category
         public function delete(){
            //create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
        printf("Error: %s. \n", $stmt->error);
        
        return false;
        }


        public function isValidAutId($model){

           
        
                $result = $model->read_single();
                if($model->id && $model->author) {
                    
                   return true;
                } else {
                    return false;
                }
                }
            
            

            public function lastId(){
                $stmt2 = $this->conn->lastInsertId();
                $result = ($stmt2);
                
                return $result;
            }
    


    public function isValid($model, $id){        
        $model->id = $this->id;
        $result = $model->read_single();
        return $result;
    }

}
     
     ?>