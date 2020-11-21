<?php

declare (strict_types=1);
namespace _PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\CaseConverter;

use _PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\Contract\CaseConverterInterface;
use _PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\NodeFactory\Service\AutoBindNodeFactory;
use _PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\ValueObject\MethodName;
use _PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\ValueObject\VariableName;
use _PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\ValueObject\YamlKey;
use _PhpScoper224ae0b86670\PhpParser\Node\Expr\MethodCall;
use _PhpScoper224ae0b86670\PhpParser\Node\Expr\Variable;
use _PhpScoper224ae0b86670\PhpParser\Node\Stmt\Expression;
/**
 * Handles this part:
 *
 * services:
 *     _defaults: <---
 */
final class ServicesDefaultsCaseConverter implements \_PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\Contract\CaseConverterInterface
{
    /**
     * @var AutoBindNodeFactory
     */
    private $autoBindNodeFactory;
    public function __construct(\_PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\NodeFactory\Service\AutoBindNodeFactory $autoBindNodeFactory)
    {
        $this->autoBindNodeFactory = $autoBindNodeFactory;
    }
    public function convertToMethodCall($key, $values) : \_PhpScoper224ae0b86670\PhpParser\Node\Stmt\Expression
    {
        $methodCall = new \_PhpScoper224ae0b86670\PhpParser\Node\Expr\MethodCall($this->createServicesVariable(), \_PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\ValueObject\MethodName::DEFAULTS);
        $methodCall = $this->autoBindNodeFactory->createAutoBindCalls($values, $methodCall, \_PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\NodeFactory\Service\AutoBindNodeFactory::TYPE_DEFAULTS);
        return new \_PhpScoper224ae0b86670\PhpParser\Node\Stmt\Expression($methodCall);
    }
    public function match(string $rootKey, $key, $values) : bool
    {
        if ($rootKey !== \_PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\ValueObject\YamlKey::SERVICES) {
            return \false;
        }
        return $key === \_PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\ValueObject\YamlKey::_DEFAULTS;
    }
    private function createServicesVariable() : \_PhpScoper224ae0b86670\PhpParser\Node\Expr\Variable
    {
        return new \_PhpScoper224ae0b86670\PhpParser\Node\Expr\Variable(\_PhpScoper224ae0b86670\Migrify\PhpConfigPrinter\ValueObject\VariableName::SERVICES);
    }
}
