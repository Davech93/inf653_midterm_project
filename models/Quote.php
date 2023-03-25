<?php

    class Quote{
        //DB Stuff
        private $conn;
        private $table = 'quotes';


        //Categories Properties
        public $quote;
        public $id;
        public $author;
        public $category;
       public $category_id;
       public $author_id;

        //constructor with DB
        public function __construct($db){
        $this->conn = $db;

        }

     //GET categories
        public function read(){
            //create query
            $query = 'SELECT
            a.author,
            c.category,
            q.id,
            q.quote
           FROM 
            ' . $this->table . ' q 
            LEFT JOIN categories c 
                ON c.id = q.category_id
            LEFT JOIN authors a 
                ON a.id = q.author_id
            ORDER BY
                q.id DESC';

            

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;
        }
    
    
    //Get single author
    
    
        public function read_single(){
        $query = 'SELECT
        q.id,
        q.quote,
        a.author,
        c.category
      FROM 
      ' . $this->table . ' q
        LEFT JOIN categories c 
            ON c.id = q.category_id
        LEFT JOIN authors a 
            ON a.id = q.author_id
        WHERE
            q.id = ?
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
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];
        }
        else {
            $this->id = false;
            $this->quote = false;
            $this->author = false;
            $this->category = false;
        }
        }

    //create quote
        public function create() {
            //create query
            $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id)
            VALUES (:quote, :author_id, :category_id)';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            

            //bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);



            if($stmt->execute()){
                return true;
            }
            
            //print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);

            return false;
        }

        public function lastId(){
            $stmt2 = $this->conn->lastInsertId();
            $result = ($stmt2);
            
            return $result;
        }
        //update category
        public function update() {
            //create query
            $query = 'UPDATE ' . $this->table . ' 
            SET quote = :quote
            WHERE id = :id
            AND author_id = :author_id
            AND category_id = :category_id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
           
            // $stmt = $this->conn->prepare("UPDATE " .  $this->table . " SET quote = :quote WHERE id = :id AND author_id = :author_id AND category_id = :category_id");

            //bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

           if( $stmt->execute()){
            return true;
           } 

           
          
                
        

          
            

            // execute query
            // if($stmt->execute()){
            //     return true;
            // }
            // print error if something goes wrong
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
        if ($stmt->execute()){
            return true;
        }

        
        //print error if something goes wrong
        printf("Error: %s. \n", $stmt->error);
        
            return false;
        }

    //     public function isValidQuoId($model){

    //         // $model->id = isset($_GET['author_id']) ? $_GET['author_id'] :die();
         
    //              $result = $model->read_single();
    //              if($model->id && $model->quote) {
                     
    //                 return true;
    //              } else {
    //                  return false;
    //              }
    //              }

        public function isValidQuoId($model){

            //$model->id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
        
            
                $result = $model->read_single();
                if($model->id && $model->quote) {
                    
                   return $model->id;
                } else {

                    return false;
                }
                }


                public function isValidCatId(){
                    $query = 'SELECT
                    q.id,
                    q.quote,
                    q.author_id,
                    q.category_id
                  FROM 
                  ' . $this->table . ' q
                    WHERE
                        q.category_id = :category_id
                        AND q.author_id = :author_id
                        AND q.id = :id
                        LIMIT 1 OFFSET 0';
            
                    //prepare statement
                    $stmt = $this->conn->prepare($query);
            
                    //bind ID
                    $stmt->bindParam(':category_id', $this->category_id);
                    $stmt->bindParam(':author_id', $this->author_id);
                    $stmt->bindParam(':id', $this->id);
            
                    //Execute Query
                    $stmt->execute();
            
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
                    
                    if($row) {
                        //set properties
                    $this->id = $row['id'];
                    $this->quote = $row['quote'];
                    $this->author_id = $row['author_id'];
                    $this->category_id = $row['category_id'];
                    }
                    else {
                        $this->id = false;
                        $this->quote = false;
                        $this->author_id = false;
                        $this->category_id = false;
                    }

                    if($this->quote && $this->category_id){
                        return true;
                    } else{
                        return false;
                    }

                    }


                    public function isValidAutId(){
                        $query = 'SELECT
                        q.id,
                        q.quote,
                        q.author_id,
                        q.category_id
                      FROM 
                      ' . $this->table . ' q
                        WHERE
                            q.author_id = :author_id
                            AND q.category_id = :category_id
                            AND q.id = :id
                            LIMIT 1 OFFSET 0';
                
                        //prepare statement
                        $stmt = $this->conn->prepare($query);
                
                        //bind ID
                        $stmt->bindParam(':author_id', $this->author_id);
                        $stmt->bindParam(':category_id', $this->category_id);
                        $stmt->bindParam(':id', $this->id);
                
                        //Execute Query
                        $stmt->execute();
                
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                        
                        if($row) {
                            //set properties
                        $this->id = $row['id'];
                        $this->quote = $row['quote'];
                        $this->author_id = $row['author_id'];
                        $this->category_id = $row['category_id'];
                        }
                        else {
                            $this->id = false;
                            $this->quote = false;
                            $this->author_id = false;
                            $this->category_id = false;
                        }
    
                        if($this->quote && $this->author_id){
                            return true;
                        } else{
                            return false;
                        }
    
                        }

                
    
    
     ?>