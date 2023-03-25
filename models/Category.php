<?php

    class Category{
        //DB Stuff
        private $conn;
        private $table = 'categories';


        //Categories Properties
        public $category;
        public $id;
       

        //constructor with DB
        public function __construct($db){
        $this->conn = $db;

        }

     //GET categories
        public function read(){
            //create query
            $query = 'SELECT
            c.id,
            c.category
           FROM 
            ' . $this->table . ' c
            ORDER BY
                c.id DESC';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;
        }
    
    
    //Get single author
    public function read_single(){
        $query = 'SELECT
        c.id,
        c.category
      FROM 
      ' . $this->table . ' c
        WHERE
            c.id = ?
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
            $this->category = $row['category'];
        }
        else {
            $this->id = false;
            $this->category = false;
        }
        }

    //create category
        public function create() {
            //create query
            $query = 'INSERT INTO ' . $this->table . ' (category)
            VALUES (:category)';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->category = htmlspecialchars(strip_tags($this->category));
            

            //bind data
            
            $stmt->bindParam(':category', $this->category);

            //execute query
            if($stmt->execute()){
                return true;
            }
            //print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);

            return false;
        }

        //update category
        public function update() {
            //create query
            $query = 'UPDATE ' . $this->table . '
            SET (id, category) = (:id, :category)
            WHERE id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->category = htmlspecialchars(strip_tags($this->category));
           

            //bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);
    
            

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


        public function isValidCatId($model){

            //$model->id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
        
            
                $result = $model->read_single();
                if($model->id && $model->category) {
                    
                   return true;
                } else {

                    return false;
                }
                }
            
            }

            public function lastId(){
                $stmt2 = $this->conn->lastInsertId();
                $result = ($stmt2);
                
                return $result;
            }
        
     
     ?>