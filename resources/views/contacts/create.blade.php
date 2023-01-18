@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Add Contact</h1>
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
        <form class="g-3" method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-auto">
                        <label class="form-label">First Name
                            <input type="text" name="first_name" value="{{old('first_name')}}"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <label class="form-label">Last Name
                            <input type="text" name="last_name" value="{{old('last_name')}}"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <label class="form-label">Date of Birth
                            <input type="text" name="DOB" value="{{old('DOB')}}"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <label class="form-label">Company
                            <input type="text" name="company_name" value="{{old('company_name')}}"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <label class="form-label">Position
                            <input type="text" name="position" value="{{old('position')}}"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <label class="form-label">Email
                            <input type="text" name="email" value="{{old('email')}}"/>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <label class="form-label">Phone Number
                            <input type="text" name="number[]"/>
                            <button class="btn btn-primary" onclick="addNumber()">Add another phone</button>
                        </label>
                    </div>
                </div>
                <div class="row" id="additionalNumberArea">
                    <div class="col-auto">
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
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
            number.setAttribute('name', 'number[]');
            label.appendChild(number);
        }

    </script>
@endsection
