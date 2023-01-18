<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ContactHttpTest extends TestCase
{
    // create setup function for db transactions and db rollback.
    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }
    // create setdown function for db transactions and db rollback.
    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }

    public function test_can_create_contact_and_can_view_it()
    {
        // create a new contact and save it to the database
        $contact = Contact::factory()->create();
        // view the contact using http route
        $this->get('/contacts/' . $contact->id)
            ->assertSessionDoesntHaveErrors()
            ->assertStatus(200);
    }

    public function test_can_update_contact_without_changing_data()
    {
        $contact = Contact::factory()->create();
        // update the contact using http route
        $this->put('/contacts/' . $contact->id, [
            'first_name' => $contact->first_name,
            'last_name' => $contact->last_name,
            'company_name' => $contact->company_name,
            'position' => $contact->position,
            'number' => [$contact->phoneNumbers->first()->number],
        ])->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertEquals($contact->first_name, $contact->fresh()->first_name);
        $this->assertEquals($contact->last_name, $contact->fresh()->last_name);
        $this->assertEquals($contact->company_name, $contact->fresh()->company_name);
        $this->assertEquals($contact->position, $contact->fresh()->position);
    }

    public function test_can_update_contact_by_changing_data()
    {
        $contact = Contact::factory()->create();
        // update the contact using http route
        $this->put('/contacts/' . $contact->id, [
            'first_name' => 'new first name',
            'last_name' => 'new last name',
            'company_name' => 'new company name',
            'position' => 'new position',
            'number' => [$contact->phoneNumbers->first()->number],
        ])->assertSessionDoesntHaveErrors()
            ->assertStatus(302);

        $this->assertNotEquals($contact->first_name, $contact->fresh()->first_name);
        $this->assertNotEquals($contact->last_name, $contact->fresh()->last_name);
        $this->assertNotEquals($contact->company_name, $contact->fresh()->company_name);
        $this->assertNotEquals($contact->position, $contact->fresh()->position);
    }

    public function test_can_delete_contact()
    {
        $contact = Contact::factory()->create();
        $this->delete('/contacts/' . $contact->id)
            ->assertStatus(302);
    }

    // test can search for a contact by first name and last name and company name using http route
    public function test_can_search_for_a_contact_by_first_name_and_last_name_and_company_name()
    {
        $contact = Contact::factory()->create();
        $contact2 = Contact::factory()->create();

        $this->get('/contacts?query=' . $contact->first_name)
            ->assertSee($contact->first_name)
            ->assertOk();
        $this->get('/contacts?query=' . $contact->first_name)
            ->assertDontSee($contact2->first_name)
            ->assertOk();

        $this->get('/contacts?query=' . $contact->last_name)
            ->assertSee($contact->first_name)
            ->assertOk();
        $this->get('/contacts?query=' . $contact->last_name)
            ->assertDontSee($contact2->first_name)
            ->assertOk();

        $this->get('/contacts?query=' . $contact->company_name)
            ->assertSee($contact->first_name)
            ->assertOk();
        $this->get('/contacts?query=' . $contact->company_name)
            ->assertDontSee($contact2->first_name)
            ->assertOk();


    }
}
