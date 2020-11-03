<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\ObjectCalisthenics\Tests\Rules\NoSetterClassMethodRule;

use Iterator;
use _PhpScoper8de082cbb8c7\PHPStan\Rules\Rule;
use Symplify\CodingStandard\ObjectCalisthenics\Rules\NoSetterClassMethodRule;
use Symplify\PHPStanExtensions\Testing\AbstractServiceAwareRuleTestCase;
final class NoSetterClassMethodRuleTest extends \Symplify\PHPStanExtensions\Testing\AbstractServiceAwareRuleTestCase
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
        $errorMessage = \sprintf(\Symplify\CodingStandard\ObjectCalisthenics\Rules\NoSetterClassMethodRule::ERROR_MESSAGE, 'setName');
        (yield [__DIR__ . '/Fixture/SetterMethod.php', [[$errorMessage, 9]]]);
        (yield [__DIR__ . '/Fixture/AllowedClass.php', []]);
    }
    protected function getRule() : \_PhpScoper8de082cbb8c7\PHPStan\Rules\Rule
    {
        return $this->getRuleFromConfig(\Symplify\CodingStandard\ObjectCalisthenics\Rules\NoSetterClassMethodRule::class, __DIR__ . '/config/configured_rule.neon');
    }
}