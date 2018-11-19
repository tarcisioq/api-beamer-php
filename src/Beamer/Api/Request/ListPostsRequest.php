<?php

namespace Beamer\Api\Request;

use Beamer\Beamer;
use Beamer\Post\Filter;

/**
 * Class QueryRequest
 *
 * Query Request object implementation
 *
 * @package Beamer\Api\Request
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class ListPostsRequest extends AbstractRequest implements RequestInterface
{


    /**
     * The Filter object
     *
     * @var Filter
     */
    private $filter = null;

    /**
     * The Constructor
     *
     * @param string $command
     */
    public function __construct()
    {
        $this->setContext(self::CONTEXT_POSTS);
    }


    /**
     * Compile the request into a plaintext payload
     *
     * @param Beamer $beamer
     * @return string
     */
    public function compile(Beamer $beamer)
    {
        $language = $beamer->getLanguage();
        $test = (bool)$beamer->getEnvironment()->isTest();

        $data = [
            'language' => $language,
        ];
        if (!is_null($this->filter)) {
            $post_data = $this->filter->toArray();
            $data = array_merge($data, $post_data);
        }
        return $data;
    }

    /**
     * @return Post
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param Post $post
     */
    public function setFilter(Filter $filter)
    {
        $this->filter = $filter;
    }
}