<?php
require '../bootstrap.php';

use App\Controllers\GrandezaEletricaController;
use Slim\App;
use Slim\Container;

// phpinfo();
// die();

/**
 * Container
 */
$container = new Container();

/**
 * Injeta a conexão com o banco de dados.
 *
 * @return \Doctrine\DBAL\Connection
 */
$container['Connection'] = function () {
    $config = new \Doctrine\DBAL\Configuration();
    $connectionParameters = [
        'user' => $_ENV['MYSQL_USER'],
        'host' => $_ENV['MYSQL_HOST'],
        'driver' => 'pdo_mysql',
        'password' => $_ENV['MYSQL_PASSWORD'],
        'port' => $_ENV['MYSQL_PORT'],
        'dbname' => $_ENV['MYSQL_DATABASE']
    ];
    return \Doctrine\DBAL\DriverManager::getConnection($connectionParameters, $config);
};

/**
 * Injeta GrandezaEletricaController
 * @param $container
 * @return GrandezaEletricaController
 */
$container[GrandezaEletricaController::class] = function ($container)
{
    return new \App\Controllers\GrandezaEletricaController(
        new \App\Services\GrandezaEletricaService(
            $container['Connection'],
            new \App\Repositories\GrandezaEletricaRepository($container['Connection'])
        )
    );
};

/**
 * Define configuração de middleware e de debug
 */
$container->get('settings')
    ->replace([
        'debug' => true,
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true
]);

/**
 * Instancia o Slim
 */
$slim = new App($container);


$slim->get('/', function() {
    return "Primeira rota.";
});

$slim->get('/grandezas-eletricas', GrandezaEletricaController::class . ':retrieveAll');
$slim->post('/grandezas-eletricas', GrandezaEletricaController::class . ':create');

// debugd('chegou aqui');

$slim->run();

