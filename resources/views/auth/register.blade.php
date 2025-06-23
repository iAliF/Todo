@extends('layout')

@section('mainContent')
    <x-form.form :action="route('register.store')" method="POST" header="Register">

        <x-form.input-group
            id="name"
            icon="ti-user"
            label="Full Name"
            placeholder="John Doe"
            required
        />
        <x-form.input-group
            id="phone"
            icon="ti-phone"
            label="Phone Number"
            placeholder="912 345 6789"
            required
        />
        <x-form.input-group
            id="password"
            icon="ti-lock"
            label="Password"
            type="password"
            required
        />
        <x-form.input-group
            id="password_confirmation"
            icon="ti-lock"
            label="Password Repeat"
            type="password"
            required
        />

        <span class="d-inline-block mb-2">
            Have an account? <a href="{{route('login.create')}}">Login here</a>
        </span>
    </x-form.form>
@endsection
