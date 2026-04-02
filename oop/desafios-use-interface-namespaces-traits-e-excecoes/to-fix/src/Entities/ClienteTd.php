<?php

namespace Fix\Entities;

class ClienteTd
{
   static int $id = -1;
   public function __construct(readonly public string $nome, readonly public string $email)
   {
      $this->id += 1;
   }
}
