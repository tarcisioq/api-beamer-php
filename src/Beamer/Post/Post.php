<?php

namespace Beamer\Post;

use Beamer\Category;
use Beamer\Entity\EntityInterface;

/**
 * Class Post
 *
 * Post object wrapper
 *
 * @package Beamer\Transaction
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class Post implements EntityInterface
{

    /**
     * Transaction type constants
     */
    const FEEDBACK  = TRUE;
    const REACTIONS = TRUE;
    const AUTOOPEN  = FALSE;
    const PUBLISH   = TRUE;

    /**
     * The Tittle
     *
     * @var string
     */
    protected $title = null;

    /**
     * The Content
     *
     * @var string
     */
    protected $content = null;

    /**
     * The Category
     *
     * @var Category
     */
    protected $category = null;

    /**
     * The publish
     *
     * @var boolean
     */
    protected $publish = self::PUBLISH;

    /**
     * The FEEDBACK
     *
     * @var BOOL
     */
    protected $feedback = self::FEEDBACK;

    /**
     * The reactions
     *
     * @var BOOL
     */
    protected $reactions = self::REACTIONS;

    /**
     * The country
     *
     * @var bool
     */
    protected $autopen = self::AUTOOPEN;

    /**
     * The USER EMAIL FOR POST
     *
     * @var string
     */
    protected $userEmail = null;

    protected $filter = null;

    /**
     * The Constructor
     */
    public function __construct($publish=true){
        $this->publish = $publish;
    }

    /**
     * Export object as array
     * 
     * @return array
     */
    public function toArray()
    {

        $datePublish = new \DateTime();
        return [
            "publish" => $this->publish,
            'date'=>$datePublish->format("Y-m-d\TH:i:s"),
            "category" => $this->getCategory(),
            "title" => [$this->getTitle()],
            "content" => [$this->getContent()],
            "enableFeedback" => true,
            "enableReactions" => true,
            "autoOpen" => false,
            "userEmail"=>$this->userEmail,
            "linkUrl" => null,
            "linkText" => null,
            "filter" => $this->filter
       ];
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the category
     *
     * @param Category $category
     * @return Category
     */
    public function setCategory($category)
    {
        $this->category = (string)$category;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $userEmail
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @param null $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }
}