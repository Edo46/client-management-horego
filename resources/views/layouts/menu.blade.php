@extends('layouts.main')
@section('menu')
    <li class="menu-title">Navigation</li>

    <li>
        <a href="{{ url('home') }}">
            <i data-feather="airplay"></i>
            <span> Dashboards </span>
        </a>
    </li>

    <li class="menu-title mt-2">Apps Master</li>

    <li>
        <a href="{{ url('manage-pic') }}" id="manage-pic">
            <i data-feather="user"></i>
            <span> Manage PIC </span>
        </a>
    </li>
    <li>
        <a href="{{ url('manage-organisation') }}" id="manage-organisation">
            <i data-feather="home"></i>
            <span> Manage Organisation </span>
        </a>
    </li>

    <li class="menu-title mt-2">Credential Setup</li>

    <li>
        <a href="{{ url('manage-user') }}" id="manage-user">
            <i data-feather="users"></i>
            <span> Manage Users </span>
        </a>
    </li>
@endsection
