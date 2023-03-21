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

    public function check_id(){
        $query = 'SELECT q.id
        CASE WHEN q.id IS NULL THEN 'False' ELSE 'True' FROM ' . $this->table . ' 
        q WHERE q.id = ? LIMIT 1 OFFSET 0';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        }
    
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

        

        //set properties
        $this->id = $row['id'];
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];
        }

    //create quote
        public function create() {
            //create query
            $query = 'INSERT INTO ' . $this->table . ' (id, quote, author, category)
            VALUES (:id, :quote, :author, :category)';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category = htmlspecialchars(strip_tags($this->category));
            

            //bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author', $this->author);
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
            SET (id, quote, author_id, category_id) = (:id, :quote, :author_id, :category_id)
            WHERE id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
           

            //bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

    
            

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
     }
     ?>