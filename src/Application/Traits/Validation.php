<?php
declare(strict_types=1);

namespace App\Application\Traits;
use App\Application\Constants\Msg;
use Valitron\Validator;

trait Validation {
   static function isValid(mixed $b, array $rule, string $message = Msg::INVALID): void
   {
      $v = new Validator($b);
      $v->rules($rule);
      if (! $v->validate()) throw new \Exception($message, 422);
   }
}
