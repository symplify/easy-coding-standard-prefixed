<?php

declare (strict_types=1);
namespace _PhpScopera1a51450b61d\PhpParser\Lexer\TokenEmulator;

use _PhpScopera1a51450b61d\PhpParser\Lexer\Emulative;
final class MatchTokenEmulator extends \_PhpScopera1a51450b61d\PhpParser\Lexer\TokenEmulator\KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return \_PhpScopera1a51450b61d\PhpParser\Lexer\Emulative::PHP_8_0;
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
