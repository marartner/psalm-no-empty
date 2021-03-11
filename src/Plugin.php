<?php

namespace Marartner\PsalmNoEmpty;

use Marartner\PsalmNoEmpty\Issue\UsedEmptyConstruct;
use PhpParser\Node\Expr;
use Psalm\Codebase;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\IssueBuffer;
use Psalm\Plugin\Hook\AfterExpressionAnalysisInterface;
use Psalm\StatementsSource;
use SimpleXMLElement;
use Psalm\Plugin\PluginEntryPointInterface;
use Psalm\Plugin\RegistrationInterface;

class Plugin implements PluginEntryPointInterface, AfterExpressionAnalysisInterface
{
    public function __invoke(RegistrationInterface $registration, ?SimpleXMLElement $config = null): void
    {
        // TODO: Implement __invoke() method.
    }

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
    }
}
