<?php 
    require "../.env";

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8"); 
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); 
    header("Access-Control-Max-Age: 3600"); 
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
    
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    echo $requestMethod;

    $password = getenv("PASSWORD");
    $servername = "localhost:3306";
    $username = "root";
    $name = "Charlie"; // Not yet dynamic, just a hardcoded test value

    try {
      $conn = new PDO("mysql:host=$servername;dbname=nasty", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //$statement = $conn->query("SELECT * FROM cats");
      $sql = "SELECT * FROM cats order by name = :name";
      $statement = $conn->prepare($sql);
      $statement->execute(array('name' => $name));
      
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($result);

    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }


    // echo $password; 
?> 