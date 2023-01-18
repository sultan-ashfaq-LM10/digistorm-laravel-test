<?php

namespace App\Http\Controllers;

use App\Actions\Contact\ContactStoreAction;
use App\Actions\Contact\ContactUpdateAction;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->has('query')) {
            $search = request()->get('query');
            $contacts = Contact::query()
                ->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('company_name', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $contacts =  Contact::paginate(5);
        }

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(ContactStoreRequest $request)
    {
        $contact = ContactStoreAction::execute($request->validated());
        return view('contacts.show', compact('contact'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactUpdateRequest $request
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        ContactUpdateAction::execute($request->all(), $contact);

//        $contact->fill($request->all());
//
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
//        $contact->save();

        return redirect()->route('contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index');
    }
}
