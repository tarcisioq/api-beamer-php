<?php

namespace Beamer\Auth;

use Beamer\Exception\InvalidCredentialsException;
use Beamer\Beamer;

/**
 * Class Credentials
 *
 * The Credentials object that allows acccess to the API
 *
 * @package Beamer\Merchant
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
class Credentials
{

    /**
     * The encrypted credentials closure
     *
     * @var \Closure
     */
    private $credentials;

    /**
     * The Constructor
     *
     * @param callable $closure
     */
    private function __construct(callable $closure)
    {
        $this->credentials = $closure;
    }

    /**
     * Invoke the credentials closure
     *
     * @return array
     */
    public function __invoke()
    {
        $closure = $this->credentials;
        return $closure();
    }

    /**
     * Serialize the credentials object
     *
     * @return string
     */
    public function serialize()
    {
        return serialize($this->__invoke());
    }

    /**
     * Unserialize a credentials object
     *
     * @param string $serialized
     * @return Credentials
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $key   = $data['Beamer-Api-Key'];

        $this->credentials = (function () use ($key) {
            return ['Beamer-Api-Key'=>$key];
        });

        return $this;
    }

    /**
     * Factory a Credentials object
     *
     * @param        $key
     * @param        $login
     * @param string $environment
     * @param bool   $check
     * @return Credentials
     */
    public static function factory($key, $environment = Beamer::ENV_DEFAULT, $check = false)
    {
        $credentials = new self(function () use ($key){
            return ['Beamer-Api-Key'=>$key];
        });

        if ($check) {
            $result = Beamer::ping($credentials,null,$environment)->isSuccess();
        } else {
            $result = true;
        }

        if ($result) {
            return $credentials;
        } else {
            throw new InvalidCredentialsException();
        }
    }
}