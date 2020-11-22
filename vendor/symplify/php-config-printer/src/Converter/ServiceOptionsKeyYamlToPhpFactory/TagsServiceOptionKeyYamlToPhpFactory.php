<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\Converter\ServiceOptionsKeyYamlToPhpFactory;

use _PhpScoperbc5235eb86f3\PhpParser\BuilderHelpers;
use _PhpScoperbc5235eb86f3\PhpParser\Node\Arg;
use _PhpScoperbc5235eb86f3\PhpParser\Node\Expr\MethodCall;
use _PhpScoperbc5235eb86f3\PhpParser\Node\Scalar\String_;
use Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface;
use Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory;
use Symplify\PhpConfigPrinter\ValueObject\YamlServiceKey;
final class TagsServiceOptionKeyYamlToPhpFactory implements \Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface
{
    /**
     * @var string
     */
    private const TAG = 'tag';
    /**
     * @var ArgsNodeFactory
     */
    private $argsNodeFactory;
    public function __construct(\Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory $argsNodeFactory)
    {
        $this->argsNodeFactory = $argsNodeFactory;
    }
    public function decorateServiceMethodCall($key, $yaml, $values, \_PhpScoperbc5235eb86f3\PhpParser\Node\Expr\MethodCall $methodCall) : \_PhpScoperbc5235eb86f3\PhpParser\Node\Expr\MethodCall
    {
        /** @var mixed[] $yaml */
        if (\count($yaml) === 1 && \is_string($yaml[0])) {
            $string = new \_PhpScoperbc5235eb86f3\PhpParser\Node\Scalar\String_($yaml[0]);
            return new \_PhpScoperbc5235eb86f3\PhpParser\Node\Expr\MethodCall($methodCall, self::TAG, [new \_PhpScoperbc5235eb86f3\PhpParser\Node\Arg($string)]);
        }
        foreach ($yaml as $singleValue) {
            $args = [];
            foreach ($singleValue as $singleNestedKey => $singleNestedValue) {
                if ($singleNestedKey === 'name') {
                    $args[] = new \_PhpScoperbc5235eb86f3\PhpParser\Node\Arg(\_PhpScoperbc5235eb86f3\PhpParser\BuilderHelpers::normalizeValue($singleNestedValue));
                    unset($singleValue[$singleNestedKey]);
                }
            }
            $restArgs = $this->argsNodeFactory->createFromValuesAndWrapInArray($singleValue);
            $args = \array_merge($args, $restArgs);
            $methodCall = new \_PhpScoperbc5235eb86f3\PhpParser\Node\Expr\MethodCall($methodCall, self::TAG, $args);
        }
        return $methodCall;
    }
    public function isMatch($key, $values) : bool
    {
        return $key === \Symplify\PhpConfigPrinter\ValueObject\YamlServiceKey::TAGS;
    }
}