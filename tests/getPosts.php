<?php
require __DIR__.'/../vendor/autoload.php';

// importing the libraries
use \Beamer\Beamer;
use \Beamer\Auth\Credentials;
use \Beamer\Post\Filter;

// creating a credentials instance
$credentials = Credentials::factory('b_EAZfgj/vZ...');

$beamerApi = Beamer::factory(Beamer::LANGUAGE_PORTUGUESE);
$beamerApi->setCredentials($credentials);

$filter = new Filter();
$filter->setQuery("changelog");
$filter->setPublished(true);

$posts = $beamerApi->getPosts($filter);
var_dump($posts->getResult());
?>