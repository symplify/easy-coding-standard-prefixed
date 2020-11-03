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
namespace _PhpScoper8de082cbb8c7\SebastianBergmann\Diff\Output;

use _PhpScoper8de082cbb8c7\SebastianBergmann\Diff\Differ;
/**
 * Builds a diff string representation in a loose unified diff format
 * listing only changes lines. Does not include line numbers.
 */
final class DiffOnlyOutputBuilder implements \_PhpScoper8de082cbb8c7\SebastianBergmann\Diff\Output\DiffOutputBuilderInterface
{
    /**
     * @var string
     */
    private $header;
    public function __construct(string $header = "--- Original\n+++ New\n")
    {
        $this->header = $header;
    }
    public function getDiff(array $diff) : string
    {
        $buffer = \fopen('php://memory', 'r+b');
        if ('' !== $this->header) {
            \fwrite($buffer, $this->header);
            if ("\n" !== \substr($this->header, -1, 1)) {
                \fwrite($buffer, "\n");
            }
        }
        foreach ($diff as $diffEntry) {
            if ($diffEntry[1] === \_PhpScoper8de082cbb8c7\SebastianBergmann\Diff\Differ::ADDED) {
                \fwrite($buffer, '+' . $diffEntry[0]);
            } elseif ($diffEntry[1] === \_PhpScoper8de082cbb8c7\SebastianBergmann\Diff\Differ::REMOVED) {
                \fwrite($buffer, '-' . $diffEntry[0]);
            } elseif ($diffEntry[1] === \_PhpScoper8de082cbb8c7\SebastianBergmann\Diff\Differ::DIFF_LINE_END_WARNING) {
                \fwrite($buffer, ' ' . $diffEntry[0]);
                continue;
                // Warnings should not be tested for line break, it will always be there
            } else {
                /* Not changed (old) 0 */
                continue;
                // we didn't write the non changs line, so do not add a line break either
            }
            $lc = \substr($diffEntry[0], -1);
            if ($lc !== "\n" && $lc !== "\r") {
                \fwrite($buffer, "\n");
                // \No newline at end of file
            }
        }
        $diff = \stream_get_contents($buffer, -1, 0);
        \fclose($buffer);
        return $diff;
    }
}