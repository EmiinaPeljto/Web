<?php

class ExamDao {

    private $conn;

    /**
     * constructor of dao class
     */
    public function __construct(){
        try {
          /** TODO
           * List parameters such as servername, username, password, schema. Make sure to use appropriate port
           */
          
          $servername = "127.0.0.1";
          $username = "root";
          $password = "Seceruprahu1";
          $schema = "webfinal";
          $port = 3306;
      
          /** TODO
           * Create new connection
           */
          $this->conn = new PDO(
            "mysql:host=" . $servername . ";dbname=" . $schema . ";port=" . $port,
            $username,
            $password
          );
          //echo "Connected Successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    /** TODO
     * Implement DAO method used to get customer information
     */
    public function get_customers(){

      $sql = 'SELECT * FROM customers';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /** TODO
     * Implement DAO method used to get customer meals
     */
    public function get_customer_meals($customer_id) {
      $sql = 'SELECT f.name AS "food_name", f.brand AS "food_brand", m.created_at AS "meal_date" FROM customers c 
      JOIN meals m ON c.id = m.customer_id 
      JOIN foods f ON m.food_id = f.id 
      WHERE c.id = :customer_id ';
      $params = ['customer_id' => $customer_id];
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
     * Implement DAO method used to save customer data
     */
    public function add_customer($data){
      $sql = 'INSERT INTO customers(first_name, last_name, birth_date)
              VALUES	(:first_name, :last_name, :birth_date);';
      $params = [
        'first_name'=> $data['first_name'],
        'last_name'=> $data['last_name'],
        'birth_date'=> $data['birth_date']
      ];
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
     * Implement DAO method used to get foods report
     */
    
public function get_foods_report(){
  $sql = 'SELECT  f.id, f.name, f.brand, f.image_url,
          SUM(CASE WHEN fn.nutrient_id = 1 THEN fn.quantity ELSE 0 END) AS Energy,
          SUM(CASE WHEN fn.nutrient_id = 2 THEN fn.quantity ELSE 0 END) AS Protein,
          SUM(CASE WHEN fn.nutrient_id = 3 THEN fn.quantity ELSE 0 END) AS Fat,
          SUM(CASE WHEN fn.nutrient_id = 4 THEN fn.quantity ELSE 0 END) AS Fiber,
          SUM(CASE WHEN fn.nutrient_id = 5 THEN fn.quantity ELSE 0 END) AS Carbs
          FROM foods f
          JOIN food_nutrients fn ON f.id = fn.food_id
          GROUP BY f.id
          ORDER BY f.id DESC
          LIMIT 10';

  $stmt = $this->conn->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//**Delete */

public function delete_food($food_id) {
  $sql = 'DELETE FROM foods WHERE id = :id;'; 
  $params = ['id' => $food_id];
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  
}


//**Get all foods */
public function get_foods(){

  $sql = 'SELECT * FROM foods ORDER BY id DESC LIMIT 10;';
  $stmt = $this->conn->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);

}



}

//** Edit */


?>
