<?php

namespace JuriBlox\Sdk\Domain\Customers\Values;

class ContactTest extends \PHPUnit_Framework_TestCase
{
    const VALID_CONTACT_EMAIL = 'john.doe@domain.tld';

    const VALID_CONTACT_EMAIL_CAPITALS = 'John.Doe@DOMAIN.TLD';

    const VALID_CONTACT_NAME = 'John Doe';

    public function test_with_capitalized_email()
    {
        $contact = new Contact(self::VALID_CONTACT_NAME, self::VALID_CONTACT_EMAIL_CAPITALS);

        $this->assertEquals(self::VALID_CONTACT_EMAIL, $contact->getEmail());
    }

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_email()
    {
        new Contact(self::VALID_CONTACT_NAME, 'INVALID');
    }

    public function test_with_valid_data()
    {
        $contact = new Contact(self::VALID_CONTACT_NAME, self::VALID_CONTACT_EMAIL);

        $this->assertEquals(self::VALID_CONTACT_NAME, $contact->getName());
        $this->assertEquals(self::VALID_CONTACT_EMAIL, $contact->getEmail());

        $this->assertEquals(sprintf('%s <%s>', self::VALID_CONTACT_NAME, self::VALID_CONTACT_EMAIL), (string) $contact);
    }
}
