<?php

namespace Beamer\Post;

use Beamer\Beamer;

/**
 * Class Filter
 *
 * Filter object wrapper
 *
 * @package Beamer\Category
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class Filter
{

    protected $query = null;

    protected $date = null;

    protected $maxResults = 100;

    protected $page = null;

    protected $published = true;

    /**
     * The Constructor
     */
    public function __construct()
    {
    }

    /**
     * Export object as array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'filter' => $this->query,
            "date" => $this->date,
            "maxResults" => $this->maxResults,
            "page" => $this->page,
            "published" => $this->published ? "true" : "false"
        ];
    }

    /**
     * @param null $query
     * @return Filter
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @param bool $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }
}