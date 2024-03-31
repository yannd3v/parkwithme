<?php

declare(strict_types=1);

namespace Doctrine\ORM\Query;

use Doctrine\ORM\AbstractQuery;

/**
 * Interface for walkers of DQL ASTs (abstract syntax trees).
 *
 * @psalm-import-type QueryComponent from Parser
 */
interface TreeWalker
{
    /**
     * Initializes TreeWalker with important information about the ASTs to be walked.
     *
     * @param AbstractQuery $query The parsed Query.
     * @param ParserResult $parserResult The result of the parsing process.
     * @param mixed[] $queryComponents The query components (symbol table).
     * @psalm-param array<string, QueryComponent> $queryComponents The query components (symbol table).
     */
    public function __construct($query, $parserResult, array $queryComponents);

    /**
     * Returns internal queryComponents array.
     *
     * @return array<string, array<string, mixed>>
     * @psalm-return array<string, QueryComponent>
     */
    public function getQueryComponents();

    /**
     * Sets or overrides a query component for a given dql alias.
     *
     * @param string $dqlAlias The DQL alias.
     * @param array<string, mixed> $queryComponent
     * @psalm-param QueryComponent $queryComponent
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function setQueryComponent($dqlAlias, array $queryComponent);

    /**
     * Walks down a SelectStatement AST node.
     *
     * @return void
     */
    public function walkSelectStatement(AST\SelectStatement $AST);

    /**
     * Walks down a SelectClause AST node.
     *
     * @param AST\SelectClause $selectClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkSelectClause($selectClause);

    /**
     * Walks down a FromClause AST node.
     *
     * @param AST\FromClause $fromClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkFromClause($fromClause);

    /**
     * Walks down a FunctionNode AST node.
     *
     * @param AST\Functions\FunctionNode $function
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkFunction($function);

    /**
     * Walks down an OrderByClause AST node.
     *
     * @param AST\OrderByClause $orderByClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkOrderByClause($orderByClause);

    /**
     * Walks down an OrderByItem AST node, thereby generating the appropriate SQL.
     *
     * @param AST\OrderByItem $orderByItem
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkOrderByItem($orderByItem);

    /**
     * Walks down a HavingClause AST node.
     *
     * @param AST\HavingClause $havingClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkHavingClause($havingClause);

    /**
     * Walks down a Join AST node.
     *
     * @param AST\Join $join
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkJoin($join);

    /**
     * Walks down a SelectExpression AST node.
     *
     * @param AST\SelectExpression $selectExpression
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkSelectExpression($selectExpression);

    /**
     * Walks down a QuantifiedExpression AST node.
     *
     * @param AST\QuantifiedExpression $qExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkQuantifiedExpression($qExpr);

    /**
     * Walks down a Subselect AST node.
     *
     * @param AST\Subselect $subselect
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkSubselect($subselect);

    /**
     * Walks down a SubselectFromClause AST node.
     *
     * @param AST\SubselectFromClause $subselectFromClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkSubselectFromClause($subselectFromClause);

    /**
     * Walks down a SimpleSelectClause AST node.
     *
     * @param AST\SimpleSelectClause $simpleSelectClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkSimpleSelectClause($simpleSelectClause);

    /**
     * Walks down a SimpleSelectExpression AST node.
     *
     * @param AST\SimpleSelectExpression $simpleSelectExpression
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkSimpleSelectExpression($simpleSelectExpression);

    /**
     * Walks down an AggregateExpression AST node.
     *
     * @param AST\AggregateExpression $aggExpression
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkAggregateExpression($aggExpression);

    /**
     * Walks down a GroupByClause AST node.
     *
     * @param AST\GroupByClause $groupByClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkGroupByClause($groupByClause);

    /**
     * Walks down a GroupByItem AST node.
     *
     * @param AST\PathExpression|string $groupByItem
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkGroupByItem($groupByItem);

    /**
     * Walks down an UpdateStatement AST node.
     *
     * @return void
     */
    public function walkUpdateStatement(AST\UpdateStatement $AST);

    /**
     * Walks down a DeleteStatement AST node.
     *
     * @return void
     */
    public function walkDeleteStatement(AST\DeleteStatement $AST);

    /**
     * Walks down a DeleteClause AST node.
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkDeleteClause(AST\DeleteClause $deleteClause);

    /**
     * Walks down an UpdateClause AST node.
     *
     * @param AST\UpdateClause $updateClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkUpdateClause($updateClause);

    /**
     * Walks down an UpdateItem AST node.
     *
     * @param AST\UpdateItem $updateItem
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkUpdateItem($updateItem);

    /**
     * Walks down a WhereClause AST node.
     *
     * WhereClause or not, the appropriate discriminator sql is added.
     *
     * @param AST\WhereClause $whereClause
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkWhereClause($whereClause);

    /**
     * Walk down a ConditionalExpression AST node.
     *
     * @param AST\ConditionalExpression $condExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkConditionalExpression($condExpr);

    /**
     * Walks down a ConditionalTerm AST node.
     *
     * @param AST\ConditionalTerm $condTerm
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkConditionalTerm($condTerm);

    /**
     * Walks down a ConditionalFactor AST node.
     *
     * @param AST\ConditionalFactor $factor
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkConditionalFactor($factor);

    /**
     * Walks down a ConditionalPrimary AST node.
     *
     * @param AST\ConditionalPrimary $primary
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkConditionalPrimary($primary);

    /**
     * Walks down an ExistsExpression AST node.
     *
     * @param AST\ExistsExpression $existsExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkExistsExpression($existsExpr);

    /**
     * Walks down a CollectionMemberExpression AST node.
     *
     * @param AST\CollectionMemberExpression $collMemberExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkCollectionMemberExpression($collMemberExpr);

    /**
     * Walks down an EmptyCollectionComparisonExpression AST node.
     *
     * @param AST\EmptyCollectionComparisonExpression $emptyCollCompExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkEmptyCollectionComparisonExpression($emptyCollCompExpr);

    /**
     * Walks down a NullComparisonExpression AST node.
     *
     * @param AST\NullComparisonExpression $nullCompExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkNullComparisonExpression($nullCompExpr);

    /**
     * Walks down an InExpression AST node.
     *
     * @param AST\InExpression $inExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkInExpression($inExpr);

    /**
     * Walks down an InstanceOfExpression AST node.
     *
     * @param AST\InstanceOfExpression $instanceOfExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkInstanceOfExpression($instanceOfExpr);

    /**
     * Walks down a literal that represents an AST node.
     *
     * @param AST\Literal $literal
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkLiteral($literal);

    /**
     * Walks down a BetweenExpression AST node.
     *
     * @param AST\BetweenExpression $betweenExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkBetweenExpression($betweenExpr);

    /**
     * Walks down a LikeExpression AST node.
     *
     * @param AST\LikeExpression $likeExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkLikeExpression($likeExpr);

    /**
     * Walks down a StateFieldPathExpression AST node.
     *
     * @param AST\PathExpression $stateFieldPathExpression
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkStateFieldPathExpression($stateFieldPathExpression);

    /**
     * Walks down a ComparisonExpression AST node.
     *
     * @param AST\ComparisonExpression $compExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkComparisonExpression($compExpr);

    /**
     * Walks down an InputParameter AST node.
     *
     * @param AST\InputParameter $inputParam
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkInputParameter($inputParam);

    /**
     * Walks down an ArithmeticExpression AST node.
     *
     * @param AST\ArithmeticExpression $arithmeticExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkArithmeticExpression($arithmeticExpr);

    /**
     * Walks down an ArithmeticTerm AST node.
     *
     * @param mixed $term
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkArithmeticTerm($term);

    /**
     * Walks down a StringPrimary that represents an AST node.
     *
     * @param mixed $stringPrimary
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkStringPrimary($stringPrimary);

    /**
     * Walks down an ArithmeticFactor that represents an AST node.
     *
     * @param mixed $factor
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkArithmeticFactor($factor);

    /**
     * Walks down an SimpleArithmeticExpression AST node.
     *
     * @param AST\SimpleArithmeticExpression $simpleArithmeticExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkSimpleArithmeticExpression($simpleArithmeticExpr);

    /**
     * Walks down a PathExpression AST node.
     *
     * @param AST\PathExpression $pathExpr
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkPathExpression($pathExpr);

    /**
     * Walks down a ResultVariable that represents an AST node.
     *
     * @param string $resultVariable
     *
     * @return void
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function walkResultVariable($resultVariable);

    /**
     * Gets an executor that can be used to execute the result of this walker.
     *
     * @param AST\DeleteStatement|AST\UpdateStatement|AST\SelectStatement $AST
     *
     * @return Exec\AbstractSqlExecutor
     * @deprecated This method will be removed from the interface in 3.0.
     *
     */
    public function getExecutor($AST);
}
