<?php

header("Content-type: application/json; charset=utf-8");

if (isset($_GET['html']) && $_GET['html']) {
    header("Content-type: text/html; charset=utf-8");
}

require_once 'router.php';
require_once 'functions.php';

$data = router();

if ($data[0] === null) {
    echo json_encode(['ok' => false, 'msg' => 'Caminho não encontrado']);
    die();
}


$result = call_user_func_array($data[0], $data[1]??[]);

//var_dump($result);
//var_dump($data);

function utf8_encode_recursive(&$input) {
    array_walk_recursive($input, function(&$item, $key) {
        if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = utf8_encode($item);
        }
    });
}
utf8_encode_recursive($result);
echo json_encode($result);
