<?php

namespace Beamer\Api;

/**
 * Interface CommandInterface
 *
 * Define the available commands in API
 *
 * @package Beamer\Api
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
interface CommandInterface
{

    /**
     * Commands available in all API's
     */
    const PING = 'ping';

    /**
     * Commands available in Payment API
     */
    const NEW_POST      = 'posts';
    const PAYMENT_GET_PAYMENT_METHODS = 'GET_PAYMENT_METHODS';
    const PAYMENT_SUBMIT_TRANSACTION  = 'SUBMIT_TRANSACTION';

    /**
     * Commands available in Query API
     */
    const QUERY_ORDER_DETAIL                   = 'ORDER_DETAIL';
    const QUERY_ORDER_DETAIL_BY_REFERENCE_CODE = 'ORDER_DETAIL_BY_REFERENCE_CODE';
    const QUERY_TRANSACTION_RESPONSE_DETAIL    = 'TRANSACTION_RESPONSE_DETAIL';
}