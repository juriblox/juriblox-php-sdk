<?php

namespace JuriBlox\Sdk\Domain;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation as Serializer;
use JuriBlox\Sdk\Validation\Assertion;

abstract class AbstractId extends AbstractValue implements IdInterface
{
    /**
     * @Accessor(getter="serialize", setter="unserialize")
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $id;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        Assertion::integerish($id);

        $this->id = (int) $id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getInteger();
    }

    /**
     * @return int
     */
    public function getInteger()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return $this->getInteger();
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $this->id = $serialized;
    }
}
