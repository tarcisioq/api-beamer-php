<?php

namespace Beamer\Exception;

/**
 * Class InvalidLanguageException
 *
 * @package Beamer\Exception
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class InvalidLanguageException extends BeamerException
{

    protected $message = 'The specified language is not valid, please use the predefined constants in Beamer class';
}