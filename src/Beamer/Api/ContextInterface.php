<?php

namespace Beamer\Api;

/**
 * Interface ContextInterface
 *
 * Define and implement context in requests and responses
 *
 * @package Beamer\Api
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
interface ContextInterface
{

    /**
     * Available request contexts
     */
    const CONTEXT_POST = 'post';
    const CONTEXT_POSTS   = 'posts';
    const CONTEXT_PING = 'ping';

    /**
     * Set the context
     *
     * @param string $context
     */
    public function setContext($context);

    /**
     * Get the context
     *
     * @return string
     */
    public function getContext();

    public function getMethod();
}