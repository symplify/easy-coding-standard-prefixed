<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper776637f3d3c3\Symfony\Component\Cache\Marshaller;

/**
 * A marshaller optimized for data structures generated by AbstractTagAwareAdapter.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class TagAwareMarshaller implements \_PhpScoper776637f3d3c3\Symfony\Component\Cache\Marshaller\MarshallerInterface
{
    private $marshaller;
    public function __construct(\_PhpScoper776637f3d3c3\Symfony\Component\Cache\Marshaller\MarshallerInterface $marshaller = null)
    {
        $this->marshaller = $marshaller ?? new \_PhpScoper776637f3d3c3\Symfony\Component\Cache\Marshaller\DefaultMarshaller();
    }
    /**
     * {@inheritdoc}
     */
    public function marshall(array $values, ?array &$failed) : array
    {
        $failed = $notSerialized = $serialized = [];
        foreach ($values as $id => $value) {
            if (\is_array($value) && \is_array($value['tags'] ?? null) && \array_key_exists('value', $value) && \count($value) === 2 + (\is_string($value['meta'] ?? null) && 8 === \strlen($value['meta']))) {
                // if the value is an array with keys "tags", "value" and "meta", use a compact serialization format
                // magic numbers in the form 9D-..-..-..-..-00-..-..-..-5F allow detecting this format quickly in unmarshall()
                $v = $this->marshaller->marshall($value, $f);
                if ($f) {
                    $f = [];
                    $failed[] = $id;
                } else {
                    if ([] === $value['tags']) {
                        $v['tags'] = '';
                    }
                    $serialized[$id] = "�" . ($value['meta'] ?? "\0\0\0\0\0\0\0\0") . \pack('N', \strlen($v['tags'])) . $v['tags'] . $v['value'];
                    $serialized[$id][9] = "_";
                }
            } else {
                // other arbitratry values are serialized using the decorated marshaller below
                $notSerialized[$id] = $value;
            }
        }
        if ($notSerialized) {
            $serialized += $this->marshaller->marshall($notSerialized, $f);
            $failed = \array_merge($failed, $f);
        }
        return $serialized;
    }
    /**
     * {@inheritdoc}
     */
    public function unmarshall(string $value)
    {
        // detect the compact format used in marshall() using magic numbers in the form 9D-..-..-..-..-00-..-..-..-5F
        if (13 >= \strlen($value) || "�" !== $value[0] || "\0" !== $value[5] || "_" !== $value[9]) {
            return $this->marshaller->unmarshall($value);
        }
        // data consists of value, tags and metadata which we need to unpack
        $meta = \substr($value, 1, 12);
        $meta[8] = "\0";
        $tagLen = \unpack('Nlen', $meta, 8)['len'];
        $meta = \substr($meta, 0, 8);
        return ['value' => $this->marshaller->unmarshall(\substr($value, 13 + $tagLen)), 'tags' => $tagLen ? $this->marshaller->unmarshall(\substr($value, 13, $tagLen)) : [], 'meta' => "\0\0\0\0\0\0\0\0" === $meta ? null : $meta];
    }
}
