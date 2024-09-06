<?php

declare(strict_types=1);
namespace App\Application\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\ActionBase;
use App\Application\Traits\Common;
use App\Application\Traits\Validation;
use App\Application\Constants\Msg;
use App\Application\Constants\CS;
use Firebase\JWT\JWT;

class ListAction extends ActionBase {

   use Common;
   use Validation;

   function index($req, $res, $args): Response {
      $this->init($req, $res);
      $name = self::es($args['name']);
      $rows = $this->db->select($name, '*');
      return $this->json($rows);
   }
}
