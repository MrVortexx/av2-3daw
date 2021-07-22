<?php
    $host = "localhost";
    $user = "3daw";
    $pass = "3daw2";
    $db = "av2";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $object = new stdClass();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $db = new mysqli($host, $user, $pass, $db);
        if ($db->connect_error) {
            $object->message = "Nao foi possivel conectar ao banco de dados: " . $db->connect_error;
            header("HTTP/1.1 500 Internal Server Error");
            die(json_encode($object));
        }
    

        $sql = "SELECT codigo_de_barras, nome, categoria, preco_venda, quantidade_estoque FROM produto";
        $result =  $conn->query($sql);
        if($result === TRUE){
            $rows = array();
            while($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
            echo json_encode($rows);      
        } else {
            $object->message = "Erro ao fazer sql dos produtos.";
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode($object);
        }
    
    
    }
?>
