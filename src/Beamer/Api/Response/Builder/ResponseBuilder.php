<?php

namespace Beamer\Api\Response\Builder;

use Beamer\Api\ContextInterface;
use Beamer\Api\Request\RequestInterface;
use Beamer\Api\Response\Response;
use Beamer\Exception\InvalidContextException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseBuilder
 *
 * Build a response object based on request context
 *
 * @package Beamer\Api\Response\Builder
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class ResponseBuilder implements ContextInterface, BuilderInterface
{

    /**
     * The context
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

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param null              $context
     * @return null|Response|Response
     */
    public function build(RequestInterface $request, ResponseInterface $response, $context = null)
    {
        if (!is_null($context)) {
            $this->setContext($context);
        } else {
            $this->setContext($request->getContext());
        }

        switch ($this->context) {
            case self::CONTEXT_POST:
            case self::CONTEXT_POSTS:
            case self::CONTEXT_PING:
                return $this->buildResponse($response);
                break;
            default:
                return null;
        }
    }

    /**
     * Build a query request response object
     *
     * @param ResponseInterface $response
     * @return Response
     */
    private function buildResponse(ResponseInterface $response)
    {
        $response = $response->getBody();

        if ($data = json_decode($response,true)) {
            $query_response = new Response(true, null,$data);
        } else
            $query_response = new Response(false,$response);

        return $query_response;
    }

    public function getMethod()
    {
        // TODO: Implement getMethod() method.
    }
}