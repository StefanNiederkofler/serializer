<?php

declare(strict_types=1);

namespace JMS\Serializer\Type;

use Hoa\Exception\Exception;
use Hoa\Visitor\Visit;
use JMS\Serializer\Type\Exception\SyntaxError;

@trigger_error(sprintf('Class "%s" is deprecated and will be removed in the next major version, use %s instead.', TypeVisitor::class, Lexer::class), E_USER_DEPRECATED);

final class Parser implements ParserInterface
{
    /** @var InnerParser */
    private $parser;

    /** @var Visit */
    private $visitor;

    public function __construct()
    {
        $this->parser = new InnerParser();
        $this->visitor = new TypeVisitor();
    }

    public function parse(string $type): array
    {
        try {
            $ast = $this->parser->parse($type, 'type');

            return $this->visitor->visit($ast);
        } catch (Exception $e) {
            throw new SyntaxError($e->getMessage(), 0, $e);
        }
    }
}
