<?php

declare (strict_types=1);
namespace _PhpScoper16399a42e87c\PhpParser\Lexer\TokenEmulator;

use _PhpScoper16399a42e87c\PhpParser\Lexer\Emulative;
final class MatchTokenEmulator extends \_PhpScoper16399a42e87c\PhpParser\Lexer\TokenEmulator\KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return \_PhpScoper16399a42e87c\PhpParser\Lexer\Emulative::PHP_8_0;
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
