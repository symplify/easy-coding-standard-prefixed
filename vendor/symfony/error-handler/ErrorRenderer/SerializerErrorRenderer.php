<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper833c56a97273\Symfony\Component\ErrorHandler\ErrorRenderer;

use _PhpScoper833c56a97273\Symfony\Component\ErrorHandler\Exception\FlattenException;
use _PhpScoper833c56a97273\Symfony\Component\HttpFoundation\RequestStack;
use _PhpScoper833c56a97273\Symfony\Component\Serializer\Exception\NotEncodableValueException;
use _PhpScoper833c56a97273\Symfony\Component\Serializer\SerializerInterface;
/**
 * Formats an exception using Serializer for rendering.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class SerializerErrorRenderer implements \_PhpScoper833c56a97273\Symfony\Component\ErrorHandler\ErrorRenderer\ErrorRendererInterface
{
    private $serializer;
    private $format;
    private $fallbackErrorRenderer;
    /**
     * @param string|callable(FlattenException) $format The format as a string or a callable that should return it
     */
    public function __construct(\_PhpScoper833c56a97273\Symfony\Component\Serializer\SerializerInterface $serializer, $format, \_PhpScoper833c56a97273\Symfony\Component\ErrorHandler\ErrorRenderer\ErrorRendererInterface $fallbackErrorRenderer = null)
    {
        if (!\is_string($format) && !\is_callable($format)) {
            throw new \TypeError(\sprintf('Argument 2 passed to %s() must be a string or a callable, %s given.', __METHOD__, \is_object($format) ? \get_class($format) : \gettype($format)));
        }
        $this->serializer = $serializer;
        $this->format = $format;
        $this->fallbackErrorRenderer = $fallbackErrorRenderer ?? new \_PhpScoper833c56a97273\Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer();
    }
    /**
     * {@inheritdoc}
     */
    public function render(\Throwable $exception) : \_PhpScoper833c56a97273\Symfony\Component\ErrorHandler\Exception\FlattenException
    {
        $flattenException = \_PhpScoper833c56a97273\Symfony\Component\ErrorHandler\Exception\FlattenException::createFromThrowable($exception);
        try {
            $format = \is_string($this->format) ? $this->format : ($this->format)($flattenException);
            return $flattenException->setAsString($this->serializer->serialize($flattenException, $format, ['exception' => $exception]));
        } catch (\_PhpScoper833c56a97273\Symfony\Component\Serializer\Exception\NotEncodableValueException $e) {
            return $this->fallbackErrorRenderer->render($exception);
        }
    }
    public static function getPreferredFormat(\_PhpScoper833c56a97273\Symfony\Component\HttpFoundation\RequestStack $requestStack) : \Closure
    {
        return static function () use($requestStack) {
            if (!($request = $requestStack->getCurrentRequest())) {
                throw new \_PhpScoper833c56a97273\Symfony\Component\Serializer\Exception\NotEncodableValueException();
            }
            return $request->getPreferredFormat();
        };
    }
}
