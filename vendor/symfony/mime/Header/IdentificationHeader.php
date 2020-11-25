<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperaa402dd1b1f1\Symfony\Component\Mime\Header;

use _PhpScoperaa402dd1b1f1\Symfony\Component\Mime\Address;
use _PhpScoperaa402dd1b1f1\Symfony\Component\Mime\Exception\RfcComplianceException;
/**
 * An ID MIME Header for something like Message-ID or Content-ID (one or more addresses).
 *
 * @author Chris Corbyn
 *
 * @experimental in 4.3
 */
final class IdentificationHeader extends \_PhpScoperaa402dd1b1f1\Symfony\Component\Mime\Header\AbstractHeader
{
    private $ids = [];
    private $idsAsAddresses = [];
    /**
     * @param string|array $ids
     */
    public function __construct(string $name, $ids)
    {
        parent::__construct($name);
        $this->setId($ids);
    }
    /**
     * @param string|array $body a string ID or an array of IDs
     *
     * @throws RfcComplianceException
     */
    public function setBody($body)
    {
        $this->setId($body);
    }
    /**
     * @return array
     */
    public function getBody()
    {
        return $this->getIds();
    }
    /**
     * Set the ID used in the value of this header.
     *
     * @param string|array $id
     *
     * @throws RfcComplianceException
     */
    public function setId($id)
    {
        $this->setIds(\is_array($id) ? $id : [$id]);
    }
    /**
     * Get the ID used in the value of this Header.
     *
     * If multiple IDs are set only the first is returned.
     */
    public function getId() : ?string
    {
        return $this->ids[0] ?? null;
    }
    /**
     * Set a collection of IDs to use in the value of this Header.
     *
     * @param string[] $ids
     *
     * @throws RfcComplianceException
     */
    public function setIds(array $ids)
    {
        $this->ids = [];
        $this->idsAsAddresses = [];
        foreach ($ids as $id) {
            $this->idsAsAddresses[] = new \_PhpScoperaa402dd1b1f1\Symfony\Component\Mime\Address($id);
            $this->ids[] = $id;
        }
    }
    /**
     * Get the list of IDs used in this Header.
     *
     * @return string[]
     */
    public function getIds() : array
    {
        return $this->ids;
    }
    public function getBodyAsString() : string
    {
        $addrs = [];
        foreach ($this->idsAsAddresses as $address) {
            $addrs[] = '<' . $address->toString() . '>';
        }
        return \implode(' ', $addrs);
    }
}
