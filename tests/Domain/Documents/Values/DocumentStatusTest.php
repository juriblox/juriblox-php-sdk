<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class DocumentStatusTest extends TestCase
{
    public function test_with_invalid_status()
    {
        $this->expectException(AssertionFailedException::class);

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
        $this->assertEquals("{$status->getName()} [{$status->getCode()}]", (string) $status);

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
