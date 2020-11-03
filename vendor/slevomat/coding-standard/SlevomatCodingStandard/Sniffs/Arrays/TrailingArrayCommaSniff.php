<?php

declare (strict_types=1);
namespace SlevomatCodingStandard\Sniffs\Arrays;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\SniffSettingsHelper;
use SlevomatCodingStandard\Helpers\TokenHelper;
use function in_array;
use const _PhpScoper8de082cbb8c7\T_COMMA;
use const T_END_HEREDOC;
use const _PhpScoper8de082cbb8c7\T_END_NOWDOC;
use const _PhpScoper8de082cbb8c7\T_OPEN_SHORT_ARRAY;
class TrailingArrayCommaSniff implements \PHP_CodeSniffer\Sniffs\Sniff
{
    public const CODE_MISSING_TRAILING_COMMA = 'MissingTrailingComma';
    /** @var bool|null */
    public $enableAfterHeredoc = null;
    /**
     * @return array<int, (int|string)>
     */
    public function register() : array
    {
        return [\T_OPEN_SHORT_ARRAY];
    }
    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @param File $phpcsFile
     * @param int $stackPointer
     */
    public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPointer) : void
    {
        $this->enableAfterHeredoc = \SlevomatCodingStandard\Helpers\SniffSettingsHelper::isEnabledByPhpVersion($this->enableAfterHeredoc, 70300);
        $tokens = $phpcsFile->getTokens();
        $arrayToken = $tokens[$stackPointer];
        $closeParenthesisPointer = $arrayToken['bracket_closer'];
        $openParenthesisToken = $tokens[$arrayToken['bracket_opener']];
        $closeParenthesisToken = $tokens[$closeParenthesisPointer];
        if ($openParenthesisToken['line'] === $closeParenthesisToken['line']) {
            return;
        }
        /** @var int $previousToCloseParenthesisPointer */
        $previousToCloseParenthesisPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $closeParenthesisPointer - 1);
        $previousToCloseParenthesisToken = $tokens[$previousToCloseParenthesisPointer];
        if ($previousToCloseParenthesisPointer === $arrayToken['bracket_opener'] || $previousToCloseParenthesisToken['code'] === \T_COMMA || $closeParenthesisToken['line'] === $previousToCloseParenthesisToken['line']) {
            return;
        }
        if (!$this->enableAfterHeredoc && \in_array($previousToCloseParenthesisToken['code'], [\T_END_HEREDOC, \T_END_NOWDOC], \true)) {
            return;
        }
        $fix = $phpcsFile->addFixableError('Multi-line arrays must have a trailing comma after the last element.', $previousToCloseParenthesisPointer, self::CODE_MISSING_TRAILING_COMMA);
        if (!$fix) {
            return;
        }
        $phpcsFile->fixer->beginChangeset();
        $phpcsFile->fixer->addContent($previousToCloseParenthesisPointer, ',');
        $phpcsFile->fixer->endChangeset();
    }
}