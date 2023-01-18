<?php

namespace App\Actions\Contact;

use App\Models\Contact;
use App\Models\PhoneNumber;

class ContactUpdateAction
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
    public function handle(array $data, Contact $contact): Contact
    {
        $contact->fill($data);

        $this->updatePhoneNumber($contact, $data['number']);

        $contact->save();

        return tap($contact)->refresh();
    }

    /**
     * Update Phone Number for Contact
     *
     * @param Contact $contact
     * @param array $numbers
     * @return bool
     */
    public function updatePhoneNumber(Contact $contact, array $numbers): bool
    {
        // remove phone numbers from contact that are not in numbers array
        foreach ($contact->phoneNumbers as $phoneNumber) {
            if (! in_array($phoneNumber->number, $numbers)) {
                $phoneNumber->delete();
            }
        }
        // add new phone numbers to contact when they are not in the database
        foreach ($numbers as $number) {
            $alreadyAssigned = $contact->phoneNumbers->firstWhere('number', $number);
            if (
                empty($alreadyAssigned)
                && ! empty($number)
            ) {
                PhoneNumber::create(['number' => $number, 'contact_id' => $contact->id]);
            }
        }
        return true;
    }


}
