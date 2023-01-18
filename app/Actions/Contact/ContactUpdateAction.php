<?php

namespace App\Actions\Contact;

use App\Models\Contact;

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
    public static function execute(array $data, Contact $contact): Contact
    {
        $contact->fill($data);

//        foreach ($contact->phoneNumbers as $phoneNumber) {
//            if (! in_array($phoneNumber->number, $request->number)) {
//                $phoneNumber->delete();
//            }
//        }
//        foreach ($request->number as $number) {
//            $alreadyAssigned = $contact->phoneNumbers->firstWhere('number', $number);
//            if (
//                empty($alreadyAssigned)
//                && ! empty($number)
//            ) {
//                PhoneNumber::create(['number' => $number, 'contact_id' => $contact->id]);
//            }
//        }
        $contact->save();

        return $contact;
    }
}
