<?php

declare(strict_types=1);

namespace App\Application\Actions;

use App\Application\Actions\ActionBase;
use App\Application\Actions\Htm;

class HomeAction extends ActionBase {

   public function index($req, $res, $args){
      $this->init($req, $res, $args);
      return $this->htm(Htm::home());
   }
}
