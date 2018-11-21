<?php
require __DIR__.'/../vendor/autoload.php';

// importing the libraries
use \Beamer\Beamer;
use \Beamer\Auth\Credentials;
use \Beamer\Post\Filter;

// creating a credentials instance
$credentials = Credentials::factory('b_EAZfgUs/...');

$beamerApi = Beamer::factory(Beamer::LANGUAGE_PORTUGUESE);
$beamerApi->setCredentials($credentials);

$filter = new Filter();
$filter->setQuery("changelog");
//$filter->setDate("2018-01-01");
$filter->setPublished(true);

$posts = $beamerApi->getPosts($filter);
var_dump($posts->getResult());
?>