<?php
    $host = "localhost";
    $user = "3daw";
    $pass = "3daw";
    $db = "av2";

   

    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        $object = new stdClass();

        $codigo = $PUT["codigo_de_barras"];
        $velho_codigo = $PUT["velho_codigo"];
        $nome = $PUT["nome"];
        $fabricante = $PUT["fabricante"];
        $categoria = $PUT["categoria"];
        $tipo = $PUT["tipo"];
        $preco_de_venda = $PUT["preco_de_venda"];
        $quantidade = $PUT["quantidade"];
        $peso = $PUT["peso"];
        $descricao = $PUT["descricao"];

        if(!$codigo || !$velho_codigo|| !$nome || !$fabricante || !$categoria || !$tipo || !$preco_de_venda || !$quantidade || !$peso || !$descricao){
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
      
        $sql = "SELECT * FROM produto where codigo_de_barras like %".$velho_codigo ."%";
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

        $filePath = "";

        $fileName = $_FILES['file_produto']['image'];
        if($fileName)
            $filePath = $_FILES['file_alunos']['tmp_name'];


        $sql = " UPDATE  produt SET codigo_de_barras = \'$codigo\' nome = \'$nome\', fabricante = \'$fabricante\', categoria = \'$categoria\', tipo = \'$tipo\', preco_venda = $preco_de_venda, quantidade_estoque = $quantidade,  peso = $peso, descricao = \'$descricao\', link_imagem = \'$filePath\', data_inclusao = NOW(), ativo = 1) "
        . "WHERE codigo_de_barras = \'$codigo\'";
 
        $result =  $conn->query($sql);
        
        if($result){
            echo json_encode("Inserido com sucesso !");
        } else {
            echo json_encode("Erro ao inserir o produto.");
        }
    
    }
?>
