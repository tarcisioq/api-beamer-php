<?php

namespace Beamer\Exception;

/**
 * Class InvalidCredentialsException
 *
 * @package Beamer\Exception
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class InvalidCredentialsException extends BeamerException
{

    protected $message = 'The specified credentials are not valid, so the credentials object was not created';
}