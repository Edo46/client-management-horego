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
@endsection
