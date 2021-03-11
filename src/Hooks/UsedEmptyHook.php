<?php declare(strict_types=1);

namespace Marartner\PsalmNoEmpty\Hooks;

use Marartner\PsalmNoEmpty\Issue\UsedEmptyConstruct;
use PhpParser\Node\Expr;
use Psalm\Codebase;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\IssueBuffer;
use Psalm\Plugin\Hook\AfterExpressionAnalysisInterface;
use Psalm\StatementsSource;

final class UsedEmptyHook implements AfterExpressionAnalysisInterface
{
    public static function afterExpressionAnalysis(Expr $expr, Context $context, StatementsSource $statements_source, Codebase $codebase, array &$file_replacements = []): ?bool
    {
        if ($expr instanceof Expr\Empty_) {
            IssueBuffer::accepts(
                new UsedEmptyConstruct(
                    'Do not use the empty() construct',
                    new CodeLocation($statements_source->getSource(), $expr)
                ),
                $statements_source->getSuppressedIssues()
            );
        }
        return null;
    }
}
