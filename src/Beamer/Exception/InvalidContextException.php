<?php

namespace Beamer\Exception;

/**
 * Class InvalidContextException
 *
 * @package Beamer\Exception
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class InvalidContextException extends BeamerException
{

    protected $message = 'The specified context is not valid, please use the ContextInterface constants';
}