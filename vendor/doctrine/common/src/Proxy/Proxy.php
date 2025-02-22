<?php

namespace Doctrine\Common\Proxy;

use Closure;
use Doctrine\Persistence\Proxy as BaseProxy;

/**
 * Interface for proxy classes.
 *
 * @template T of object
 * @template-extends BaseProxy<T>
 */
interface Proxy extends BaseProxy
{
    /**
     * Marks the proxy as initialized or not.
     *
     * @param bool $initialized
     *
     * @return void
     */
    public function __setInitialized($initialized);

    /**
     * Sets the initializer callback to be used when initializing the proxy. That
     * initializer should accept 3 parameters: $proxy, $method and $params. Those
     * are respectively the proxy object that is being initialized, the method name
     * that triggered initialization and the parameters passed to that method.
     *
     * @return void
     */
    public function __setInitializer(?Closure $initializer = null);

    /**
     * Retrieves the initializer callback used to initialize the proxy.
     *
     * @return Closure|null
     * @see __setInitializer
     *
     */
    public function __getInitializer();

    /**
     * Sets the callback to be used when cloning the proxy. That initializer should accept
     * a single parameter, which is the cloned proxy instance itself.
     *
     * @return void
     */
    public function __setCloner(?Closure $cloner = null);

    /**
     * Retrieves the callback to be used when cloning the proxy.
     *
     * @return Closure|null
     * @see __setCloner
     *
     */
    public function __getCloner();

    /**
     * Retrieves the list of lazy loaded properties for a given proxy
     *
     * @return array<string, mixed> Keys are the property names, and values are the default values
     *                              for those properties.
     */
    public function __getLazyProperties();
}
