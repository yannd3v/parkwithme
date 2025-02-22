<?php

declare(strict_types=1);

namespace Doctrine\ORM\Mapping;

use Attribute;
use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;

/**
 * @Annotation
 * @NamedArgumentConstructor()
 * @Target("PROPERTY")
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
final class SequenceGenerator implements MappingAttribute
{
    /**
     * @var string|null
     * @readonly
     */
    public $sequenceName;

    /**
     * @var int
     * @readonly
     */
    public $allocationSize = 1;

    /**
     * @var int
     * @readonly
     */
    public $initialValue = 1;

    public function __construct(
        ?string $sequenceName = null,
        int     $allocationSize = 1,
        int     $initialValue = 1
    )
    {
        $this->sequenceName = $sequenceName;
        $this->allocationSize = $allocationSize;
        $this->initialValue = $initialValue;
    }
}
