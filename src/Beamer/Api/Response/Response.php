<?php

namespace Beamer\Api\Response;

/**
 * Class QueryResponse
 *
 * Query Response object wrapper
 *
 * @package Beamer\Api\Response
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class Response extends AbstractResponse
{


    /**
     * The Constructor
     *
     * @param bool  $result
     * @param null  $error
     * @param array $options
     */
    public function __construct($result = false, $error = null, $response = [])
    {
        parent::__construct($result,$error,$response);

    }

}