@extends('layout')

@section('mainContent')
    <x-form.form :action="route('vc.store')" method="POST">
        <input type="hidden" name="phone" value="{{old('phone', session('phone'))}}"/>

        <x-form.input-group
            id="dummy-phone"
            icon="ti-phone"
            label="Phone Number"
            :value="$phone"
            disabled
            required
        />

        <x-form.input-group
            id="code"
            icon="ti-code"
            label="Code"
            type="number"
            required
        />
    </x-form.form>
@endsection
