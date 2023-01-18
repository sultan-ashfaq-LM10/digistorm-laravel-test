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
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="col-auto">
                        <label class="form-label">First Name</label>
                        <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}"/>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="col-auto">
                        <label class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}"/>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="col-auto">
                        <label class="form-label">Date of Birth</label>
                        <input class="form-control" type="text" name="DOB" value="{{old('DOB')}}"/>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="col-auto">
                        <label class="form-label">Company</label>
                        <input class="form-control" type="text" name="company_name" value="{{old('company_name')}}"/>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="col-auto">
                        <label class="form-label">Position</label>
                        <input class="form-control" type="text" name="position" value="{{old('position')}}"/>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="col-auto">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="text" name="email" value="{{old('email')}}"/>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="col-auto">
                        <label class="form-label">Phone Number</label>
                        <input class="form-control float-start" type="text" name="number[]"/>
                        <button class="btn btn-primary float-end" onclick="addNumber()">Add another phone</button>
                    </div>
                </div>
                <div class="form-group col-md-6" id="additionalNumberArea">
                    <div class="col-auto">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Add Contact</button>
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
            number.classList = 'form-control col-md-6'
            number.setAttribute('name', 'number[]');
            label.appendChild(number);
        }

    </script>
@endsection
