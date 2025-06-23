@extends('layout')

@section('mainContent')
    <x-form.form :action="route('vc.generate')" method="POST" header="Login With OTP">
        <x-form.input-group
            id="phone"
            icon="ti-phone"
            label="Phone Number"
            placeholder="9123456789"
            :value="old('phone')"
            required
        />
    </x-form.form>
@endsection
