<?php

declare (strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperc5bee3a837bb\SebastianBergmann\Diff;

/**
 * @covers SebastianBergmann\Diff\TimeEfficientLongestCommonSubsequenceCalculator
 */
final class TimeEfficientImplementationTest extends \_PhpScoperc5bee3a837bb\SebastianBergmann\Diff\LongestCommonSubsequenceTest
{
    protected function createImplementation() : \_PhpScoperc5bee3a837bb\SebastianBergmann\Diff\LongestCommonSubsequenceCalculator
    {
        return new \_PhpScoperc5bee3a837bb\SebastianBergmann\Diff\TimeEfficientLongestCommonSubsequenceCalculator();
    }
}
