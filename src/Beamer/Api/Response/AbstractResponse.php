<?php

namespace Beamer\Api\Response;

/**
 * Class AbstractResponse
 *
 * Abstraction of a Response object
 *
 * @package Beamer\Api\Response
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
abstract class AbstractResponse
{

    /**
     * The request state
     *
     * @var bool
     */
    protected $result = false;

    /**
     * The error message
     *
     * @var null|string
     */
    protected $error = null;

    /**
     * The Constructor
     *
     * @param bool  $result
     * @param null  $error
     * @param array $options
     */
    public function __construct($result = false, $error = null, $response = [])
    {
        if (is_bool($result) && $result) {
            $this->result = $response;
        }

        if (is_string($error)) {
            $this->error = $error;
        }
    }

    /**
     * Get the response state
     *
     * @return bool
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Check if request was successful
     *
     * @return bool
     */
    public function isSuccess()
    {
        return is_array($this->result) && sizeof($this->result)>0 ? true : false;
    }

    /**
     * Get the error message
     *
     * @return null|string
     */
    public function getError()
    {
        return $this->error;
    }
}