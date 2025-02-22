<?php

declare(strict_types=1);

namespace Doctrine\ORM\Query\AST;

/**
 * EmptyCollectionComparisonExpression ::= CollectionValuedPathExpression "IS" ["NOT"] "EMPTY"
 *
 * @link    www.doctrine-project.org
 */
class EmptyCollectionComparisonExpression extends Node
{
    /** @var PathExpression */
    public $expression;

    /** @var bool */
    public $not;

    /** @param PathExpression $expression */
    public function __construct($expression, bool $not = false)
    {
        $this->expression = $expression;
        $this->not = $not;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch($sqlWalker)
    {
        return $sqlWalker->walkEmptyCollectionComparisonExpression($this);
    }
}
