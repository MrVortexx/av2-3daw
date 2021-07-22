<?php
    $host = "localhost";
    $user = "3daw";
    $pass = "3daw";
    $db = "av2";

   

    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        $object = new stdClass();

        $codigo = $delete["codigo_de_barras"];

        if(!$codigo){
            $object->message = "Requisicao invalida";
            header("HTTP/1.1 400 Bad Request");
            die(json_encode($object));
        }

        $db = new mysqli($host, $user, $pass, $db);
       
        if ($db->connect_error) {
            $object->message = "Nao foi possivel conectar ao banco de dados: " . $db->connect_error;
            header("HTTP/1.1 500 Internal Server Error");
            die(json_encode($object));
        }
        $rows;
      
        $sql = "SELECT * FROM produto where codigo_de_barras = \'$codigo\'";
        $result =  $conn->query($sql);
        if($result === TRUE){
            $rows = array();
            while($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        if(count($rows) == 0){
            $object->message = "Produto nao encontrado";
            header("HTTP/1.1 404 Not Found");
            die(json_encode($object));
        }

        $sql = "DELETE FROM  produto WHERE codigo = \'$codigo\'";
        $result =  $conn->query($sql);
        
        if($result){
            echo json_encode("Inserido com sucesso !");
        } else {
            echo json_encode("Erro ao inserir o produto.");
        }
    
    }
?>
