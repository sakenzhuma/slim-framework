<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

const M = ['GET','POST', 'PUT', 'DELETE'];
const A = '\App\Application\Actions';

return function (App $app) {
    $app->options('/{routes:.*}', fn($req, $res) => $res);
    $app->get('/', A . '\HomeAction:index');
    $app->post('/auth/{name}', A . '\AuthAction:index');
    $app->get('/list/{name}', A . '\ListAction:index');
    /*
    $app->get('/api/unit/{name}', A . '\UnitAction:index');
    $app->get('/api/list/{name}', A . '\Common\ListAction:index');
    $app->post('/api/upload/{name}', A . '\Common\UploadAction:index');
    $app->get('/api/download', A . '\Common\DownloadAction:index');
    $app->map(M,'/api/profile/{name}', A . '\Common\ProfileAction:index');
    $app->map(M,'/api/nodes/{node}[/{id}]', A . '\Common\NodeAction:index');
    */
};
