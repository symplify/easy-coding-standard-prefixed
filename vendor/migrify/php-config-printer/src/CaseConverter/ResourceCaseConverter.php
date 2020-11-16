<?php

declare (strict_types=1);
namespace _PhpScopera9d6b451df71\Migrify\PhpConfigPrinter\CaseConverter;

use _PhpScopera9d6b451df71\Migrify\PhpConfigPrinter\Contract\CaseConverterInterface;
use _PhpScopera9d6b451df71\Migrify\PhpConfigPrinter\NodeFactory\Service\ServicesPhpNodeFactory;
use _PhpScopera9d6b451df71\Migrify\PhpConfigPrinter\ValueObject\YamlKey;
use _PhpScopera9d6b451df71\PhpParser\Node\Stmt\Expression;
/**
 * Handles this part:
 *
 * services:
 *     App\\: <--
 *          source: '../src'
 */
final class ResourceCaseConverter implements \_PhpScopera9d6b451df71\Migrify\PhpConfigPrinter\Contract\CaseConverterInterface
{
    /**
     * @var ServicesPhpNodeFactory
     */
    private $servicesPhpNodeFactory;
    public function __construct(\_PhpScopera9d6b451df71\Migrify\PhpConfigPrinter\NodeFactory\Service\ServicesPhpNodeFactory $servicesPhpNodeFactory)
    {
        $this->servicesPhpNodeFactory = $servicesPhpNodeFactory;
    }
    public function convertToMethodCall($key, $values) : \_PhpScopera9d6b451df71\PhpParser\Node\Stmt\Expression
    {
        // Due to the yaml behavior that does not allow the declaration of several identical key names.
        if (isset($values['namespace'])) {
            $key = $values['namespace'];
            unset($values['namespace']);
        }
        return $this->servicesPhpNodeFactory->createResource($key, $values);
    }
    public function match(string $rootKey, $key, $values) : bool
    {
        return isset($values[\_PhpScopera9d6b451df71\Migrify\PhpConfigPrinter\ValueObject\YamlKey::RESOURCE]);
    }
}
