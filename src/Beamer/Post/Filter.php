<?php

namespace Beamer\Post;

use Beamer\Beamer;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

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

    protected $showExpired = true;

    protected $maxResults = 100;

    protected $page = null;

    protected $published = true;

    /**
     * The Constructor
     */
    public function __construct($maxResults = 100,$page=null,$showExpired=true)
    {
        $this->maxResults = (int)$maxResults;
        $this->page = (int)$page;
        $this->setShowExpired($showExpired);
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
            "expired" => (bool)$this->showExpired,
            "maxResults" => $this->maxResults,
            "page" => $this->page,
            "published" => $this->published ? "true" : "false"
        ];
    }
    /**
     * @param datetime $dt
     * @format Y-m-d H:i:s
     */
    public function setDate($dateTime){
        try {
            if ($dt = new \DateTime($dateTime)) {
                $this->date = $dt->format("c");
            } else throw new \Exception("Invalid date time");
        } catch (\Exception $e){
            throw new \Exception("Invalid date time");
        }
    }

    /**
     * @param null $query
     * @return Filter
     */
    public function setQuery($filter)
    {
        $this->query = $filter;
    }

    /**
     * @param bool $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @param bool $showExpired
     */
    public function setShowExpired(bool $showExpired)
    {
        $this->showExpired = $showExpired;
    }
}