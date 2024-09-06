<?php

declare(strict_types=1);

namespace App\Application\Actions;
use App\Application\Actions\ActionBase;

class Htm
{
   static $tmp = __DIR__ . "/../../../tmp/";

   static function getHeader(): string {
      return file_get_contents(self::$tmp . 'header.html');
   }

   static function getFooter(): string {
      return file_get_contents(self::$tmp . 'footer.html');
   }

   static function getContent($content = ""): string {
      return self::getHeader() . $content . self::getFooter();
   }

   static function home($data = []): string {
      return self::getContent("<div class='container pa3'>Apple</div>");
   }
}
