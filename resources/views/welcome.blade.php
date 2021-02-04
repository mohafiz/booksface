<x-app-layout>
    <x-slot name="title">
      {{ config('app.name') }}
    </x-slot>

    <x-slot name="header">
        <!-- Begin Welcome Page -->
        @if(session()->has('NotAdmin'))
          <center>
            <div class="alert alert-danger">
              {{ session('NotAdmin') }}
            </div>
          </center>
        @endif

        <div class="jumbotron">
          <h1 class="display-4">Welcome to BooksFace !</h1>
          <p class="lead">BooksFace is an online book store built using laravel and livewire. It will focus on IT books, maybe in the future we will extend to other categories.</p>
          <hr class="my-4">
          <p>It uses an API to add books, in order to streamlining the proccess of entering the info.</p>
          <br>
          @auth
            <a class="btn btn-primary btn-lg" href="{{ route('list') }}" role="button">Books List</a>
            @if(Auth::user()->isAdmin())
                &nbsp &nbsp
                <a class="btn btn-primary btn-lg" href="{{ route('addBooks') }}" role="button">Add Book</a>
            @endif
          @endauth
          @guest
            <p>Register with us to see our books list !</p>
          @endguest
        </div>

        <section class="py-5">
          <div class="container">
            <h1 class="font-weight-light">All Rights Reserved</h1>
            <p class="lead">© All Rights Reserved to the owners of this site - me :) ©</p>
          </div>
        </section>

        <!-- End Welcome Page -->
    </x-slot>
</x-app-layout>