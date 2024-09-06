<?php

declare(strict_types=1);

namespace App\Application\Actions;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Application\Constants\Msg;
use App\Application\Constants\CS;

class ActionBase
{
   public Container $container;
   protected mixed $db;
   protected Request $req;
   protected Response $res;
   protected array $args;
   protected array $b;

   public function __construct(Container $container)
   {
      $this->container = $container;
      $this->db = $this->container->get('db');
   }

   protected function init($req, $res): void {
      $this->req = $req;
      $this->res = $res;
   }

   protected function htm(string $str = ''): Response {
      $this->res->getBody()->write($str);
      return $this->res;
   }

   protected function setBody(){
      $this->b = $this->req->getParsedBody();
   }

   protected function json($data = []): Response {
      $this->res->getBody()->write(json_encode($data));
      return $this->res->withHeader('content-type', 'application/json');
   }
}
