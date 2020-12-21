<?php

declare (strict_types=1);
namespace SlevomatCodingStandard\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;
use SlevomatCodingStandard\Helpers\IdentificatorHelper;
use SlevomatCodingStandard\Helpers\TokenHelper;
use function array_key_exists;
use function array_map;
use function array_merge;
use function count;
use function in_array;
use const _PhpScoperb730595bc9f4\T_ANON_CLASS;
use const T_ARRAY_CAST;
use const _PhpScoperb730595bc9f4\T_BITWISE_AND;
use const _PhpScoperb730595bc9f4\T_BITWISE_OR;
use const _PhpScoperb730595bc9f4\T_BITWISE_XOR;
use const T_BOOL_CAST;
use const _PhpScoperb730595bc9f4\T_BOOLEAN_NOT;
use const T_CASE;
use const T_CLONE;
use const _PhpScoperb730595bc9f4\T_CLOSE_PARENTHESIS;
use const _PhpScoperb730595bc9f4\T_CLOSURE;
use const T_COALESCE;
use const _PhpScoperb730595bc9f4\T_COLON;
use const T_CONSTANT_ENCAPSED_STRING;
use const _PhpScoperb730595bc9f4\T_DIVIDE;
use const T_DNUMBER;
use const _PhpScoperb730595bc9f4\T_DOLLAR;
use const T_DOUBLE_CAST;
use const T_EMPTY;
use const _PhpScoperb730595bc9f4\T_EQUAL;
use const T_EVAL;
use const T_EXIT;
use const T_FN;
use const T_INCLUDE;
use const T_INCLUDE_ONCE;
use const _PhpScoperb730595bc9f4\T_INLINE_THEN;
use const T_INT_CAST;
use const T_ISSET;
use const T_LIST;
use const T_LNUMBER;
use const T_LOGICAL_AND;
use const T_LOGICAL_OR;
use const _PhpScoperb730595bc9f4\T_MINUS;
use const _PhpScoperb730595bc9f4\T_MODULUS;
use const _PhpScoperb730595bc9f4\T_MULTIPLY;
use const T_NEW;
use const T_OBJECT_CAST;
use const _PhpScoperb730595bc9f4\T_OPEN_PARENTHESIS;
use const _PhpScoperb730595bc9f4\T_PARENT;
use const _PhpScoperb730595bc9f4\T_PLUS;
use const T_POW;
use const T_REQUIRE;
use const T_REQUIRE_ONCE;
use const _PhpScoperb730595bc9f4\T_SELF;
use const _PhpScoperb730595bc9f4\T_SEMICOLON;
use const T_STATIC;
use const T_STRING_CAST;
use const _PhpScoperb730595bc9f4\T_STRING_CONCAT;
use const T_UNSET;
use const T_UNSET_CAST;
use const T_USE;
use const T_VARIABLE;
use const T_WHITESPACE;
use const T_YIELD;
use const T_YIELD_FROM;
class UselessParenthesesSniff implements \PHP_CodeSniffer\Sniffs\Sniff
{
    public const CODE_USELESS_PARENTHESES = 'UselessParentheses';
    private const OPERATORS = [\T_POW, \T_MULTIPLY, \T_DIVIDE, \T_MODULUS, \T_PLUS, \T_MINUS, \T_STRING_CONCAT];
    private const OPERATOR_GROUPS = [\T_POW => 1, \T_MULTIPLY => 2, \T_DIVIDE => 2, \T_MODULUS => 3, \T_PLUS => 4, \T_MINUS => 4, \T_STRING_CONCAT => 5];
    /** @var bool */
    public $ignoreComplexTernaryConditions = \false;
    /**
     * @return array<int, (int|string)>
     */
    public function register() : array
    {
        return [\T_OPEN_PARENTHESIS];
    }
    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @param File $phpcsFile
     * @param int $parenthesisOpenerPointer
     */
    public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $parenthesisOpenerPointer) : void
    {
        $tokens = $phpcsFile->getTokens();
        if (\array_key_exists('parenthesis_owner', $tokens[$parenthesisOpenerPointer])) {
            return;
        }
        /** @var int $pointerBeforeParenthesisOpener */
        $pointerBeforeParenthesisOpener = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $parenthesisOpenerPointer - 1);
        if (\in_array($tokens[$pointerBeforeParenthesisOpener]['code'], \array_merge(\SlevomatCodingStandard\Helpers\TokenHelper::getNameTokenCodes(), [\T_VARIABLE, \T_ISSET, \T_UNSET, \T_EMPTY, \T_CLOSURE, \T_FN, \T_USE, \T_ANON_CLASS, \T_SELF, \T_STATIC, \T_EXIT, \T_CLOSE_PARENTHESIS, \T_EVAL, \T_LIST, \T_INCLUDE, \T_INCLUDE_ONCE, \T_REQUIRE, \T_REQUIRE_ONCE, \T_INT_CAST, \T_DOUBLE_CAST, \T_STRING_CAST, \T_ARRAY_CAST, \T_OBJECT_CAST, \T_BOOL_CAST, \T_UNSET_CAST]), \true)) {
            return;
        }
        /** @var int $pointerAfterParenthesisOpener */
        $pointerAfterParenthesisOpener = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $parenthesisOpenerPointer + 1);
        if (\in_array($tokens[$pointerAfterParenthesisOpener]['code'], [\T_NEW, \T_CLONE, \T_YIELD, \T_YIELD_FROM, \T_REQUIRE, \T_REQUIRE_ONCE, \T_INCLUDE, \T_INCLUDE_ONCE], \true)) {
            return;
        }
        if (\SlevomatCodingStandard\Helpers\TokenHelper::findNext($phpcsFile, \T_EQUAL, $parenthesisOpenerPointer + 1, $tokens[$parenthesisOpenerPointer]['parenthesis_closer']) !== null) {
            return;
        }
        $pointerAfterParenthesisCloser = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $tokens[$parenthesisOpenerPointer]['parenthesis_closer'] + 1);
        if ($pointerAfterParenthesisCloser !== null && $tokens[$pointerAfterParenthesisCloser]['code'] === \T_OPEN_PARENTHESIS) {
            return;
        }
        if (\SlevomatCodingStandard\Helpers\IdentificatorHelper::findStartPointer($phpcsFile, $pointerBeforeParenthesisOpener) !== null) {
            return;
        }
        $this->checkParenthesesAroundConditionInTernaryOperator($phpcsFile, $parenthesisOpenerPointer);
        $this->checkParenthesesAroundCaseInSwitch($phpcsFile, $parenthesisOpenerPointer);
        $this->checkParenthesesAroundVariableOrFunctionCall($phpcsFile, $parenthesisOpenerPointer);
        $this->checkParenthesesAroundString($phpcsFile, $parenthesisOpenerPointer);
        $this->checkParenthesesAroundOperators($phpcsFile, $parenthesisOpenerPointer);
    }
    private function checkParenthesesAroundConditionInTernaryOperator(\PHP_CodeSniffer\Files\File $phpcsFile, int $parenthesisOpenerPointer) : void
    {
        $tokens = $phpcsFile->getTokens();
        $parenthesisCloserPointer = $tokens[$parenthesisOpenerPointer]['parenthesis_closer'];
        $ternaryOperatorPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $parenthesisCloserPointer + 1);
        if ($tokens[$ternaryOperatorPointer]['code'] !== \T_INLINE_THEN) {
            return;
        }
        if (\SlevomatCodingStandard\Helpers\TokenHelper::findNext($phpcsFile, [\T_LOGICAL_AND, \T_LOGICAL_OR], $parenthesisOpenerPointer + 1, $parenthesisCloserPointer) !== null) {
            return;
        }
        $pointerBeforeParenthesisOpener = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $parenthesisOpenerPointer - 1);
        if ($tokens[$pointerBeforeParenthesisOpener]['code'] === \T_BOOLEAN_NOT) {
            return;
        }
        if (\in_array($tokens[$pointerBeforeParenthesisOpener]['code'], \PHP_CodeSniffer\Util\Tokens::$comparisonTokens, \true)) {
            return;
        }
        if (\in_array($tokens[$pointerBeforeParenthesisOpener]['code'], \PHP_CodeSniffer\Util\Tokens::$booleanOperators, \true)) {
            return;
        }
        if ($this->ignoreComplexTernaryConditions) {
            if (\SlevomatCodingStandard\Helpers\TokenHelper::findNext($phpcsFile, \PHP_CodeSniffer\Util\Tokens::$booleanOperators, $parenthesisOpenerPointer + 1, $parenthesisCloserPointer) !== null) {
                return;
            }
            if (\SlevomatCodingStandard\Helpers\TokenHelper::findNextContent($phpcsFile, \T_WHITESPACE, $phpcsFile->eolChar, $parenthesisOpenerPointer + 1, $parenthesisCloserPointer) !== null) {
                return;
            }
        }
        $contentStartPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $parenthesisOpenerPointer + 1);
        $contentEndPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $parenthesisCloserPointer - 1);
        for ($i = $contentStartPointer; $i <= $contentEndPointer; $i++) {
            if ($tokens[$i]['code'] === \T_INLINE_THEN) {
                return;
            }
        }
        $fix = $phpcsFile->addFixableError('Useless parentheses.', $parenthesisOpenerPointer, self::CODE_USELESS_PARENTHESES);
        if (!$fix) {
            return;
        }
        $phpcsFile->fixer->beginChangeset();
        for ($i = $parenthesisOpenerPointer; $i < $contentStartPointer; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        for ($i = $contentEndPointer + 1; $i <= $parenthesisCloserPointer; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        $phpcsFile->fixer->endChangeset();
    }
    private function checkParenthesesAroundCaseInSwitch(\PHP_CodeSniffer\Files\File $phpcsFile, int $parenthesisOpenerPointer) : void
    {
        $tokens = $phpcsFile->getTokens();
        $pointerBeforeParenthesisOpener = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $parenthesisOpenerPointer - 1);
        if ($tokens[$pointerBeforeParenthesisOpener]['code'] !== \T_CASE) {
            return;
        }
        $pointerAfterParenthesisCloser = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $tokens[$parenthesisOpenerPointer]['parenthesis_closer'] + 1);
        if ($tokens[$pointerAfterParenthesisCloser]['code'] !== \T_COLON) {
            return;
        }
        $fix = $phpcsFile->addFixableError('Useless parentheses.', $parenthesisOpenerPointer, self::CODE_USELESS_PARENTHESES);
        if (!$fix) {
            return;
        }
        $contentStartPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $parenthesisOpenerPointer + 1);
        $contentEndPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $tokens[$parenthesisOpenerPointer]['parenthesis_closer'] - 1);
        $phpcsFile->fixer->beginChangeset();
        for ($i = $parenthesisOpenerPointer; $i < $contentStartPointer; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        for ($i = $contentEndPointer + 1; $i <= $tokens[$parenthesisOpenerPointer]['parenthesis_closer']; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        $phpcsFile->fixer->endChangeset();
    }
    private function checkParenthesesAroundVariableOrFunctionCall(\PHP_CodeSniffer\Files\File $phpcsFile, int $parenthesisOpenerPointer) : void
    {
        $tokens = $phpcsFile->getTokens();
        $operatorsPointers = \SlevomatCodingStandard\Helpers\TokenHelper::findNextAll($phpcsFile, self::OPERATORS, $parenthesisOpenerPointer + 1, $tokens[$parenthesisOpenerPointer]['parenthesis_closer']);
        if (\count($operatorsPointers) !== 0) {
            return;
        }
        $casePointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $parenthesisOpenerPointer - 1);
        if ($tokens[$casePointer]['code'] === \T_CASE) {
            return;
        }
        $pointerBeforeParenthesisOpener = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $parenthesisOpenerPointer - 1);
        if (\in_array($tokens[$pointerBeforeParenthesisOpener]['code'], \PHP_CodeSniffer\Util\Tokens::$booleanOperators, \true)) {
            return;
        }
        $pointerAfterParenthesisCloser = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $tokens[$parenthesisOpenerPointer]['parenthesis_closer'] + 1);
        if (\in_array($tokens[$pointerAfterParenthesisCloser]['code'], [\T_INLINE_THEN, \T_OPEN_PARENTHESIS], \true)) {
            return;
        }
        /** @var int $contentStartPointer */
        $contentStartPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $parenthesisOpenerPointer + 1);
        if ($tokens[$contentStartPointer]['code'] === \T_CONSTANT_ENCAPSED_STRING) {
            return;
        }
        $notBooleanNotOperatorPointer = $contentStartPointer;
        if ($tokens[$contentStartPointer]['code'] === \T_BOOLEAN_NOT) {
            /** @var int $notBooleanNotOperatorPointer */
            $notBooleanNotOperatorPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $contentStartPointer + 1);
        }
        if (\in_array($tokens[$notBooleanNotOperatorPointer]['code'], \array_merge([\T_SELF, \T_STATIC, \T_PARENT, \T_VARIABLE, \T_DOLLAR], \SlevomatCodingStandard\Helpers\TokenHelper::getNameTokenCodes()), \true)) {
            $contentEndPointer = \SlevomatCodingStandard\Helpers\IdentificatorHelper::findEndPointer($phpcsFile, $notBooleanNotOperatorPointer);
            if ($contentEndPointer === null && \in_array($tokens[$notBooleanNotOperatorPointer]['code'], \SlevomatCodingStandard\Helpers\TokenHelper::getNameTokenCodes(), \true)) {
                $nextPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $contentStartPointer + 1);
                if ($tokens[$nextPointer]['code'] === \T_OPEN_PARENTHESIS) {
                    $contentEndPointer = $contentStartPointer;
                }
            }
            do {
                $nextPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $contentEndPointer + 1);
                if ($tokens[$nextPointer]['code'] !== \T_OPEN_PARENTHESIS) {
                    break;
                }
                $contentEndPointer = $tokens[$nextPointer]['parenthesis_closer'];
            } while (\true);
        } else {
            $nextPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNext($phpcsFile, \T_OPEN_PARENTHESIS, $notBooleanNotOperatorPointer + 1);
            if ($nextPointer === null) {
                return;
            }
            $contentEndPointer = $tokens[$nextPointer]['parenthesis_closer'];
        }
        $pointerAfterContent = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $contentEndPointer + 1);
        if ($pointerAfterContent !== $tokens[$parenthesisOpenerPointer]['parenthesis_closer']) {
            return;
        }
        $fix = $phpcsFile->addFixableError('Useless parentheses.', $parenthesisOpenerPointer, self::CODE_USELESS_PARENTHESES);
        if (!$fix) {
            return;
        }
        $phpcsFile->fixer->beginChangeset();
        for ($i = $parenthesisOpenerPointer; $i < $contentStartPointer; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        for ($i = $contentEndPointer + 1; $i <= $tokens[$parenthesisOpenerPointer]['parenthesis_closer']; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        $phpcsFile->fixer->endChangeset();
    }
    private function checkParenthesesAroundString(\PHP_CodeSniffer\Files\File $phpcsFile, int $parenthesisOpenerPointer) : void
    {
        $tokens = $phpcsFile->getTokens();
        /** @var int $stringPointer */
        $stringPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $parenthesisOpenerPointer + 1);
        if ($tokens[$stringPointer]['code'] !== \T_CONSTANT_ENCAPSED_STRING) {
            return;
        }
        $pointerAfterString = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $stringPointer + 1);
        if ($pointerAfterString !== $tokens[$parenthesisOpenerPointer]['parenthesis_closer']) {
            return;
        }
        $fix = $phpcsFile->addFixableError('Useless parentheses.', $parenthesisOpenerPointer, self::CODE_USELESS_PARENTHESES);
        if (!$fix) {
            return;
        }
        $phpcsFile->fixer->beginChangeset();
        for ($i = $parenthesisOpenerPointer; $i < $stringPointer; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        for ($i = $stringPointer + 1; $i <= $tokens[$parenthesisOpenerPointer]['parenthesis_closer']; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        $phpcsFile->fixer->endChangeset();
    }
    private function checkParenthesesAroundOperators(\PHP_CodeSniffer\Files\File $phpcsFile, int $parenthesisOpenerPointer) : void
    {
        $tokens = $phpcsFile->getTokens();
        $pointerBeforeParenthesisOpener = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $parenthesisOpenerPointer - 1);
        $pointerAfterParenthesisCloser = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $tokens[$parenthesisOpenerPointer]['parenthesis_closer'] + 1);
        if ($tokens[$pointerBeforeParenthesisOpener]['code'] === \T_MINUS) {
            $pointerBeforeMinus = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $pointerBeforeParenthesisOpener - 1);
            if (!\in_array($tokens[$pointerBeforeMinus]['code'], [\T_DNUMBER, \T_LNUMBER], \true)) {
                return;
            }
        }
        if (\in_array($tokens[$pointerBeforeParenthesisOpener]['code'], \PHP_CodeSniffer\Util\Tokens::$booleanOperators, \true) || \in_array($tokens[$pointerAfterParenthesisCloser]['code'], \PHP_CodeSniffer\Util\Tokens::$booleanOperators, \true)) {
            return;
        }
        $operatorsPointers = [];
        $actualStartPointer = $parenthesisOpenerPointer + 1;
        while (\true) {
            $pointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNext($phpcsFile, \array_merge(self::OPERATORS, [\T_OPEN_PARENTHESIS, \T_INLINE_THEN, \T_COALESCE, \T_BITWISE_AND, \T_BITWISE_OR, \T_BITWISE_XOR], \PHP_CodeSniffer\Util\Tokens::$comparisonTokens), $actualStartPointer, $tokens[$parenthesisOpenerPointer]['parenthesis_closer']);
            if ($pointer === null) {
                break;
            }
            if (\in_array($tokens[$pointer]['code'], [\T_INLINE_THEN, \T_COALESCE, \T_BITWISE_AND, \T_BITWISE_OR, \T_BITWISE_XOR], \true)) {
                return;
            }
            if (\in_array($tokens[$pointer]['code'], \PHP_CodeSniffer\Util\Tokens::$comparisonTokens, \true)) {
                return;
            }
            if ($tokens[$pointer]['code'] === \T_OPEN_PARENTHESIS) {
                $actualStartPointer = $tokens[$pointer]['parenthesis_closer'] + 1;
                continue;
            }
            $operatorsPointers[] = $pointer;
            $actualStartPointer = $pointer + 1;
        }
        if (\count($operatorsPointers) === 0) {
            return;
        }
        if ($tokens[$pointerBeforeParenthesisOpener]['code'] !== \T_EQUAL || $tokens[$pointerAfterParenthesisCloser]['code'] !== \T_SEMICOLON) {
            $operatorsGroups = \array_map(static function (int $operatorPointer) use($tokens) : int {
                return self::OPERATOR_GROUPS[$tokens[$operatorPointer]['code']];
            }, $operatorsPointers);
            if (\count($operatorsGroups) > 1) {
                return;
            }
        }
        $firstOperatorPointer = $operatorsPointers[0];
        if (\in_array($tokens[$pointerBeforeParenthesisOpener]['code'], self::OPERATORS, \true)) {
            if (self::OPERATOR_GROUPS[$tokens[$firstOperatorPointer]['code']] !== self::OPERATOR_GROUPS[$tokens[$pointerBeforeParenthesisOpener]['code']]) {
                return;
            }
            if ($tokens[$pointerBeforeParenthesisOpener]['code'] === \T_MINUS && \in_array($tokens[$firstOperatorPointer]['code'], [\T_PLUS, \T_MINUS], \true)) {
                return;
            }
            if ($tokens[$pointerBeforeParenthesisOpener]['code'] === \T_DIVIDE && \in_array($tokens[$firstOperatorPointer]['code'], [\T_DIVIDE, \T_MULTIPLY], \true)) {
                return;
            }
            if ($tokens[$pointerBeforeParenthesisOpener]['code'] === \T_MODULUS && $tokens[$firstOperatorPointer]['code'] === \T_MODULUS) {
                return;
            }
        }
        $lastOperatorPointer = $operatorsPointers[\count($operatorsPointers) - 1];
        if (\in_array($tokens[$pointerAfterParenthesisCloser]['code'], self::OPERATORS, \true) && self::OPERATOR_GROUPS[$tokens[$lastOperatorPointer]['code']] !== self::OPERATOR_GROUPS[$tokens[$pointerAfterParenthesisCloser]['code']]) {
            return;
        }
        $fix = $phpcsFile->addFixableError('Useless parentheses.', $parenthesisOpenerPointer, self::CODE_USELESS_PARENTHESES);
        if (!$fix) {
            return;
        }
        $contentStartPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $parenthesisOpenerPointer + 1);
        $contentEndPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $tokens[$parenthesisOpenerPointer]['parenthesis_closer'] - 1);
        $phpcsFile->fixer->beginChangeset();
        for ($i = $parenthesisOpenerPointer; $i < $contentStartPointer; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        for ($i = $contentEndPointer + 1; $i <= $tokens[$parenthesisOpenerPointer]['parenthesis_closer']; $i++) {
            $phpcsFile->fixer->replaceToken($i, '');
        }
        $phpcsFile->fixer->endChangeset();
    }
}
