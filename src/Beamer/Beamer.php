<?php
namespace Beamer;

use Beamer\Api\ContextInterface;
use Beamer\Post\Filter;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Beamer\Api\CommandInterface;
use Beamer\Api\Request\NewPostRequest;
use Beamer\Api\Request\ListPostsRequest;
use Beamer\Api\Request\RequestInterface;
use Beamer\Api\Response\AbstractResponse;
use Beamer\Api\Response\Builder\BuilderInterface;
use Beamer\Api\Response\Builder\ResponseBuilder;
use Beamer\Api\Response\Response;
use Beamer\Environment\EnvironmentInterface;
use Beamer\Environment\Production;
use Beamer\Environment\Sandbox;
use Beamer\Exception\InvalidBuilderException;
use Beamer\Exception\InvalidEnvironmentException;
use Beamer\Exception\InvalidLanguageException;
use Beamer\Exception\BeamerException;
use Beamer\Auth\Credentials;
use Beamer\Post\Post;

/**
 * Class  Beamer
 *
 * The Beamer client wrapper
 *
 * @package Beamer
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class Beamer
{

    const ENV_PRODUCTION = 'production';
    const ENV_SANDBOX    = 'sandbox';
    const ENV_DEFAULT    = self::ENV_PRODUCTION;

    const LANGUAGE_ENGLISH = 'EN';
    const LANGUAGE_SPANISH = 'ES';
    const LANGUAGE_PORTUGUESE = 'PT';
    const LANGUAGE_DEFAULT    = self::LANGUAGE_PORTUGUESE;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var EnvironmentInterface
     */
    protected $environment;

    /**
     * @var BuilderInterface
     */
    protected $builder;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $credentials = null;

    /**
     * The Constructor
     *
     * @param EnvironmentInterface $env
     * @param BuilderInterface     $builder
     * @param string               $language
     * @param string               $partnerId
     */
    public function __construct(EnvironmentInterface $env, BuilderInterface $builder, $language = self::LANGUAGE_DEFAULT)
    {
        $this->httpClient = new Client();

        $this->setEnvironment($env);
        $this->setBuilder($builder);
        $this->setLanguage($language);
    }

    /**
     * Set the API language
     *
     * @param string $language
     */
    private function setLanguage($language = self::LANGUAGE_DEFAULT)
    {
        switch ($language) {
            case null:
                $this->language = self::LANGUAGE_DEFAULT;
                break;
            case self::LANGUAGE_ENGLISH:
                $this->language = self::LANGUAGE_ENGLISH;
                break;
            case self::LANGUAGE_PORTUGUESE:
                $this->language = self::LANGUAGE_PORTUGUESE;
                break;
            case self::LANGUAGE_SPANISH:
                $this->language = self::LANGUAGE_SPANISH;
                break;
            default:
                throw new InvalidLanguageException();
        }
    }

    /**
     * Get the current language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the environment instance
     *
     * @param EnvironmentInterface $env
     */
    private function setEnvironment(EnvironmentInterface $env)
    {
        $this->environment = $env;
    }

    /**
     * Get the current environment
     *
     * @return EnvironmentInterface
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Set the response builder
     *
     * @param BuilderInterface $builder
     */
    private function setBuilder(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Set the credentials objects
     *
     * @param Credentials $credentials
     * @return Beamer
     */
    public function setCredentials(Credentials $credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * Get the credentials
     *
     * @return Credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Create a post in API
     *
     * @param Post $transaction
     * @return Response
     */
    public function publish(Post $post)
    {
        $request = new NewPostRequest();
        $request->setPost($post);

        return $this->request($request);
    }

    public function getPosts(Filter $filter)
    {

        $request = new ListPostsRequest();
        $request->setFilter($filter);

        return $this->request($request);
    }

    /**
     * Perform a request in API
     *
     * @param RequestInterface $request
     * @return AbstractResponse
     *
     * @throws BeamerException
     */
    public function request(RequestInterface $request)
    {
        try {
            $url = $this->environment->getUrl($request->getContext());

            $body = $request->compile($this);

            $credentials = $this->getCredentials();
            $headers = array_merge($this->environment->getHeaders(),$credentials());

            if ($request->getMethod() == "GET") $options = array("query" => $body);
            else $options = array("body" => $body);

            $options = array_merge($options, ['headers' => $headers], $this->environment->getOptions());
            $response = $this->httpClient->request($request->getMethod(),$url,$options);

            return $this->builder->build($request,$response);
        } catch (RequestException $e) {
            throw new BeamerException('A request error occurred',0,$e);
        }
    }

    /**
     * Check the API and credentials statuses
     *
     * @param Credentials $credentials
     * @param string      $language
     * @param string      $environment
     * @return AbstractResponse
     */
    public static function ping(Credentials $credentials, $language = null, $environment = null)
    {
        $instance = self::factory($language,$environment);
        $instance->setCredentials($credentials);

        $request = new NewPostRequest(CommandInterface::PING);
        $request->setContext(NewPostRequest::CONTEXT_PING);

        return $instance->request($request);
    }

    /**
     * Get a new instance of the Beamer client
     *
     * @param string           $language
     * @param string           $environment
     * @param BuilderInterface $builder
     * @return Beamer
     */
    public static function factory($language = self::LANGUAGE_DEFAULT, $environment = self::ENV_DEFAULT, BuilderInterface $builder = null)
    {
        if (is_null($environment)) {
            $environment = self::ENV_DEFAULT;
        }

        if ($environment == self::ENV_PRODUCTION) {
            $environment = new Production();
        } elseif ($environment == self::ENV_SANDBOX) {
            $environment = new Sandbox();
        } elseif (!$environment instanceof EnvironmentInterface) {
            throw new InvalidEnvironmentException();
        }

        if (is_null($builder)) {
            $builder = new ResponseBuilder();
        } elseif (!$builder instanceof BuilderInterface) {
            throw new InvalidBuilderException();
        }

        return new self($environment,$builder,$language);
    }
}