<?php

declare(strict_types=1);

namespace JMS\Serializer\Tests\Fixtures;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

/** @Serializer\AccessorOrder("alphabetical") */
class InlineParentWithEmptyChild
{
    /**
     * @Type("string")
     */
    private $c = 'c';

    /**
     * @Type("string")
     */
    private $d = 'd';

    /**
     * @Serializer\Inline
     * @Type("JMS\Serializer\Tests\Fixtures\InlineChildEmpty")
     */
    private $child;

    public function __construct($child = null)
    {
        $this->child = $child ?: new InlineChildEmpty();
    }
}
