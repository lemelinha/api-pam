<?php

$conn = require_once 'connection.php';

function Index() {
    header("Content-type: text/html; charset=utf-8");
    $produtos = GetProdutos()['produtos'];
    require_once './Views/index.php';
    die();
}

function GetProdutos($cd=null) {
    global $conn;

    $sql = "SELECT
                *
            FROM
                tb_produto";
    if ($cd){
        $sql .= " WHERE cd_produto = :cd";
    }
    
    $smt = $conn->prepare($sql);
    if ($cd){
        $smt->bindParam(':cd', $cd, PDO::PARAM_INT);
    }
    
    $smt->execute();
    $rep = $smt->fetchAll();
    
    if (isset($_GET['html']) && $_GET['html']) {
        require_once './Views/produtos.php';
        die();
    }
    
    return $cd?['ok' => true, 'produto' => $rep[0]]:['ok' => true, 'produtos' => $rep];
}

function AlterarProduto($cd) {
    global $conn;

    parse_str(file_get_contents("php://input"), $_PUT);
    if (empty($_PUT) || !(
        isset($_PUT['nome']) ||
        isset($_PUT['qt']) ||
        isset($_PUT['ds']) ||
        isset($_PUT['imagem'])
    )) {
        return ['ok' => false, 'msg' => 'Dados de envio inválidos'];
    }

    $sql = "UPDATE
                tb_produto
            SET
                nm_produto = :nome,
                qt_pote = :qt,
                ds_produto = :ds,
                url_imagem = :imagem
            WHERE
                cd_produto = :cd";
    $smt = $conn->prepare($sql);
    $smt->bindParam(':cd', $cd, PDO::PARAM_INT);
    $smt->bindParam(':nome', $_PUT['nome']);
    $smt->bindParam(':qt', $_PUT['qt'], PDO::PARAM_INT);
    $smt->bindParam(':ds', $_PUT['ds']);
    $smt->bindParam(':imagem', $_PUT['imagem']);
    $smt->execute();

    return ['ok' => true, 'msg' => 'Produto Alterado com sucesso!'];
}

function CadastrarProduto() {
    global $conn;

    if (empty($_POST) || !(
        isset($_POST['nome']) ||
        isset($_POST['qt']) ||
        isset($_POST['ds']) ||
        isset($_POST['imagem']))
    ) {
        return ['ok' => false, 'msg' => 'Dados de envio inválidos'];
    }

    $sql = "INSERT INTO
                tb_produto
            SET
                nm_produto = :nome,
                qt_pote = :qt,
                ds_produto = :ds,
                url_imagem = :imagem";
    $smt = $conn->prepare($sql);
    $smt->bindParam(':nome', $_POST['nome']);
    $smt->bindParam(':qt', $_POST['qt'], PDO::PARAM_INT);
    $smt->bindParam(':ds', $_POST['ds']);
    $smt->bindParam(':imagem', $_POST['imagem']);
    $smt->execute();

    return ['ok' => true, 'msg' => 'Produto Cadastrado com sucesso!'];
}

function DeletarProduto($cd) {
    global $conn;

    $sql = "DELETE FROM
                tb_produto
            WHERE
                cd_produto = :cd";
    $smt = $conn->prepare($sql);
    $smt->bindParam(':cd', $cd, PDO::PARAM_INT);
    $smt->execute();

    return ['ok' => true, 'msg' => 'Produto Deletado com sucesso!'];
}
