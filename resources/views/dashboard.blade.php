<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
      @if(auth()->check())
      <span>Welcome, {{ auth()->user()->name }}!</span>
      @endif
      <b style="float:right">Total users
          <span class="badge text-bg-primary">{{ count($users) }}</span>
      </b>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <table class="table mx-auto">
                  <thead>
                      <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Created At</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php
                      $i = 1;
                      @endphp
                      @foreach ($users as $user)
                      <tr>
                          <th scope="row">{{ $i++ }}</th>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->created_at }}</td>
                          <td>{{$user->created_at->diffforHumans()}}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</x-app-layout>
