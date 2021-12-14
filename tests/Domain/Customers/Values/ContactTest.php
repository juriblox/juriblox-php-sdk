<?php

namespace JuriBlox\Sdk\Domain\Customers\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    const VALID_CONTACT_EMAIL = 'john.doe@domain.tld';

    const VALID_CONTACT_EMAIL_CAPITALS = 'John.Doe@DOMAIN.TLD';

    const VALID_CONTACT_NAME = 'John Doe';

    public function test_constructor_then_setEmail()
    {
        $contact = new Contact(self::VALID_CONTACT_NAME);
        $contact->setEmail(self::VALID_CONTACT_EMAIL);

        $this->assertEquals(self::VALID_CONTACT_EMAIL, $contact->getEmail());
    }

    public function test_contructor_then_setEmail_with_null()
    {
        $contact = new Contact(self::VALID_CONTACT_NAME, self::VALID_CONTACT_EMAIL);

        $this->assertEquals(self::VALID_CONTACT_EMAIL, $contact->getEmail());

        $contact->setEmail(null);

        $this->assertNull($contact->getEmail());
    }

    public function test_with_capitalized_email()
    {
        $contact = new Contact(self::VALID_CONTACT_NAME, self::VALID_CONTACT_EMAIL_CAPITALS);

        $this->assertEquals(self::VALID_CONTACT_EMAIL, $contact->getEmail());
    }

    public function test_with_invalid_email()
    {
        $this->expectException(AssertionFailedException::class);

        new Contact(self::VALID_CONTACT_NAME, 'INVALID');
    }

    public function test_with_valid_data()
    {
        $contact = new Contact(self::VALID_CONTACT_NAME, self::VALID_CONTACT_EMAIL);

        $this->assertEquals(self::VALID_CONTACT_NAME, $contact->getName());
        $this->assertEquals(self::VALID_CONTACT_EMAIL, $contact->getEmail());

        $this->assertEquals(sprintf('%s <%s>', self::VALID_CONTACT_NAME, self::VALID_CONTACT_EMAIL), (string) $contact);
    }

    public function test_without_email()
    {
        $contact = new Contact(self::VALID_CONTACT_NAME);

        $this->assertEquals(self::VALID_CONTACT_NAME, $contact->getName());
        $this->assertNull($contact->getEmail());

        $this->assertEquals($contact->getName(), (string) $contact);
    }
}
