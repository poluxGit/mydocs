<?php

/**
 * RESTful API - Main Script - EntryPoint
 *
 * @author polux <polux@poluxfr.org>
 */
namespace MyGED;

require __DIR__ . '/../vendor/autoload.php';
// use MyGED\Core\Application as Application;
// use MyGED\Vault as Vault;
// use MyGED\Application\AppAPIRouter as AppAPI;
// use MyGED\Core\App as App;

use MyGED\Core\Application;
use MyGED\API\Router;

// Initialise Application!
Application::initApplication();

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

// Main Processing !
try {
    $API = new Router($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
    // TODO Gérer le retour avec code de retour en json et msg + data... aplha-02
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}

exit;
