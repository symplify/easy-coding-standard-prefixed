<?php

declare (strict_types=1);
namespace _PhpScoperd3d57724c802\PhpParser\Lexer\TokenEmulator;

use _PhpScoperd3d57724c802\PhpParser\Lexer\Emulative;
final class CoaleseEqualTokenEmulator extends \_PhpScoperd3d57724c802\PhpParser\Lexer\TokenEmulator\TokenEmulator
{
    public function getPhpVersion() : string
    {
        return \_PhpScoperd3d57724c802\PhpParser\Lexer\Emulative::PHP_7_4;
    }
    public function isEmulationNeeded(string $code) : bool
    {
        return \strpos($code, '??=') !== \false;
    }
    public function emulate(string $code, array $tokens) : array
    {
        // We need to manually iterate and manage a count because we'll change
        // the tokens array on the way
        $line = 1;
        for ($i = 0, $c = \count($tokens); $i < $c; ++$i) {
            if (isset($tokens[$i + 1])) {
                if ($tokens[$i][0] === \T_COALESCE && $tokens[$i + 1] === '=') {
                    \array_splice($tokens, $i, 2, [[\T_COALESCE_EQUAL, '??=', $line]]);
                    $c--;
                    continue;
                }
            }
            if (\is_array($tokens[$i])) {
                $line += \substr_count($tokens[$i][1], "\n");
            }
        }
        return $tokens;
    }
    public function reverseEmulate(string $code, array $tokens) : array
    {
        // ??= was not valid code previously, don't bother.
        return $tokens;
    }
}
