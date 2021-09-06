@extends('layouts.app')
@section('title','myUsers')
@section('content')


@if(Session::has('success'))
    <div class="text-white bg-green-400 py-4 px-6 mb-4 rounded-lg">
        <b >{{session::get('success')}}</b>
    </div>
@endif
@if(Session::has('ERORR'))
    <div class="text-white bg-red-400 py-4 px-6 mb-4 rounded-lg ">
        <b >{{session::get('ERORR')}}</b>
    </div>
@endif
    <div>
        loggeduserinfo
        <div>
            {{Auth::guard('admin')->user()->name}}
        </div>
        <div>
            {{Auth::guard('admin')->user()->email}}
        </div>
        <div>
            {{Auth::guard('admin')->user()->phone}}
        </div>
        <div>
            <a href="{{ route('admin.logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('admin.logout') }}"  method="POST">
                @csrf
            </form>
        </div>

    </div>
    

@endsection

