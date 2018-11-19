<?php

namespace Beamer\Exception;

/**
 * Class InvalidEnvironmentException
 *
 * @package Beamer\Exception
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class InvalidEnvironmentException extends BeamerException
{

    protected $message = 'The environment must be an environment constant of Beamer class or an implementation of EnvironmentInterface';
}