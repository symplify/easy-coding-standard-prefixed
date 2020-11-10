<?php

declare (strict_types=1);
namespace _PhpScoper836bc32aecc2\Migrify\PhpConfigPrinter\NodeFactory;

use _PhpScoper836bc32aecc2\PhpParser\BuilderHelpers;
use _PhpScoper836bc32aecc2\PhpParser\Node\Arg;
use _PhpScoper836bc32aecc2\PhpParser\Node\Expr\New_;
use _PhpScoper836bc32aecc2\PhpParser\Node\Name\FullyQualified;
use ReflectionClass;
final class NewValueObjectFactory
{
    public function create(object $valueObject) : \_PhpScoper836bc32aecc2\PhpParser\Node\Expr\New_
    {
        $valueObjectClass = \get_class($valueObject);
        $propertyValues = $this->resolvePropertyValuesFromValueObject($valueObjectClass, $valueObject);
        $args = $this->createArgs($propertyValues);
        return new \_PhpScoper836bc32aecc2\PhpParser\Node\Expr\New_(new \_PhpScoper836bc32aecc2\PhpParser\Node\Name\FullyQualified($valueObjectClass), $args);
    }
    /**
     * @return mixed[]
     */
    private function resolvePropertyValuesFromValueObject(string $valueObjectClass, object $valueObject) : array
    {
        $reflectionClass = new \ReflectionClass($valueObjectClass);
        $propertyValues = [];
        foreach ($reflectionClass->getProperties() as $reflectionProperty) {
            $reflectionProperty->setAccessible(\true);
            $propertyValues[] = $reflectionProperty->getValue($valueObject);
        }
        return $propertyValues;
    }
    /**
     * @param mixed[] $propertyValues
     * @return Arg[]
     */
    private function createArgs(array $propertyValues) : array
    {
        $args = [];
        foreach ($propertyValues as $propertyValue) {
            $args[] = new \_PhpScoper836bc32aecc2\PhpParser\Node\Arg(\_PhpScoper836bc32aecc2\PhpParser\BuilderHelpers::normalizeValue($propertyValue));
        }
        return $args;
    }
}
