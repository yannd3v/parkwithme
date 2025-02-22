<?php

namespace Doctrine\Common\Util;

use ArrayIterator;
use ArrayObject;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\Proxy;
use stdClass;

use function array_keys;
use function count;
use function end;
use function explode;
use function extension_loaded;
use function get_class;
use function html_entity_decode;
use function ini_get;
use function ini_set;
use function is_array;
use function is_object;
use function method_exists;
use function ob_end_clean;
use function ob_get_contents;
use function ob_start;
use function spl_object_hash;
use function strip_tags;
use function var_dump;

/**
 * Static class containing most used debug methods.
 *
 * @deprecated The Debug class is deprecated, please use symfony/var-dumper instead.
 *
 * @link   www.doctrine-project.org
 */
final class Debug
{
    /**
     * Private constructor (prevents instantiation).
     */
    private function __construct()
    {
    }

    /**
     * Prints a dump of the public, protected and private properties of $var.
     *
     * @link https://xdebug.org/
     *
     * @param mixed $var The variable to dump.
     * @param int $maxDepth The maximum nesting level for object properties.
     * @param bool $stripTags Whether output should strip HTML tags.
     * @param bool $echo Send the dumped value to the output buffer
     *
     * @return string
     */
    public static function dump($var, $maxDepth = 2, $stripTags = true, $echo = true)
    {
        $html = ini_get('html_errors');

        if ($html !== true) {
            ini_set('html_errors', 'on');
        }

        if (extension_loaded('xdebug')) {
            ini_set('xdebug.var_display_max_depth', $maxDepth);
        }

        $var = self::export($var, $maxDepth);

        ob_start();
        var_dump($var);

        $dump = ob_get_contents();

        ob_end_clean();

        $dumpText = ($stripTags ? strip_tags(html_entity_decode($dump)) : $dump);

        ini_set('html_errors', $html);

        if ($echo) {
            echo $dumpText;
        }

        return $dumpText;
    }

    /**
     * @param mixed $var
     * @param int $maxDepth
     *
     * @return mixed
     */
    public static function export($var, $maxDepth)
    {
        $return = null;
        $isObj = is_object($var);

        if ($var instanceof Collection) {
            $var = $var->toArray();
        }

        if (!$maxDepth) {
            return is_object($var) ? get_class($var)
                : (is_array($var) ? 'Array(' . count($var) . ')' : $var);
        }

        if (is_array($var)) {
            $return = [];

            foreach ($var as $k => $v) {
                $return[$k] = self::export($v, $maxDepth - 1);
            }

            return $return;
        }

        if (!$isObj) {
            return $var;
        }

        $return = new stdClass();
        if ($var instanceof DateTimeInterface) {
            $return->__CLASS__ = get_class($var);
            $return->date = $var->format('c');
            $return->timezone = $var->getTimezone()->getName();

            return $return;
        }

        $return->__CLASS__ = ClassUtils::getClass($var);

        if ($var instanceof Proxy) {
            $return->__IS_PROXY__ = true;
            $return->__PROXY_INITIALIZED__ = $var->__isInitialized();
        }

        if ($var instanceof ArrayObject || $var instanceof ArrayIterator) {
            $return->__STORAGE__ = self::export($var->getArrayCopy(), $maxDepth - 1);
        }

        return self::fillReturnWithClassAttributes($var, $return, $maxDepth);
    }

    /**
     * Fill the $return variable with class attributes
     * Based on obj2array function from {@see https://secure.php.net/manual/en/function.get-object-vars.php#47075}
     *
     * @param object $var
     * @param int $maxDepth
     *
     * @return mixed
     */
    private static function fillReturnWithClassAttributes($var, stdClass $return, $maxDepth)
    {
        $clone = (array)$var;

        foreach (array_keys($clone) as $key) {
            $aux = explode("\0", $key);
            $name = end($aux);
            if ($aux[0] === '') {
                $name .= ':' . ($aux[1] === '*' ? 'protected' : $aux[1] . ':private');
            }

            $return->$name = self::export($clone[$key], $maxDepth - 1);
        }

        return $return;
    }

    /**
     * Returns a string representation of an object.
     *
     * @param object $obj
     *
     * @return string
     */
    public static function toString($obj)
    {
        return method_exists($obj, '__toString') ? (string)$obj : get_class($obj) . '@' . spl_object_hash($obj);
    }
}
