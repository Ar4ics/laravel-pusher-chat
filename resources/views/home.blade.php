@extends('layouts.app')

@section('title', 'Групповая беседа')


@section('content')
<div class="container">
    <div class="row">
        <notifications position="top center" group="foo"></notifications>
        <div class="col-sm-6">
            <create-group :initial-users="{{ $users }}"></create-group>
        </div>
        <div class="col-sm-6">
            <groups :initial-groups="{{ $groups }}" :user="{{ $user }}"></groups>
        </div>
    </div>
</div>
@endsection
