<?php
$routes = [
    '/' => ['controller' => 'Index', 'method' => 'GET'],
    '/produtos' => ['controller' => 'GetProdutos', 'method' => 'GET'],
    '/alterar/[0-9]+' => ['controller' => 'AlterarProduto', 'method' => 'PUT'],
    '/cadastrar' => ['controller' => 'CadastrarProduto', 'method' => 'POST'],
    '/deletar/[0-9]+' => ['controller' => 'DeletarProduto', 'method' => 'DELETE']
];

function exactMatchUriInArrayRoutes($uri, $routes)
{
    return (array_key_exists($uri, $routes)) ?
    [$uri => $routes[$uri]] :
    null;
}

function regularExpressionMatchArrayRoutes($uri, $routes)
{
    $match = array_filter(
        $routes,
        function ($value) use ($uri) {
            $regex = str_replace('/', '\/', ltrim($value, '/'));
            return preg_match("/^$regex$/", ltrim($uri, '/'));
        },
        ARRAY_FILTER_USE_KEY
    );

    return !empty($match)?$match:null;
}

function params($uri, $matchedUri)
{
    if (!empty($matchedUri)) {
        $matchedToGetParams = array_keys($matchedUri)[0];
        return array_values(array_diff(
            $uri,
            explode('/', ltrim($matchedToGetParams, '/'))
        ));
    }
    return null;
}

function router()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    global $routes;
    //$routes = require 'routes.php';
    //$requestMethod = $_SERVER['REQUEST_METHOD'];

    $matchedUri = exactMatchUriInArrayRoutes($uri, $routes);

    $params = null;
    if (empty($matchedUri)) {
        $params = [];
        $matchedUri = regularExpressionMatchArrayRoutes($uri, $routes);
        $uri = explode('/', ltrim($uri, '/'));
        $params = params($uri, $matchedUri);
        //$params = paramsFormat($uri, $params);
    }

    // dd($matchedUri);
    // var_dump($matchedUri);
    
    if (!empty($matchedUri))
        $matchedUri = array_values($matchedUri)[0];

    if ($matchedUri['method'] != $_SERVER['REQUEST_METHOD']) {
        echo json_encode(['ok' => false, 'msg' => 'Requisição recusada']);
        die();
    }

    return [$matchedUri['controller'], $params];
}
