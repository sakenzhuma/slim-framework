<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';


class Foo {
   public function __invoke($name = "Apple"){
      printf("Say my name: %s \n", $name);
   }
}


$a = new Foo();
$a();
