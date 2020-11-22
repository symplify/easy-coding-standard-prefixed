<?php

declare (strict_types=1);
namespace _PhpScoper4cd05b62e9f1\PhpParser\Lexer\TokenEmulator;

use _PhpScoper4cd05b62e9f1\PhpParser\Lexer\Emulative;
final class MatchTokenEmulator extends \_PhpScoper4cd05b62e9f1\PhpParser\Lexer\TokenEmulator\KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return \_PhpScoper4cd05b62e9f1\PhpParser\Lexer\Emulative::PHP_8_0;
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
