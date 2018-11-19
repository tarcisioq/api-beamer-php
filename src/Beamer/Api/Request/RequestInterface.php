<?php

namespace Beamer\Api\Request;

use Beamer\Api\ContextInterface;
use Beamer\Beamer;

/**
 * Interface RequestInterface
 *
 * Define a common interface for request object implementations
 *
 * @package Beamer\Api\Request
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
interface RequestInterface extends ContextInterface
{

    /**
     * The Constructor
     */
    public function __construct();

    /**
     * Compile the request into a plaintext payload
     *
     * @param Beamer $beamer
     * @return string
     */
    public function compile(Beamer $beamer);
}