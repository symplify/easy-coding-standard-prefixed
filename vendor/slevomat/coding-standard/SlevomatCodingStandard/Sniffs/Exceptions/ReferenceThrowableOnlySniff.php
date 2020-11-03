<?php

declare (strict_types=1);
namespace SlevomatCodingStandard\Sniffs\Exceptions;

use Exception;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\CatchHelper;
use SlevomatCodingStandard\Helpers\NamespaceHelper;
use SlevomatCodingStandard\Helpers\ReferencedNameHelper;
use SlevomatCodingStandard\Helpers\SuppressHelper;
use SlevomatCodingStandard\Helpers\TokenHelper;
use Throwable;
use function array_key_exists;
use function array_merge;
use function in_array;
use function sprintf;
use const _PhpScoper8de082cbb8c7\T_BITWISE_OR;
use const T_CATCH;
use const T_EXTENDS;
use const T_FUNCTION;
use const T_INSTANCEOF;
use const T_NEW;
use const _PhpScoper8de082cbb8c7\T_OPEN_PARENTHESIS;
use const T_OPEN_TAG;
class ReferenceThrowableOnlySniff implements \PHP_CodeSniffer\Sniffs\Sniff
{
    public const CODE_REFERENCED_GENERAL_EXCEPTION = 'ReferencedGeneralException';
    private const NAME = 'SlevomatCodingStandard.Exceptions.ReferenceThrowableOnly';
    /**
     * @return array<int, (int|string)>
     */
    public function register() : array
    {
        return [\T_OPEN_TAG];
    }
    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @param File $phpcsFile
     * @param int $openTagPointer
     */
    public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $openTagPointer) : void
    {
        if (\SlevomatCodingStandard\Helpers\TokenHelper::findPrevious($phpcsFile, \T_OPEN_TAG, $openTagPointer - 1) !== null) {
            return;
        }
        $tokens = $phpcsFile->getTokens();
        $message = \sprintf('Referencing general \\%s; use \\%s instead.', \Exception::class, \Throwable::class);
        $referencedNames = \SlevomatCodingStandard\Helpers\ReferencedNameHelper::getAllReferencedNames($phpcsFile, $openTagPointer);
        foreach ($referencedNames as $referencedName) {
            $resolvedName = \SlevomatCodingStandard\Helpers\NamespaceHelper::resolveClassName($phpcsFile, $referencedName->getNameAsReferencedInFile(), $referencedName->getStartPointer());
            if ($resolvedName !== '\\Exception') {
                continue;
            }
            $previousPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $referencedName->getStartPointer() - 1);
            if (\in_array($tokens[$previousPointer]['code'], [\T_EXTENDS, \T_NEW, \T_INSTANCEOF], \true)) {
                // Allow \Exception in extends and instantiating it
                continue;
            }
            if ($tokens[$previousPointer]['code'] === \T_BITWISE_OR) {
                $previousPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousExcluding($phpcsFile, \array_merge(\SlevomatCodingStandard\Helpers\TokenHelper::$ineffectiveTokenCodes, \SlevomatCodingStandard\Helpers\TokenHelper::getNameTokenCodes(), [\T_BITWISE_OR]), $previousPointer - 1);
            }
            if ($tokens[$previousPointer]['code'] === \T_OPEN_PARENTHESIS) {
                /** @var int $openParenthesisOpenerPointer */
                $openParenthesisOpenerPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $previousPointer - 1);
                if ($tokens[$openParenthesisOpenerPointer]['code'] === \T_CATCH) {
                    if ($this->searchForThrowableInNextCatches($phpcsFile, $openParenthesisOpenerPointer)) {
                        continue;
                    }
                } elseif (\array_key_exists('parenthesis_owner', $tokens[$previousPointer]) && $tokens[$tokens[$previousPointer]['parenthesis_owner']]['code'] === \T_FUNCTION && $tokens[$previousPointer]['parenthesis_closer'] > $referencedName->getStartPointer() && \SlevomatCodingStandard\Helpers\SuppressHelper::isSniffSuppressed($phpcsFile, $openParenthesisOpenerPointer, \sprintf('%s.%s', self::NAME, self::CODE_REFERENCED_GENERAL_EXCEPTION))) {
                    continue;
                }
            }
            $fix = $phpcsFile->addFixableError($message, $referencedName->getStartPointer(), self::CODE_REFERENCED_GENERAL_EXCEPTION);
            if (!$fix) {
                continue;
            }
            $phpcsFile->fixer->beginChangeset();
            for ($i = $referencedName->getStartPointer(); $i <= $referencedName->getEndPointer(); $i++) {
                $phpcsFile->fixer->replaceToken($i, '');
            }
            $phpcsFile->fixer->addContent($referencedName->getStartPointer(), '\\Throwable');
            $phpcsFile->fixer->endChangeset();
        }
    }
    private function searchForThrowableInNextCatches(\PHP_CodeSniffer\Files\File $phpcsFile, int $catchPointer) : bool
    {
        $tokens = $phpcsFile->getTokens();
        $nextCatchPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $tokens[$catchPointer]['scope_closer'] + 1);
        while ($nextCatchPointer !== null) {
            $nextCatchToken = $tokens[$nextCatchPointer];
            if ($nextCatchToken['code'] !== \T_CATCH) {
                break;
            }
            $catchedTypes = \SlevomatCodingStandard\Helpers\CatchHelper::findCatchedTypesInCatch($phpcsFile, $nextCatchToken);
            if (\in_array('\\Throwable', $catchedTypes, \true)) {
                return \true;
            }
            $nextCatchPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextEffective($phpcsFile, $nextCatchToken['scope_closer'] + 1);
        }
        return \false;
    }
}