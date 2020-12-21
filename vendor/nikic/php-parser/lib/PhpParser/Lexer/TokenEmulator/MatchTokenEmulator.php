<?php

declare (strict_types=1);
namespace _PhpScoperb730595bc9f4\PhpParser\Lexer\TokenEmulator;

use _PhpScoperb730595bc9f4\PhpParser\Lexer\Emulative;
final class MatchTokenEmulator extends \_PhpScoperb730595bc9f4\PhpParser\Lexer\TokenEmulator\KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return \_PhpScoperb730595bc9f4\PhpParser\Lexer\Emulative::PHP_8_0;
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
