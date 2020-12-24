<?php

declare (strict_types=1);
namespace _PhpScopere106f9fd4493\PhpParser\Lexer\TokenEmulator;

use _PhpScopere106f9fd4493\PhpParser\Lexer\Emulative;
final class MatchTokenEmulator extends \_PhpScopere106f9fd4493\PhpParser\Lexer\TokenEmulator\KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return \_PhpScopere106f9fd4493\PhpParser\Lexer\Emulative::PHP_8_0;
    }
    public function getKeywordString() : string
    {
        return 'match';
    }
    public function getKeywordToken() : int
    {
        return \T_MATCH;
    }
}
