<?php

declare(strict_types=1);

use App\Application\Handlers\HttpErrorHandler;
use App\Application\Handlers\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use App\Application\Constants\CS;

require __DIR__ . '/../vendor/autoload.php';
$containerBuilder = new ContainerBuilder();

// Should be set to true in production
# $containerBuilder->enableCompilation(__DIR__ . '/../var/cache');

$settings = require __DIR__ . '/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();
// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();
$callableResolver = $app->getCallableResolver();

// Register middleware
// $middleware = require __DIR__ . '/middleware.php';
// $middleware($app);

$routes = require __DIR__ . '/routes.php';
$routes($app);

$settings = $container->get(SettingsInterface::class);
$displayErrorDetails = $settings->get('displayErrorDetails');

$logError = $settings->get('logError');
$logErrorDetails = $settings->get('logErrorDetails');

$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();
$responseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
register_shutdown_function($shutdownHandler);


$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logError, $logErrorDetails);
$errorMiddleware->setDefaultErrorHandler($errorHandler);


// ------------- My Additions -----------------

$app->add(new \Tuupola\Middleware\JwtAuthentication([
    "path" => ['/api'],
    "secret" => ["acme" => CS::APP_KEY],
    "algorithm" => ["amce" => "HS256"]
]));

$container->set('db', function () {
    return new \Medoo\Medoo([
        'type' => 'mysql', 'host' => '127.0.0.1', 'database' => 'nim',
        'username' => 'root', 'password' => '' // SET YOUR PASSWORD
    ]);
});

// Run App & Emit Response
$response = $app->handle($request);
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);
