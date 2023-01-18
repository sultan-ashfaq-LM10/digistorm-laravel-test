<?php

namespace App\Actions\Contact;

use App\Models\Contact;
use App\Models\PhoneNumber;

class ContactStoreAction
{
    /**
     * @param array $data {
     *  first_name: string,
     *  last_name: string,
     *  DOB: date,
     *  company_name: string,
     *  position: string,
     *  email: string,
     * }
     * @return void
     */
    public function handle(array $data): Contact
    {
        $contact = new Contact();
        $contact->fill($data);
        $contact->save();
        $this->addPhoneNumber($data['number'], $contact->id);
        return tap($contact)->refresh();
    }

    /**
     * Add phone number to contact
     *
     * @param array $numbers
     * @param int $contactId
     * @return bool
     */
    public function addPhoneNumber(array $numbers, int $contactId): bool
    {
        foreach ($numbers as $number) {
            if (empty($number)) {
                continue;
            }
            PhoneNumber::create(['number' => $number, 'contact_id' => $contactId]);
        }
        return true;
    }
}
