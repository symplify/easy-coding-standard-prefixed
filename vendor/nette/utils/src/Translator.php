<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace _PhpScoperd8b0b9452568\Nette\Localization;

/**
 * Translator adapter.
 */
interface Translator
{
    /**
     * Translates the given string.
     * @param  mixed  $message
     * @param  mixed  ...$parameters
     */
    function translate($message, ...$parameters) : string;
}
\interface_exists(\_PhpScoperd8b0b9452568\Nette\Localization\Nette\Localization\ITranslator::class);
