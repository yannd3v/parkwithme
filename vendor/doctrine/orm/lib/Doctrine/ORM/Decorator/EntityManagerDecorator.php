<?php

declare(strict_types=1);

namespace Doctrine\ORM\Decorator;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ObjectManagerDecorator;

use function func_get_arg;
use function func_num_args;
use function get_debug_type;
use function method_exists;
use function sprintf;
use function trigger_error;

use const E_USER_NOTICE;

/**
 * Base class for EntityManager decorators
 *
 * @extends ObjectManagerDecorator<EntityManagerInterface>
 */
abstract class EntityManagerDecorator extends ObjectManagerDecorator implements EntityManagerInterface
{
    public function __construct(EntityManagerInterface $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return $this->wrapped->getConnection();
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionBuilder()
    {
        return $this->wrapped->getExpressionBuilder();
    }

    /**
     * {@inheritdoc}
     *
     * @psalm-param class-string<T> $className
     *
     * @psalm-return EntityRepository<T>
     *
     * @template T of object
     */
    public function getRepository($className)
    {
        return $this->wrapped->getRepository($className);
    }

    /**
     * {@inheritdoc}
     */
    public function getClassMetadata($className)
    {
        return $this->wrapped->getClassMetadata($className);
    }

    /**
     * {@inheritdoc}
     */
    public function beginTransaction()
    {
        $this->wrapped->beginTransaction();
    }

    /**
     * {@inheritdoc}
     */
    public function transactional($func)
    {
        return $this->wrapped->transactional($func);
    }

    /**
     * {@inheritdoc}
     */
    public function wrapInTransaction(callable $func)
    {
        if (!method_exists($this->wrapped, 'wrapInTransaction')) {
            trigger_error(
                sprintf('Calling `transactional()` instead of `wrapInTransaction()` which is not implemented on %s', get_debug_type($this->wrapped)),
                E_USER_NOTICE
            );

            return $this->wrapped->transactional($func);
        }

        return $this->wrapped->wrapInTransaction($func);
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        $this->wrapped->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function rollback()
    {
        $this->wrapped->rollback();
    }

    /**
     * {@inheritdoc}
     */
    public function createQuery($dql = '')
    {
        return $this->wrapped->createQuery($dql);
    }

    /**
     * {@inheritdoc}
     */
    public function createNamedQuery($name)
    {
        return $this->wrapped->createNamedQuery($name);
    }

    /**
     * {@inheritdoc}
     */
    public function createNativeQuery($sql, ResultSetMapping $rsm)
    {
        return $this->wrapped->createNativeQuery($sql, $rsm);
    }

    /**
     * {@inheritdoc}
     */
    public function createNamedNativeQuery($name)
    {
        return $this->wrapped->createNamedNativeQuery($name);
    }

    /**
     * {@inheritdoc}
     */
    public function createQueryBuilder()
    {
        return $this->wrapped->createQueryBuilder();
    }

    /**
     * {@inheritdoc}
     */
    public function getReference($entityName, $id)
    {
        return $this->wrapped->getReference($entityName, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getPartialReference($entityName, $identifier)
    {
        return $this->wrapped->getPartialReference($entityName, $identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        $this->wrapped->close();
    }

    /**
     * {@inheritdoc}
     */
    public function copy($entity, $deep = false)
    {
        return $this->wrapped->copy($entity, $deep);
    }

    /**
     * {@inheritdoc}
     */
    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->wrapped->lock($entity, $lockMode, $lockVersion);
    }

    /**
     * {@inheritdoc}
     */
    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        return $this->wrapped->find($className, $id, $lockMode, $lockVersion);
    }

    /**
     * {@inheritdoc}
     */
    public function flush($entity = null)
    {
        $this->wrapped->flush($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function refresh($object)
    {
        $lockMode = null;

        if (func_num_args() > 1) {
            $lockMode = func_get_arg(1);
        }

        $this->wrapped->refresh($object, $lockMode);
    }

    /**
     * {@inheritdoc}
     */
    public function getEventManager()
    {
        return $this->wrapped->getEventManager();
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        return $this->wrapped->getConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function isOpen()
    {
        return $this->wrapped->isOpen();
    }

    /**
     * {@inheritdoc}
     */
    public function getUnitOfWork()
    {
        return $this->wrapped->getUnitOfWork();
    }

    /**
     * {@inheritdoc}
     */
    public function getHydrator($hydrationMode)
    {
        return $this->wrapped->getHydrator($hydrationMode);
    }

    /**
     * {@inheritdoc}
     */
    public function newHydrator($hydrationMode)
    {
        return $this->wrapped->newHydrator($hydrationMode);
    }

    /**
     * {@inheritdoc}
     */
    public function getProxyFactory()
    {
        return $this->wrapped->getProxyFactory();
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return $this->wrapped->getFilters();
    }

    /**
     * {@inheritdoc}
     */
    public function isFiltersStateClean()
    {
        return $this->wrapped->isFiltersStateClean();
    }

    /**
     * {@inheritdoc}
     */
    public function hasFilters()
    {
        return $this->wrapped->hasFilters();
    }

    /**
     * {@inheritdoc}
     */
    public function getCache()
    {
        return $this->wrapped->getCache();
    }
}
