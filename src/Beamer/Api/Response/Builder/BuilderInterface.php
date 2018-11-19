<?php

namespace Beamer\Api\Response\Builder;

use Beamer\Api\Request\RequestInterface;
use Beamer\Api\Response\AbstractResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface BuilderInterface
 *
 * Provides a common interface to build response objects based on request context
 *
 * @package Beamer\Api\Response\Builder
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
interface BuilderInterface
{
    /**
     * Build a response object
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param string            $context
     * @return AbstractResponse
     */
    public function build(RequestInterface $request, ResponseInterface $response, $context = null);
}