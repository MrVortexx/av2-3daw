<?php
    $host = "localhost";
    $user = "3daw";
    $pass = "3daw";
    $db = "av2";

   

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        $object = new stdClass();

        $codigo = $POST["codigo_de_barras"];
        $nome = $POST["nome"];
        $fabricante = $POST["fabricante"];
        $categoria = $POST["categoria"];
        $tipo = $POST["tipo"];
        $preco_de_venda = $POST["preco_de_venda"];
        $quantidade = $POST["quantidade"];
        $peso = $POST["peso"];
        $descricao = $POST["descricao"];

        if(!$codigo || !$nome || !$fabricante || !$categoria || !$tipo || !$preco_de_venda || !$quantidade || !$peso || !$descricao){
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
      
        $filePath = "";

        $fileName = $_FILES['file_produto']['image'];
        if($fileName)
            $filePath = $_FILES['file_alunos']['tmp_name'];


        $sql = "INSERT INTO produto (codigo_de_barras, nome, fabricante, categoria, tipo, preco_venda, quantidade_estoque, peso, descricao, link_imagem, data_inclusao, ativo)"
                . " VALUES('$codigo', '$nome', '$fabricante', '$categoria', '$tipo', $preco_de_venda, $quantidade, $peso, '$descricao', '$filePath', NOW(), TRUE)";
 
        $result =  $conn->query($sql);
        
        if($result){
            echo json_encode("Inserido com sucesso !");
        } else {
            echo json_encode("Erro ao inserir o produto.");
        }
    
    }
?>
