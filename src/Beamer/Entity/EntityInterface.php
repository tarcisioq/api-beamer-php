<?php

namespace Beamer\Entity;

/**
 * Interface EntityInterface
 *
 * Provides a common interface for entities and wrappers that represents an object in API
 *
 * @package Beamer\Entity
 * @author Tarcisio Quaresma <tarcisio@iset.com.br>
 */
interface EntityInterface
{

    /**
     * Export the entity to array
     *
     * @return array
     */
    public function toArray();
}