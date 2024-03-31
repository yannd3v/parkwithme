<?php

declare(strict_types=1);

namespace Doctrine\ORM;

use Doctrine\Common\Cache\Cache as CacheDriver;
use Doctrine\Persistence\ObjectRepository;
use Exception;

use function get_debug_type;
use function implode;
use function sprintf;

/**
 * Base exception class for all ORM exceptions.
 *
 * @deprecated Use Doctrine\ORM\Exception\ORMException for catch and instanceof
 */
class ORMException extends Exception
{
    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\MissingMappingDriverImplementation
     *
     */
    public static function missingMappingDriverImpl()
    {
        return new self("It's a requirement to specify a Metadata Driver and pass it " .
            'to Doctrine\\ORM\\Configuration::setMetadataDriverImpl().');
    }

    /**
     * @param string $queryName
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\NamedQueryNotFound
     *
     */
    public static function namedQueryNotFound($queryName)
    {
        return new self('Could not find a named query by the name "' . $queryName . '"');
    }

    /**
     * @param string $nativeQueryName
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\NamedQueryNotFound
     *
     */
    public static function namedNativeQueryNotFound($nativeQueryName)
    {
        return new self('Could not find a named native query by the name "' . $nativeQueryName . '"');
    }

    /**
     * @param string $field
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Persisters\Exception\UnrecognizedField
     *
     */
    public static function unrecognizedField($field)
    {
        return new self(sprintf('Unrecognized field: %s', $field));
    }

    /**
     * @param string $class
     * @param string $association
     * @param string $given
     * @param string $expected
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\UnexpectedAssociationValue
     *
     */
    public static function unexpectedAssociationValue($class, $association, $given, $expected)
    {
        return new self(sprintf('Found entity of type %s on association %s#%s, but expecting %s', $given, $class, $association, $expected));
    }

    /**
     * @param string $className
     * @param string $field
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Persisters\Exception\InvalidOrientation
     *
     */
    public static function invalidOrientation($className, $field)
    {
        return new self('Invalid order by orientation specified for ' . $className . '#' . $field);
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\EntityManagerClosed
     *
     */
    public static function entityManagerClosed()
    {
        return new self('The EntityManager is closed.');
    }

    /**
     * @param string $mode
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\InvalidHydrationMode
     *
     */
    public static function invalidHydrationMode($mode)
    {
        return new self(sprintf("'%s' is an invalid hydration mode.", $mode));
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\MismatchedEventManager
     *
     */
    public static function mismatchedEventManager()
    {
        return new self('Cannot use different EventManager instances for EntityManager and Connection.');
    }

    /**
     * @param string $methodName
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Repository\Exception\InvalidMagicMethodCall::onMissingParameter()
     *
     */
    public static function findByRequiresParameter($methodName)
    {
        return new self("You need to pass a parameter to '" . $methodName . "'");
    }

    /**
     * @param string $entityName
     * @param string $fieldName
     * @param string $method
     *
     * @return ORMException
     * @deprecated Doctrine\ORM\Repository\Exception\InvalidFindByCall
     *
     */
    public static function invalidMagicCall($entityName, $fieldName, $method)
    {
        return new self(
            "Entity '" . $entityName . "' has no field '" . $fieldName . "'. " .
            "You can therefore not call '" . $method . "' on the entities' repository"
        );
    }

    /**
     * @param string $entityName
     * @param string $associationFieldName
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Repository\Exception\InvalidFindByCall::fromInverseSideUsage()
     *
     */
    public static function invalidFindByInverseAssociation($entityName, $associationFieldName)
    {
        return new self(
            "You cannot search for the association field '" . $entityName . '#' . $associationFieldName . "', " .
            'because it is the inverse side of an association. Find methods only work on owning side associations.'
        );
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Cache\Exception\InvalidResultCacheDriver
     *
     */
    public static function invalidResultCacheDriver()
    {
        return new self('Invalid result cache driver; it must implement Doctrine\\Common\\Cache\\Cache.');
    }

    /**
     * @return ORMException
     * @deprecated Doctrine\ORM\Tools\Exception\NotSupported
     *
     */
    public static function notSupported()
    {
        return new self('This behaviour is (currently) not supported by Doctrine 2');
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Cache\Exception\QueryCacheNotConfigured
     *
     */
    public static function queryCacheNotConfigured()
    {
        return new self('Query Cache is not configured.');
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Cache\Exception\MetadataCacheNotConfigured
     *
     */
    public static function metadataCacheNotConfigured()
    {
        return new self('Class Metadata Cache is not configured.');
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Cache\Exception\QueryCacheUsesNonPersistentCache
     *
     */
    public static function queryCacheUsesNonPersistentCache(CacheDriver $cache)
    {
        return new self('Query Cache uses a non-persistent cache driver, ' . get_debug_type($cache) . '.');
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Cache\Exception\MetadataCacheUsesNonPersistentCache
     *
     */
    public static function metadataCacheUsesNonPersistentCache(CacheDriver $cache)
    {
        return new self('Metadata Cache uses a non-persistent cache driver, ' . get_debug_type($cache) . '.');
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\ProxyClassesAlwaysRegenerating
     *
     */
    public static function proxyClassesAlwaysRegenerating()
    {
        return new self('Proxy Classes are always regenerating.');
    }

    /**
     * @param string $entityNamespaceAlias
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\UnknownEntityNamespace
     *
     */
    public static function unknownEntityNamespace($entityNamespaceAlias)
    {
        return new self(
            sprintf("Unknown Entity namespace alias '%s'.", $entityNamespaceAlias)
        );
    }

    /**
     * @param string $className
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\InvalidEntityRepository
     *
     */
    public static function invalidEntityRepository($className)
    {
        return new self(sprintf(
            "Invalid repository class '%s'. It must be a %s.",
            $className,
            ObjectRepository::class
        ));
    }

    /**
     * @param string $className
     * @param string $fieldName
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\MissingIdentifierField
     *
     */
    public static function missingIdentifierField($className, $fieldName)
    {
        return new self(sprintf('The identifier %s is missing for a query of %s', $fieldName, $className));
    }

    /**
     * @param string $className
     * @param string[] $fieldNames
     *
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Exception\UnrecognizedIdentifierFields
     *
     */
    public static function unrecognizedIdentifierFields($className, $fieldNames)
    {
        return new self(
            "Unrecognized identifier fields: '" . implode("', '", $fieldNames) . "' " .
            "are not present on class '" . $className . "'."
        );
    }

    /**
     * @return ORMException
     * @deprecated Use Doctrine\ORM\Persisters\Exception\CantUseInOperatorOnCompositeKeys
     *
     */
    public static function cantUseInOperatorOnCompositeKeys()
    {
        return new self("Can't use IN operator on entities that have composite keys.");
    }
}
