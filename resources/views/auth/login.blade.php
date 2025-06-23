@extends('layout')

@section('mainContent')
    <x-form.form :action="route('login.store')" method="POST" header="Login">
        <x-form.input-group
            id="phone"
            icon="ti-phone"
            label="Phone Number"
            placeholder="9123456789"
            :value="old('phone')"
            required
        />

        <x-form.input-group
            id="password"
            icon="ti-lock"
            label="Password"
            type="password"
            required
        />
    </x-form.form>
@endsection
