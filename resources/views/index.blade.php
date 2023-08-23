<!DOCTYPE html>
<html lang="en">
<head>
 @include('head')
</head>
<body>


        @auth
          <div class="container">
            <h6>Hello, {{auth()->user()->username}}</h6>
          </div>
          <div class="container mt-3 p-5 text-center">
             <div class="row" style="height:200px">
               <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{url('hd')}}';">
                 <i class="fa-solid fa-server"></i>
                 Home devices
                 </button></div>
              <div class="col-sm-4">
                <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{url('menu')}}';">
                <i class="fa-solid fa-utensils"></i>
                  Menu
                </button></div>
              <div class="col-sm-4">
                <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{url('calendar')}}';">
                <i class="fa-solid fa-calendar-days"></i>
                Events
                </button></div>
              </div>
             <div class="row" style="height:200px">
               <div class="col-sm-4">
                 <button type="button" class="btn btn-secondary btn-lg" disabled>
                   <i class="fa-solid fa-sack-dollar"></i>
                   Budget
                 </button></div>
              <div class="col-sm-4"><button type="button" class="btn btn-secondary btn-lg" disabled>
                <i class="fa-solid fa-sliders"></i>
                Settings
                </button></div>
                <div class="col-sm-4"><button type="button" class="btn btn-secondary btn-lg" disabled>
                  <i class="fa-solid fa-arrow-up"></i>
                  Kaizen
                </button></div>
              </div>
              <div class="row" style="height:200px">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                <button type="button" class="btn btn-danger btn-lg" onclick="location.href='{{url('logout')}}';">
                <i class="fa-solid fa-door-open"></i>
                Log out</button></div>
            </div>
          </div>
        @endauth
        @guest
        <div class="container col-sm-4 mt-3 p-5 text-center">
          <form method="post" action="{{ route('login.perform') }}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <h1 class="h3 mb-3 fw-normal">Login</h1>

            @include('layouts.partials.messages')

            <div class="form-group form-floating mb-3">
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                <label for="floatingName">Email or Username</label>
                @if ($errors->has('username'))
                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="form-group form-floating mb-3">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                <label for="floatingPassword">Password</label>
                @if ($errors->has('password'))
                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

            @include('auth.partials.copy')
          </form>
          Don't have accout? <a href="{{url('register')}}">Sign in</a> now!
        </div>
        @endguest

</body>
</html>
