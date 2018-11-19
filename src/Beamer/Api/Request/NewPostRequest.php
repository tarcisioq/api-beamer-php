<?php

namespace Beamer\Api\Request;

use Beamer\Beamer;
use Beamer\Post\Post;

/**
 * Class QueryRequest
 *
 * Query Request object implementation
 *
 * @package Beamer\Api\Request
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class NewPostRequest extends AbstractRequest implements RequestInterface
{


    /**
     * The Post object
     *
     * @var Post
     */
    private $post = null;

    /**
     * The Constructor
     *
     * @param string $command
     */
    public function __construct()
    {
        $this->setContext(self::CONTEXT_POST);
    }


    /**
     * Compile the request
     *
     * @param Beamer $beamer
     * @return string
     */
    public function compile(Beamer $beamer)
    {
        $language    = $beamer->getLanguage();
        $test        = (bool)$beamer->getEnvironment()->isTest();

        $data = [
            'language' => [$language],
        ];
        if (!is_null($this->post)) {
            $post_data = $this->post->toArray();
            $data = array_merge($data,$post_data);
        }
        return json_encode($data);
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }
}