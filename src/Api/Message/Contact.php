<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Contact as message
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Contact extends Message
{
    /**
     * Name of the contact. Max 28 characters.
     *
     * @var string
     */
    protected $name;

    /**
     * Phone number of the contact. Max 18 characters
     *
     * @var string
     */
    protected $phone_number;

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = [
        'contact' => 'setConcat'
    ];

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::CONTACT;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'contact' => [
                'name' => $this->getName(),
                'phone_number' => $this->getPhoneNumber(),
            ]
        ]);
    }

    /**
     * Get the value of Name of the contact. Max 28 characters.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name of the contact. Max 28 characters.
     *
     * @param string name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Phone number of the contact. Max 18 characters
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Set the value of Phone number of the contact. Max 18 characters
     *
     * @param string phone_number
     *
     * @return self
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Set the value of Phone number of the contact from contact array.
     *
     * @param array contact
     *
     * @return self
     */
    public function setConcat($contact)
    {
        $this->phone_number = $contact['phone_number'];

        return $this;
    }
}
