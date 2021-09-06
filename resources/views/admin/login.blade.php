<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>yaman</title>
         <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body class=" bg-gray-200 text-white">
        <div class="mt-24 max-w-md w-600 lg:max-w-none mx-auto h-400 flex shadow-lg " 
        style="width: 500px;">
            
            <div class="w-full px-16 bg-white rounded-lg">
                <div class="max-w-lg mt-14 text-gray-700 ">
                    <div class="mb-12">
                        <p class="text-4xl font-bold text-center ">Login</p>
                    </div>
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
                    <form class="mb-16" method="post" action="{{ route('admin.check') }}">
                        @csrf
                        {{-- <div class="mb-4">
                             <p class="text-sm text-gray-600 font-semibold mb-2">What should we call you?</p>
                             <div class="relative">
                                 @error('name')
                                    <small class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                                <input type="text"  name="name" placeholder="Enter your name" 
                                class=" w-full py-2 px-10 bg-gray-200 rounded-lg">
                                 <i class="fa fa-user absolute left-0 top-0 ml-3 mt-3"></i>
                             </div>
                        </div> --}}

                        <div class="mb-4">
                             <p class="text-sm text-gray-600 font-semibold mb-2">Whats you email?</p>
                            <div class="relative">
                                <input type="email"  autocomplete="off" autofocus="" name="email" placeholder="Enter your email" class=" w-full py-2 px-10 bg-gray-200 rounded-lg">
                                 <i class="fa fa-envelope absolute left-0 top-0 ml-3 mt-3"></i>
                                @error('email')
                                    <small class=" text-red-500" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                             </div>
                        </div>
                        <div class="mb-4">
                             <p class="text-sm text-gray-600 font-semibold mb-2">What is your password?</p>
                             <div class="relative">
                                <input type="password"  name="password" placeholder="Enter your password" 
                                class=" w-full py-2 px-10 bg-gray-200 rounded-lg">
                                 <i class="fa fa-lock absolute absolute left-0 top-0 ml-3 mt-3"></i>
                                 @error('password')
                                    <small class=" text-red-500" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                             </div>
                        </div>                        
                        <button type="submit" class="w-full py-3 px-6 mt-4 bg-gray-700 text-white rounded-lg hover:bg-gray-500 mb-6">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
