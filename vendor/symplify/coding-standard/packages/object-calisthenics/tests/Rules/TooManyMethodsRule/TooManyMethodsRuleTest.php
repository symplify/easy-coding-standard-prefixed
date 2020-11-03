<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\ObjectCalisthenics\Tests\Rules\TooManyMethodsRule;

use Iterator;
use _PhpScoper8de082cbb8c7\PHPStan\Rules\Rule;
use Symplify\CodingStandard\ObjectCalisthenics\Rules\TooManyMethodsRule;
use Symplify\PHPStanExtensions\Testing\AbstractServiceAwareRuleTestCase;
final class TooManyMethodsRuleTest extends \Symplify\PHPStanExtensions\Testing\AbstractServiceAwareRuleTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function testRule(string $filePath, array $expectedErrorMessagesWithLines) : void
    {
        $this->analyse([$filePath], $expectedErrorMessagesWithLines);
    }
    public function provideData() : \Iterator
    {
        $message = \sprintf(\Symplify\CodingStandard\ObjectCalisthenics\Rules\TooManyMethodsRule::ERROR_MESSAGE, 4, 3);
        (yield [__DIR__ . '/Fixture/ManyMethods.php', [[$message, 7]]]);
    }
    protected function getRule() : \_PhpScoper8de082cbb8c7\PHPStan\Rules\Rule
    {
        return $this->getRuleFromConfig(\Symplify\CodingStandard\ObjectCalisthenics\Rules\TooManyMethodsRule::class, __DIR__ . '/config/configured_rule.neon');
    }
}