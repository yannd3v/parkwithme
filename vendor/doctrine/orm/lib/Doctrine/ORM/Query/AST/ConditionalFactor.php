<?php

declare(strict_types=1);

namespace Doctrine\ORM\Query\AST;

/**
 * ConditionalFactor ::= ["NOT"] ConditionalPrimary
 *
 * @link    www.doctrine-project.org
 */
class ConditionalFactor extends Node
{
    /** @var bool */
    public $not = false;

    /** @var ConditionalPrimary */
    public $conditionalPrimary;

    /** @param ConditionalPrimary $conditionalPrimary */
    public function __construct($conditionalPrimary, bool $not = false)
    {
        $this->conditionalPrimary = $conditionalPrimary;
        $this->not = $not;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch($sqlWalker)
    {
        return $sqlWalker->walkConditionalFactor($this);
    }
}
