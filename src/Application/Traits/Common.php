<?php
declare(strict_types=1);

namespace App\Application\Traits;
use App\Application\Constants\Msg;

trait Common {

   static function xs(string $v): string
   {
      return trim(strip_tags($v));
   }

   static function es(string $v): string
   {
      return strtolower(trim(strip_tags($v)));
   }

   static function randomString(): string
   {
      $bytes = random_bytes(4);
      return strtoupper(bin2hex($bytes));
   }

   static function export($data, $file = 'export.txt'): void
   {
      $path = dirname(__DIR__) . '/../../logs/' . $file;
      file_put_contents($path, var_export($data, true));
   }

   static function fire($message = Msg::FAILED, $code = 500): void
   {
      throw new \Exception($message, $code);
   }

   static function verifyUser($row): void {
      if(! $row || ! $row['active']) self::fire(Msg::USER_NOT_EXIST);
   }
}
