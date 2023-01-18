@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Contact</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('contacts.update', ['contact' => $contact]) }}">
            @csrf
            @method('put')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label col-md-6">First Name</label>
                    <input class="form-control"class="form-control" type="text" name="first_name" value="{{ old('first_name') ?? $contact->first_name }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label">Last Name</label>
                    <input class="form-control"type="text" name="last_name" value="{{ old('last_name') ?? $contact->last_name }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label">Date of Birth</label>
                    <input class="form-control"type="text" name="DOB" value="{{ old('DOB') ?? $contact->DOB }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label">Company</label>
                    <input class="form-control"type="text" name="company_name" value="{{ old('company_name') ?? $contact->company_name }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label">Position</label>
                    <input class="form-control"type="text" name="position" value="{{ old('position') ?? $contact->position }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label">Email</label>
                    <input class="form-control"type="text" name="email" value="{{ old('email') ?? $contact->email }}"/>
                </div>
            </div>
            @foreach($contact->phoneNumbers as $phoneNumber)
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input class="form-control"type="text" name="number[]" value="{{ $phoneNumber->number }}"/>
                    </div>
                </div>
            @endforeach
            {{-- Blank field outside the loop to allow new number. Refactor later to add multiple at a time. --}}
            <div class="form-group col-md-6">
                <label class="form-label">Phone Number</label>
                <input class="form-control float-start"type="text" name="number[]"/>
                <button class="btn btn-primary float-end" onclick="addNumber()">Add another phone</button>
            </div>
            <div class="form-row" id="additionalNumberArea">
                <div class="form-group col-md-6">
                </div>
            </div>
            <div class="form-group col-md-6">
               <div class="col-auto">
                   <button type="submit" class="btn btn-primary">Update</button>
               </div>
           </div>
        </form>
    </div>

    <script>
        // add a new label and input for an additional phone number
        function addNumber() {
            // stop the form from submitting
            event.preventDefault();
            let label = document.createElement('label');
            label.className = 'form-label';
            label.innerText = 'Phone Number';
            document.querySelector('#additionalNumberArea').appendChild(label);
            let number = document.createElement('input');
            number.setAttribute('type', 'text');
            number.classList = 'form-control col-md-6'
            number.setAttribute('name', 'number[]');
            label.appendChild(number);
        }

    </script>
@endsection
