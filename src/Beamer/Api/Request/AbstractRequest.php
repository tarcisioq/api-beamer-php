<?php

namespace Beamer\Api\Request;

use Beamer\Api\ContextInterface;
use Beamer\Exception\InvalidContextException;

/**
 * Class AbstractRequest
 *
 * Abstract of a Request object
 *
 * @package Beamer\Api\Request
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
abstract class AbstractRequest implements ContextInterface
{

    /**
     * The Context
     *
     * @var string
     */
    protected $context;

    /**
     * @inheritdoc
     */
    public function setContext($context)
    {
        switch ($context) {
            case self::CONTEXT_POST:
                $this->context = self::CONTEXT_POST;
                break;
            case self::CONTEXT_POSTS:
                $this->context = self::CONTEXT_POSTS;
                break;
            case self::CONTEXT_PING:
                $this->context = self::CONTEXT_PING;
                break;
            default:
                throw new InvalidContextException();
        }
    }

    /**
     * @inheritdoc
     */
    public function getContext()
    {
        return $this->context;
    }

    public function getMethod()
    {
        switch ($this->getContext()) {
            case ContextInterface::CONTEXT_POSTS:
                return "GET";
                break;
            case ContextInterface::CONTEXT_POST:
            case ContextInterface::CONTEXT_PING:
                return "POST";
                break;
            default:
                throw new InvalidContextException();
        }
    }
}