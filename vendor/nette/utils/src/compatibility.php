<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace _PhpScoper890197fe38f7\Nette\Utils;

use _PhpScoper890197fe38f7\Nette;
if (\false) {
    /** @deprecated use Nette\HtmlStringable */
    interface IHtmlString extends Nette\HtmlStringable
    {
    }
} elseif (!\interface_exists(\_PhpScoper890197fe38f7\Nette\Utils\IHtmlString::class)) {
    \class_alias(Nette\HtmlStringable::class, \_PhpScoper890197fe38f7\Nette\Utils\IHtmlString::class);
}
namespace _PhpScoper890197fe38f7\Nette\Localization;

if (\false) {
    /** @deprecated use Nette\Localization\Translator */
    interface ITranslator extends \_PhpScoper890197fe38f7\Nette\Localization\Translator
    {
    }
} elseif (!\interface_exists(\_PhpScoper890197fe38f7\Nette\Localization\ITranslator::class)) {
    \class_alias(\_PhpScoper890197fe38f7\Nette\Localization\Translator::class, \_PhpScoper890197fe38f7\Nette\Localization\ITranslator::class);
}
