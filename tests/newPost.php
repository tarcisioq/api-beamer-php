<?php
require __DIR__ . '/../vendor/autoload.php';

// importing the libraries
use \Beamer\Beamer;
use \Beamer\Auth\Credentials;
use \Beamer\Post\Category;
use \Beamer\Post\Post;

// creating a credentials instance
$credentials = Credentials::factory('b_EAZfgj/vZ...');

$beamerApi = Beamer::factory(Beamer::LANGUAGE_PORTUGUESE);
$beamerApi->setCredentials($credentials);

$post = new Post(false);
$post->setUserEmail("tarcisio@iset.com.br");
$post->setCategory(Category::NEWS);
$post->setTitle("Teste de post");
$post->setContent("Teste de post");
$post->setFilter("teste");

$result = $beamerApi->publish($post);
?>