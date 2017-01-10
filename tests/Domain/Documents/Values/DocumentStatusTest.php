<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class DocumentStatusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_status()
    {
        new DocumentStatus(-100, 'Invalid document status');
    }

    /**
     * @dataProvider availableStatusesProvider
     *
     * @param string $code
     * @param string $name
     */
    public function test_with_valid_data($code, $name)
    {
        $status = new DocumentStatus($code, $name);

        $this->assertEquals($code, $status->getCode());
        $this->assertEquals($code, (string) $status);

        $this->assertEquals($name, $status->getName());
    }

    public function availableStatusesProvider()
    {
        $statuses = [];
        foreach (DocumentStatus::$statuses as $code => $name) {
            $statuses[] = [$code, $name];
        }

        return $statuses;
    }
}
