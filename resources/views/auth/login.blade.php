@extends('layout')

@section('mainContent')
    <x-form.form :action="route('login.store')" method="POST">
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
    </x-form.form>
@endsection
