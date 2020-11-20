<?php

declare (strict_types=1);
namespace _PhpScoperb6d4bd368bd9\Migrify\PhpConfigPrinter\Printer;

use _PhpScoperb6d4bd368bd9\Migrify\PhpConfigPrinter\NodeTraverser\ImportFullyQualifiedNamesNodeTraverser;
use _PhpScoperb6d4bd368bd9\Migrify\PhpConfigPrinter\Printer\NodeDecorator\EmptyLineNodeDecorator;
use _PhpScoperb6d4bd368bd9\Nette\Utils\Strings;
use _PhpScoperb6d4bd368bd9\PhpParser\Node;
use _PhpScoperb6d4bd368bd9\PhpParser\Node\Expr\Array_;
use _PhpScoperb6d4bd368bd9\PhpParser\Node\Expr\MethodCall;
use _PhpScoperb6d4bd368bd9\PhpParser\Node\Scalar\LNumber;
use _PhpScoperb6d4bd368bd9\PhpParser\Node\Stmt\Declare_;
use _PhpScoperb6d4bd368bd9\PhpParser\Node\Stmt\DeclareDeclare;
use _PhpScoperb6d4bd368bd9\PhpParser\Node\Stmt\Nop;
use _PhpScoperb6d4bd368bd9\PhpParser\PrettyPrinter\Standard;
final class PhpParserPhpConfigPrinter extends \_PhpScoperb6d4bd368bd9\PhpParser\PrettyPrinter\Standard
{
    /**
     * @var string
     */
    private const EOL_CHAR = "\n";
    /**
     * @var ImportFullyQualifiedNamesNodeTraverser
     */
    private $importFullyQualifiedNamesNodeTraverser;
    /**
     * @var EmptyLineNodeDecorator
     */
    private $emptyLineNodeDecorator;
    public function __construct(\_PhpScoperb6d4bd368bd9\Migrify\PhpConfigPrinter\NodeTraverser\ImportFullyQualifiedNamesNodeTraverser $importFullyQualifiedNamesNodeTraverser, \_PhpScoperb6d4bd368bd9\Migrify\PhpConfigPrinter\Printer\NodeDecorator\EmptyLineNodeDecorator $emptyLineNodeDecorator)
    {
        $this->importFullyQualifiedNamesNodeTraverser = $importFullyQualifiedNamesNodeTraverser;
        $this->emptyLineNodeDecorator = $emptyLineNodeDecorator;
        parent::__construct();
    }
    public function prettyPrintFile(array $stmts) : string
    {
        $stmts = $this->importFullyQualifiedNamesNodeTraverser->traverseNodes($stmts);
        $this->emptyLineNodeDecorator->decorate($stmts);
        // adds "declare(strict_types=1);" to every file
        $stmts = $this->prependStrictTypesDeclare($stmts);
        $printedContent = parent::prettyPrintFile($stmts);
        // remove trailing spaces
        $printedContent = \_PhpScoperb6d4bd368bd9\Nette\Utils\Strings::replace($printedContent, '#^[ ]+\\n#m', "\n");
        // remove space before " :" in main closure
        $printedContent = \_PhpScoperb6d4bd368bd9\Nette\Utils\Strings::replace($printedContent, '#\\) : void#', '): void');
        // remove space between declare strict types
        $printedContent = \_PhpScoperb6d4bd368bd9\Nette\Utils\Strings::replace($printedContent, '#declare \\(strict#', 'declare(strict');
        return $printedContent . self::EOL_CHAR;
    }
    /**
     * Do not preslash all slashes (parent behavior), but only those:
     *
     * - followed by "\"
     * - by "'"
     * - or the end of the string
     *
     * Prevents `Vendor\Class` => `Vendor\\Class`.
     */
    protected function pSingleQuotedString(string $string) : string
    {
        return "'" . \_PhpScoperb6d4bd368bd9\Nette\Utils\Strings::replace($string, "#'|\\\\(?=[\\\\']|\$)#", '\\\\$0') . "'";
    }
    protected function pExpr_Array(\_PhpScoperb6d4bd368bd9\PhpParser\Node\Expr\Array_ $array) : string
    {
        $array->setAttribute('kind', \_PhpScoperb6d4bd368bd9\PhpParser\Node\Expr\Array_::KIND_SHORT);
        return parent::pExpr_Array($array);
    }
    protected function pExpr_MethodCall(\_PhpScoperb6d4bd368bd9\PhpParser\Node\Expr\MethodCall $methodCall) : string
    {
        $printedMethodCall = parent::pExpr_MethodCall($methodCall);
        return $this->indentFluentCallToNewline($printedMethodCall);
    }
    private function indentFluentCallToNewline(string $content) : string
    {
        $nextCallIndentReplacement = ')' . \PHP_EOL . \_PhpScoperb6d4bd368bd9\Nette\Utils\Strings::indent('->', 8, ' ');
        return \_PhpScoperb6d4bd368bd9\Nette\Utils\Strings::replace($content, '#\\)->#', $nextCallIndentReplacement);
    }
    /**
     * @param Node[] $stmts
     * @return Node[]
     */
    private function prependStrictTypesDeclare(array $stmts) : array
    {
        $strictTypesDeclare = $this->createStrictTypesDeclare();
        return \array_merge([$strictTypesDeclare, new \_PhpScoperb6d4bd368bd9\PhpParser\Node\Stmt\Nop()], $stmts);
    }
    private function createStrictTypesDeclare() : \_PhpScoperb6d4bd368bd9\PhpParser\Node\Stmt\Declare_
    {
        $declareDeclare = new \_PhpScoperb6d4bd368bd9\PhpParser\Node\Stmt\DeclareDeclare('strict_types', new \_PhpScoperb6d4bd368bd9\PhpParser\Node\Scalar\LNumber(1));
        return new \_PhpScoperb6d4bd368bd9\PhpParser\Node\Stmt\Declare_([$declareDeclare]);
    }
}
