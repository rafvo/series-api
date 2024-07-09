<?php

namespace App\Exceptions;

use Exception;

class TokenInvalidException extends Exception
{
  public function __construct($message = "Token inválido", $code = 401)
  {
    parent::__construct($message, $code);
  }
}
