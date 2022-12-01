<?php declare(strict_types=1);

namespace Marartner\PsalmNoEmpty\Hooks;

use Marartner\PsalmNoEmpty\Issue\UsedEmptyConstruct;
use PhpParser\Node\Expr;
use Psalm\CodeLocation;
use Psalm\IssueBuffer;
use Psalm\Plugin\EventHandler\AfterExpressionAnalysisInterface;
use Psalm\Plugin\EventHandler\Event\AfterExpressionAnalysisEvent;

final class UsedEmptyHook implements AfterExpressionAnalysisInterface
{
    public static function afterExpressionAnalysis(AfterExpressionAnalysisEvent $event): ?bool
    {
        $expr = $event->getExpr();
        if ($expr instanceof Expr\Empty_) {
            $statements_source = $event->getStatementsSource();
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
