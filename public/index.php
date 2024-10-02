<?php 
    require "../.env";

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8"); 
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); 
    header("Access-Control-Max-Age: 3600"); 
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
    
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    

    $password = getenv("PASSWORD");
    $servername = "localhost:3306";
    $username = "root";
    $name = "Charlie"; // Not yet dynamic, just a hardcoded test value

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);
    $conn = new PDO("mysql:host=$servername;dbname=nasty", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($requestMethod == "GET" && $uri[1] == "cats") {
        try {
            $statement = $conn->query("SELECT * FROM cats");
            // $sql = "SELECT * FROM cats";
            // $statement = $conn->prepare($sql);
            // $statement->execute(array('name' => $name));
            
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($result);

        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
    }
    else if ($requestMethod == "POST" && $uri[1] == "cats") {
        $input = (array) json_decode(file_get_contents('php://input'), true);
        // echo json_encode($input);

        // kun gør følgende hvis $input['name'] er udfyldt OG ikke er tom
        if (isset($input['name']) && trim($input['name'], " ") != "") {
            if (isset($input['color']) && trim($input['color'], " ") != "") { // server side validering
                $data = [
                    'name' => $input['name'],
                    'color' => $input['color']
                ];
        
                $sql = 'INSERT INTO cats VALUES(default, :name, :color)';
                $statement = $conn->prepare($sql);
                $statement->execute($data);

                $id = $conn->lastInsertId();
                $cat = (object) $input;
                $cat->id = $id;
                echo json_encode($cat);
            }
            else {
                echo json_encode(["error" => "Missing color"]);
            }
       } else {
           echo json_encode(["error" => "Missing name"]);
       }
        // kun gør ovenstående hvis $input['name'] er udfyldt OG ikke er tom

    }

    // echo $password; 
?> 