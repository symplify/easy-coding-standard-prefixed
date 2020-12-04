<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperc233426b15e0\Symfony\Component\HttpKernel;

use _PhpScoperc233426b15e0\Symfony\Component\HttpClient\HttpClient;
use _PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\Request;
use _PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\Response;
use _PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\ResponseHeaderBag;
use _PhpScoperc233426b15e0\Symfony\Component\Mime\Part\AbstractPart;
use _PhpScoperc233426b15e0\Symfony\Component\Mime\Part\DataPart;
use _PhpScoperc233426b15e0\Symfony\Component\Mime\Part\Multipart\FormDataPart;
use _PhpScoperc233426b15e0\Symfony\Component\Mime\Part\TextPart;
use _PhpScoperc233426b15e0\Symfony\Contracts\HttpClient\HttpClientInterface;
/**
 * An implementation of a Symfony HTTP kernel using a "real" HTTP client.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class HttpClientKernel implements \_PhpScoperc233426b15e0\Symfony\Component\HttpKernel\HttpKernelInterface
{
    private $client;
    public function __construct(\_PhpScoperc233426b15e0\Symfony\Contracts\HttpClient\HttpClientInterface $client = null)
    {
        if (!\class_exists(\_PhpScoperc233426b15e0\Symfony\Component\HttpClient\HttpClient::class)) {
            throw new \LogicException(\sprintf('You cannot use "%s" as the HttpClient component is not installed. Try running "composer require symfony/http-client".', __CLASS__));
        }
        $this->client = $client ?? \_PhpScoperc233426b15e0\Symfony\Component\HttpClient\HttpClient::create();
    }
    public function handle(\_PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\Request $request, $type = \_PhpScoperc233426b15e0\Symfony\Component\HttpKernel\HttpKernelInterface::MASTER_REQUEST, $catch = \true) : \_PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\Response
    {
        $headers = $this->getHeaders($request);
        $body = '';
        if (null !== ($part = $this->getBody($request))) {
            $headers = \array_merge($headers, $part->getPreparedHeaders()->toArray());
            $body = $part->bodyToIterable();
        }
        $response = $this->client->request($request->getMethod(), $request->getUri(), ['headers' => $headers, 'body' => $body, 'max_redirects' => 0] + $request->attributes->get('http_client_options', []));
        $response = new \_PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\Response($response->getContent(!$catch), $response->getStatusCode(), $response->getHeaders(!$catch));
        $response->headers = new class($response->headers->all()) extends \_PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\ResponseHeaderBag
        {
            protected function computeCacheControlValue() : string
            {
                return $this->getCacheControlHeader();
                // preserve the original value
            }
        };
        return $response;
    }
    private function getBody(\_PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\Request $request) : ?\_PhpScoperc233426b15e0\Symfony\Component\Mime\Part\AbstractPart
    {
        if (\in_array($request->getMethod(), ['GET', 'HEAD'])) {
            return null;
        }
        if (!\class_exists(\_PhpScoperc233426b15e0\Symfony\Component\Mime\Part\AbstractPart::class)) {
            throw new \LogicException('You cannot pass non-empty bodies as the Mime component is not installed. Try running "composer require symfony/mime".');
        }
        if ($content = $request->getContent()) {
            return new \_PhpScoperc233426b15e0\Symfony\Component\Mime\Part\TextPart($content, 'utf-8', 'plain', '8bit');
        }
        $fields = $request->request->all();
        foreach ($request->files->all() as $name => $file) {
            $fields[$name] = \_PhpScoperc233426b15e0\Symfony\Component\Mime\Part\DataPart::fromPath($file->getPathname(), $file->getClientOriginalName(), $file->getClientMimeType());
        }
        return new \_PhpScoperc233426b15e0\Symfony\Component\Mime\Part\Multipart\FormDataPart($fields);
    }
    private function getHeaders(\_PhpScoperc233426b15e0\Symfony\Component\HttpFoundation\Request $request) : array
    {
        $headers = [];
        foreach ($request->headers as $key => $value) {
            $headers[$key] = $value;
        }
        $cookies = [];
        foreach ($request->cookies->all() as $name => $value) {
            $cookies[] = $name . '=' . $value;
        }
        if ($cookies) {
            $headers['cookie'] = \implode('; ', $cookies);
        }
        return $headers;
    }
}
