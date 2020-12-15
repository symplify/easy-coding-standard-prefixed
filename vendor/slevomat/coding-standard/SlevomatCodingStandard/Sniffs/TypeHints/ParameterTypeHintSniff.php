<?php

declare (strict_types=1);
namespace SlevomatCodingStandard\Sniffs\TypeHints;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\ArrayShapeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\CallableTypeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\ConstTypeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\IntersectionTypeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\NullableTypeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\ThisTypeNode;
use _PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use SlevomatCodingStandard\Helpers\Annotation\ParameterAnnotation;
use SlevomatCodingStandard\Helpers\AnnotationHelper;
use SlevomatCodingStandard\Helpers\AnnotationTypeHelper;
use SlevomatCodingStandard\Helpers\DocCommentHelper;
use SlevomatCodingStandard\Helpers\FunctionHelper;
use SlevomatCodingStandard\Helpers\NamespaceHelper;
use SlevomatCodingStandard\Helpers\ParameterTypeHint;
use SlevomatCodingStandard\Helpers\SniffSettingsHelper;
use SlevomatCodingStandard\Helpers\SuppressHelper;
use SlevomatCodingStandard\Helpers\TokenHelper;
use SlevomatCodingStandard\Helpers\TypeHintHelper;
use function array_filter;
use function array_key_exists;
use function array_keys;
use function array_map;
use function array_unique;
use function array_values;
use function count;
use function in_array;
use function lcfirst;
use function sprintf;
use function strtolower;
use const _PhpScoper6a1dd9b8a650\T_BITWISE_AND;
use const _PhpScoper6a1dd9b8a650\T_DOC_COMMENT_CLOSE_TAG;
use const _PhpScoper6a1dd9b8a650\T_DOC_COMMENT_STAR;
use const T_ELLIPSIS;
use const T_FUNCTION;
use const T_VARIABLE;
class ParameterTypeHintSniff implements \PHP_CodeSniffer\Sniffs\Sniff
{
    public const CODE_MISSING_ANY_TYPE_HINT = 'MissingAnyTypeHint';
    public const CODE_MISSING_NATIVE_TYPE_HINT = 'MissingNativeTypeHint';
    public const CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION = 'MissingTraversableTypeHintSpecification';
    public const CODE_USELESS_ANNOTATION = 'UselessAnnotation';
    private const NAME = 'SlevomatCodingStandard.TypeHints.ParameterTypeHint';
    /** @var bool|null */
    public $enableObjectTypeHint = null;
    /** @var string[] */
    public $traversableTypeHints = [];
    /** @var array<int, string>|null */
    private $normalizedTraversableTypeHints;
    /**
     * @return array<int, (int|string)>
     */
    public function register() : array
    {
        return [\T_FUNCTION];
    }
    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @param File $phpcsFile
     * @param int $functionPointer
     */
    public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $functionPointer) : void
    {
        $this->enableObjectTypeHint = \SlevomatCodingStandard\Helpers\SniffSettingsHelper::isEnabledByPhpVersion($this->enableObjectTypeHint, 70200);
        if (\SlevomatCodingStandard\Helpers\SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::NAME)) {
            return;
        }
        if (\SlevomatCodingStandard\Helpers\DocCommentHelper::hasInheritdocAnnotation($phpcsFile, $functionPointer)) {
            return;
        }
        $parametersTypeHints = \SlevomatCodingStandard\Helpers\FunctionHelper::getParametersTypeHints($phpcsFile, $functionPointer);
        $parametersAnnotations = \SlevomatCodingStandard\Helpers\FunctionHelper::getValidParametersAnnotations($phpcsFile, $functionPointer);
        $prefixedParametersAnnotations = \SlevomatCodingStandard\Helpers\FunctionHelper::getValidPrefixedParametersAnnotations($phpcsFile, $functionPointer);
        $this->checkTypeHints($phpcsFile, $functionPointer, $parametersTypeHints, $parametersAnnotations, $prefixedParametersAnnotations);
        $this->checkTraversableTypeHintSpecification($phpcsFile, $functionPointer, $parametersTypeHints, $parametersAnnotations, $prefixedParametersAnnotations);
        $this->checkUselessAnnotations($phpcsFile, $functionPointer, $parametersTypeHints, $parametersAnnotations);
    }
    /**
     * @param File $phpcsFile
     * @param int $functionPointer
     * @param (ParameterTypeHint|null)[] $parametersTypeHints
     * @param ParameterAnnotation[] $parametersAnnotations
     * @param ParameterAnnotation[] $prefixedParametersAnnotations
     */
    private function checkTypeHints(\PHP_CodeSniffer\Files\File $phpcsFile, int $functionPointer, array $parametersTypeHints, array $parametersAnnotations, array $prefixedParametersAnnotations) : void
    {
        $parametersWithoutTypeHint = \array_keys(\array_filter($parametersTypeHints, static function (?\SlevomatCodingStandard\Helpers\ParameterTypeHint $parameterTypeHint = null) : bool {
            return $parameterTypeHint === null;
        }));
        foreach ($parametersWithoutTypeHint as $parameterName) {
            if (!\array_key_exists($parameterName, $parametersAnnotations)) {
                if (\array_key_exists($parameterName, $prefixedParametersAnnotations)) {
                    continue;
                }
                if (\SlevomatCodingStandard\Helpers\SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::getSniffName(self::CODE_MISSING_ANY_TYPE_HINT))) {
                    continue;
                }
                $phpcsFile->addError(\sprintf('%s %s() does not have parameter type hint nor @param annotation for its parameter %s.', \SlevomatCodingStandard\Helpers\FunctionHelper::getTypeLabel($phpcsFile, $functionPointer), \SlevomatCodingStandard\Helpers\FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer), $parameterName), $functionPointer, self::CODE_MISSING_ANY_TYPE_HINT);
                continue;
            }
            if (\SlevomatCodingStandard\Helpers\SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::getSniffName(self::CODE_MISSING_NATIVE_TYPE_HINT))) {
                continue;
            }
            $parameterTypeNode = $parametersAnnotations[$parameterName]->getType();
            if ($parameterTypeNode instanceof \_PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode && \strtolower($parameterTypeNode->name) === 'null') {
                continue;
            }
            $originalParameterTypeNode = $parameterTypeNode;
            if ($parameterTypeNode instanceof \_PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\NullableTypeNode) {
                $parameterTypeNode = $parameterTypeNode->type;
            }
            $typeHints = [];
            $nullableParameterTypeHint = \false;
            if (\SlevomatCodingStandard\Helpers\AnnotationTypeHelper::containsOneType($parameterTypeNode)) {
                /** @var ArrayTypeNode|ArrayShapeNode|IdentifierTypeNode|ThisTypeNode|GenericTypeNode|CallableTypeNode|ConstTypeNode $parameterTypeNode */
                $parameterTypeNode = $parameterTypeNode;
                $typeHints[] = \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::getTypeHintFromOneType($parameterTypeNode);
            } elseif ($parameterTypeNode instanceof \_PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\UnionTypeNode || $parameterTypeNode instanceof \_PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\IntersectionTypeNode) {
                $traversableTypeHints = [];
                foreach ($parameterTypeNode->types as $typeNode) {
                    if (!\SlevomatCodingStandard\Helpers\AnnotationTypeHelper::containsOneType($typeNode)) {
                        continue 2;
                    }
                    /** @var ArrayTypeNode|ArrayShapeNode|IdentifierTypeNode|ThisTypeNode|GenericTypeNode|CallableTypeNode|ConstTypeNode $typeNode */
                    $typeNode = $typeNode;
                    $typeHint = \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::getTypeHintFromOneType($typeNode);
                    if (\strtolower($typeHint) === 'null') {
                        $nullableParameterTypeHint = \true;
                        continue;
                    }
                    $isTraversable = \SlevomatCodingStandard\Helpers\TypeHintHelper::isTraversableType(\SlevomatCodingStandard\Helpers\TypeHintHelper::getFullyQualifiedTypeHint($phpcsFile, $functionPointer, $typeHint), $this->getTraversableTypeHints());
                    if (!$isTraversable && \count($traversableTypeHints) > 0) {
                        continue 2;
                    }
                    if (!$typeNode instanceof \_PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode && !$typeNode instanceof \_PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\ArrayShapeNode && $isTraversable) {
                        $traversableTypeHints[] = $typeHint;
                    }
                    $typeHints[] = $typeHint;
                }
                $traversableTypeHints = \array_values(\array_unique($traversableTypeHints));
                if (\count($traversableTypeHints) > 1) {
                    continue;
                }
            }
            $typeHints = \array_values(\array_unique($typeHints));
            if (\count($typeHints) === 1) {
                $possibleParameterTypeHint = $typeHints[0];
            } elseif (\count($typeHints) === 2) {
                /** @var UnionTypeNode|IntersectionTypeNode $parameterTypeNode */
                $parameterTypeNode = $parameterTypeNode;
                $itemsSpecificationTypeHint = \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::getItemsSpecificationTypeFromType($parameterTypeNode);
                if ($itemsSpecificationTypeHint === null) {
                    continue;
                }
                $possibleParameterTypeHint = \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::getTraversableTypeHintFromType($parameterTypeNode, $phpcsFile, $functionPointer, $this->getTraversableTypeHints());
                if ($possibleParameterTypeHint === null) {
                    continue;
                }
            } else {
                continue;
            }
            if (!\SlevomatCodingStandard\Helpers\TypeHintHelper::isValidTypeHint($possibleParameterTypeHint, $this->enableObjectTypeHint)) {
                continue;
            }
            if ($originalParameterTypeNode instanceof \_PhpScoper6a1dd9b8a650\PHPStan\PhpDocParser\Ast\Type\NullableTypeNode) {
                $nullableParameterTypeHint = \true;
            }
            $fix = $phpcsFile->addFixableError(\sprintf('%s %s() does not have native type hint for its parameter %s but it should be possible to add it based on @param annotation "%s".', \SlevomatCodingStandard\Helpers\FunctionHelper::getTypeLabel($phpcsFile, $functionPointer), \SlevomatCodingStandard\Helpers\FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer), $parameterName, \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::export($parameterTypeNode)), $functionPointer, self::CODE_MISSING_NATIVE_TYPE_HINT);
            if (!$fix) {
                continue;
            }
            $parameterTypeHint = \SlevomatCodingStandard\Helpers\TypeHintHelper::isSimpleTypeHint($possibleParameterTypeHint) ? \SlevomatCodingStandard\Helpers\TypeHintHelper::convertLongSimpleTypeHintToShort($possibleParameterTypeHint) : $possibleParameterTypeHint;
            $tokens = $phpcsFile->getTokens();
            /** @var int $parameterPointer */
            $parameterPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findNextContent($phpcsFile, \T_VARIABLE, $parameterName, $tokens[$functionPointer]['parenthesis_opener'], $tokens[$functionPointer]['parenthesis_closer']);
            $beforeParameterPointer = $parameterPointer;
            do {
                $previousPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPreviousEffective($phpcsFile, $beforeParameterPointer - 1, $tokens[$functionPointer]['parenthesis_opener'] + 1);
                if ($previousPointer === null || !\in_array($tokens[$previousPointer]['code'], [\T_BITWISE_AND, \T_ELLIPSIS], \true)) {
                    break;
                }
                /** @var int $beforeParameterPointer */
                $beforeParameterPointer = $previousPointer;
            } while (\true);
            $phpcsFile->fixer->beginChangeset();
            $phpcsFile->fixer->addContentBefore($beforeParameterPointer, \sprintf('%s%s ', $nullableParameterTypeHint ? '?' : '', $parameterTypeHint));
            $phpcsFile->fixer->endChangeset();
        }
    }
    /**
     * @param File $phpcsFile
     * @param int $functionPointer
     * @param (ParameterTypeHint|null)[] $parametersTypeHints
     * @param ParameterAnnotation[] $parametersAnnotations
     * @param ParameterAnnotation[] $prefixedParametersAnnotations
     */
    private function checkTraversableTypeHintSpecification(\PHP_CodeSniffer\Files\File $phpcsFile, int $functionPointer, array $parametersTypeHints, array $parametersAnnotations, array $prefixedParametersAnnotations) : void
    {
        if (\SlevomatCodingStandard\Helpers\SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::getSniffName(self::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION))) {
            return;
        }
        foreach ($parametersTypeHints as $parameterName => $parameterTypeHint) {
            if (\array_key_exists($parameterName, $prefixedParametersAnnotations)) {
                continue;
            }
            $hasTraversableTypeHint = \false;
            if ($parameterTypeHint !== null && \SlevomatCodingStandard\Helpers\TypeHintHelper::isTraversableType(\SlevomatCodingStandard\Helpers\TypeHintHelper::getFullyQualifiedTypeHint($phpcsFile, $functionPointer, $parameterTypeHint->getTypeHint()), $this->getTraversableTypeHints())) {
                $hasTraversableTypeHint = \true;
            } elseif (\array_key_exists($parameterName, $parametersAnnotations) && \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::containsTraversableType($parametersAnnotations[$parameterName]->getType(), $phpcsFile, $functionPointer, $this->getTraversableTypeHints())) {
                $hasTraversableTypeHint = \true;
            }
            if ($hasTraversableTypeHint && !\array_key_exists($parameterName, $parametersAnnotations)) {
                $phpcsFile->addError(\sprintf('%s %s() does not have @param annotation for its traversable parameter %s.', \SlevomatCodingStandard\Helpers\FunctionHelper::getTypeLabel($phpcsFile, $functionPointer), \SlevomatCodingStandard\Helpers\FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer), $parameterName), $functionPointer, self::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION);
            } elseif (\array_key_exists($parameterName, $parametersAnnotations)) {
                $parameterTypeNode = $parametersAnnotations[$parameterName]->getType();
                if (($hasTraversableTypeHint || \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::containsTraversableType($parameterTypeNode, $phpcsFile, $functionPointer, $this->getTraversableTypeHints())) && !\SlevomatCodingStandard\Helpers\AnnotationTypeHelper::containsItemsSpecificationForTraversable($parameterTypeNode, $phpcsFile, $functionPointer, $this->getTraversableTypeHints())) {
                    $phpcsFile->addError(\sprintf('@param annotation of %s %s() does not specify type hint for items of its traversable parameter %s.', \lcfirst(\SlevomatCodingStandard\Helpers\FunctionHelper::getTypeLabel($phpcsFile, $functionPointer)), \SlevomatCodingStandard\Helpers\FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer), $parameterName), $parametersAnnotations[$parameterName]->getStartPointer(), self::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION);
                }
            }
        }
    }
    /**
     * @param File $phpcsFile
     * @param int $functionPointer
     * @param (ParameterTypeHint|null)[] $parametersTypeHints
     * @param ParameterAnnotation[] $parametersAnnotations
     */
    private function checkUselessAnnotations(\PHP_CodeSniffer\Files\File $phpcsFile, int $functionPointer, array $parametersTypeHints, array $parametersAnnotations) : void
    {
        if (\SlevomatCodingStandard\Helpers\SuppressHelper::isSniffSuppressed($phpcsFile, $functionPointer, self::getSniffName(self::CODE_USELESS_ANNOTATION))) {
            return;
        }
        foreach ($parametersTypeHints as $parameterName => $parameterTypeHint) {
            if (!\array_key_exists($parameterName, $parametersAnnotations)) {
                continue;
            }
            $parameterAnnotation = $parametersAnnotations[$parameterName];
            if (!\SlevomatCodingStandard\Helpers\AnnotationHelper::isAnnotationUseless($phpcsFile, $functionPointer, $parameterTypeHint, $parameterAnnotation, $this->getTraversableTypeHints())) {
                continue;
            }
            $fix = $phpcsFile->addFixableError(\sprintf('%s %s() has useless @param annotation for parameter %s.', \SlevomatCodingStandard\Helpers\FunctionHelper::getTypeLabel($phpcsFile, $functionPointer), \SlevomatCodingStandard\Helpers\FunctionHelper::getFullyQualifiedName($phpcsFile, $functionPointer), $parameterName), $parameterAnnotation->getStartPointer(), self::CODE_USELESS_ANNOTATION);
            if (!$fix) {
                continue;
            }
            $docCommentOpenPointer = \SlevomatCodingStandard\Helpers\DocCommentHelper::findDocCommentOpenToken($phpcsFile, $functionPointer);
            $starPointer = \SlevomatCodingStandard\Helpers\TokenHelper::findPrevious($phpcsFile, \T_DOC_COMMENT_STAR, $parameterAnnotation->getStartPointer() - 1, $docCommentOpenPointer);
            $changeStart = $starPointer ?? $docCommentOpenPointer + 1;
            /** @var int $changeEnd */
            $changeEnd = \SlevomatCodingStandard\Helpers\TokenHelper::findNext($phpcsFile, [\T_DOC_COMMENT_CLOSE_TAG, \T_DOC_COMMENT_STAR], $parameterAnnotation->getEndPointer() + 1) - 1;
            $phpcsFile->fixer->beginChangeset();
            for ($i = $changeStart; $i <= $changeEnd; $i++) {
                $phpcsFile->fixer->replaceToken($i, '');
            }
            $phpcsFile->fixer->endChangeset();
        }
    }
    private function getSniffName(string $sniffName) : string
    {
        return \sprintf('%s.%s', self::NAME, $sniffName);
    }
    /**
     * @return array<int, string>
     */
    private function getTraversableTypeHints() : array
    {
        if ($this->normalizedTraversableTypeHints === null) {
            $this->normalizedTraversableTypeHints = \array_map(static function (string $typeHint) : string {
                return \SlevomatCodingStandard\Helpers\NamespaceHelper::isFullyQualifiedName($typeHint) ? $typeHint : \sprintf('%s%s', \SlevomatCodingStandard\Helpers\NamespaceHelper::NAMESPACE_SEPARATOR, $typeHint);
            }, \SlevomatCodingStandard\Helpers\SniffSettingsHelper::normalizeArray($this->traversableTypeHints));
        }
        return $this->normalizedTraversableTypeHints;
    }
}
