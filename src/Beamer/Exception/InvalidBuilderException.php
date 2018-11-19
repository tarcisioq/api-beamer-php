<?php

namespace Beamer\Exception;

/**
 * Class InvalidBuilderException
 *
 * @package Beamer\Exception
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class InvalidBuilderException extends BeamerException
{

    protected $message = 'The specified builder is not valid, the builder must be an implementation of BuilderInterface';
}