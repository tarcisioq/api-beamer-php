<?php

namespace Beamer\Environment;

use Beamer\Api\ContextInterface;
use Beamer\Exception\InvalidContextException;

/**
 * Class Production
 *
 * Production environment object
 *
 * @package Beamer\Environment
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class Production implements EnvironmentInterface
{

    /**
     * URL for API's
     */
    const ENDPOINT   = 'https://api.getbeamer.com/v0';

    /**
     * The HTTP headers
     *
     * @var array
     */
    private $headers = ['Content-Type'=>'application/json','Accept'=>'application/json'];

    /**
     * Guzzle Http Client options
     *
     * @var array
     */
    private $options = [];

    /**
     * Test environment
     *
     * @var bool
     */
    private $test = false;

    /**
     * The Constructor
     */
    public function __construct(){}

    /**
     * Get the environment URL based on context
     *
     * @param string $context
     * @return string
     */
    public function getUrl($context)
    {
        switch ($context) {
            case ContextInterface::CONTEXT_POST:
                return self::ENDPOINT."/posts";
                break;
            case ContextInterface::CONTEXT_POSTS:
                return self::ENDPOINT."/posts";
                break;
            case ContextInterface::CONTEXT_PING:
                return self::ENDPOINT."/ping";
                break;
            default:
                throw new InvalidContextException();
        }
    }

    /**
     * Check if is test environment
     *
     * @return bool
     */
    public function isTest()
    {
        return $this->test;
    }

    /**
     * Get the HTTP headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Get Guzzle Http Client options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Export the environment to string
     *
     * @return string
     */
    public function __toString()
    {
        return 'production';
    }
}