<?php

namespace App\Actions\Contact;

use App\Models\Contact;

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
    public static function execute(array $data): Contact
    {
        $contact = new Contact();
        $contact->fill($data);
        $contact->save();

//        foreach ($data->number as $number) {
//            PhoneNumber::create(['number' => $number, 'contact_id' => $contact->id]);
//        }

        return $contact;

    }
}
