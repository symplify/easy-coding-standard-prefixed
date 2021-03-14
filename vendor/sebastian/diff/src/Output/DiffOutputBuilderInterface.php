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
namespace _PhpScopere050faf861e6\SebastianBergmann\Diff\Output;

/**
 * Defines how an output builder should take a generated
 * diff array and return a string representation of that diff.
 */
interface DiffOutputBuilderInterface
{
    public function getDiff(array $diff) : string;
}
