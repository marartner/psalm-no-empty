<?php declare(strict_types=1);

namespace Marartner\PsalmNoEmpty;

use Marartner\PsalmNoEmpty\Hooks\UsedEmptyHook;
use SimpleXMLElement;
use Psalm\Plugin\PluginEntryPointInterface;
use Psalm\Plugin\RegistrationInterface;
use function class_exists;

class Plugin implements PluginEntryPointInterface
{
    public function __invoke(RegistrationInterface $registration, ?SimpleXMLElement $config = null): void
    {
        if(class_exists(UsedEmptyHook::class)){
            $registration->registerHooksFromClass(UsedEmptyHook::class);
        }
    }
}

