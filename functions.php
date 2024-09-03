<?php

$conn = require_once 'connection.php';

function Index() {
    header("Content-type: text/html; charset=utf-8");
    $produtos = GetProdutos()['produtos'];
    require_once '..\Views\index.php';
    die();
}

function GetProdutos() {
    global $conn;

    $sql = "SELECT
                *
            FROM
                tb_produto";
    $smt = $conn->prepare($sql);
    $smt->execute();
    $rep = $smt->fetchAll();

    return ['ok' => true, 'produtos' => $rep];
}

function AlterarProduto($cd) {
    global $conn;

    if (empty($_POST) || !(
        isset($_POST['nome']) ||
        isset($_POST['qt']) ||
        isset($_POST['ds'])
    )) {
        return ['ok' => false, 'msg' => 'Dados de envio inválidos'];
    }

    $sql = "UPDATE
                tb_produto
            SET
                nm_produto = :nome,
                qt_pote = :qt,
                ds_produto = :ds
            WHERE
                cd_produto = :cd";
    $smt = $conn->prepare($sql);
    $smt->bindParam(':nome', $cd, PDO::PARAM_INT);
    $smt->bindParam(':nome', $_POST['nome']);
    $smt->bindParam(':qt', $_POST['qt'], PDO::PARAM_INT);
    $smt->bindParam(':ds', $_POST['ds']);
    $smt->execute();

    return ['ok' => true, 'msg' => 'Produto Alterado com sucesso!'];
}

function CadastrarProduto() {
    global $conn;

    if (empty($_POST) || !(
        isset($_POST['nome']) ||
        isset($_POST['qt']) ||
        isset($_POST['ds'])
    )) {
        return ['ok' => false, 'msg' => 'Dados de envio inválidos'];
    }

    $sql = "INSERT INTO
                tb_produto
            SET
                nm_produto = :nome,
                qt_pote = :qt,
                ds_produto = :ds";
    $smt = $conn->prepare($sql);
    $smt->bindParam(':nome', $_POST['nome']);
    $smt->bindParam(':qt', $_POST['qt'], PDO::PARAM_INT);
    $smt->bindParam(':ds', $_POST['ds']);
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
