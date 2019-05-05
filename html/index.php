<?php

require '../bootstrap.php';

use App\Controllers\GrandezaEletricaController;
use App\Controllers\FaltaDeEnergiaController;
use App\Middlewares\AccessControlAllow;
use Slim\App;
use Slim\Container;

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
 * Injeta FaltaDeEnergiaController
 */
$container[FaltaDeEnergiaController::class] = function ($container)
{
    return new \App\Controllers\FaltaDeEnergiaController(
        new \App\Services\FaltaDeEnergiaService(
            $container['Connection'],
            new \App\Repositories\FaltaDeEnergiaRepository($container['Connection'])
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

/**
 * Adiciona Middleware para corrigir o problema de
 * restrição de CORS
 */
$slim->add(new AccessControlAllow());

$slim->get('/', function() {
    return "Primeira rota.";
});

/**
 * Grandezas Elétricas
 */
$slim->get('/grandezas-eletricas', GrandezaEletricaController::class . ':retrieveAll');
$slim->get('/grandezas-eletricas/pesquisa/{filtros}', 
        GrandezaEletricaController::class . ':search');
$slim->post('/grandezas-eletricas', GrandezaEletricaController::class . ':create');

/**
 * Falta de Energia
 */

$slim->get('/faltas-de-energia', FaltaDeEnergiaController::class . ':retrieveAll' );
$slim->post('/faltas-de-energia', FaltaDeEnergiaController::class . ':create' );

$slim->run();

