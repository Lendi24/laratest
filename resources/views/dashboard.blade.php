@php
    $role  = DB::table('roles')->where("id", Auth::user()->role_id )->first();
    $users = DB::table('users')->get(); 
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div @class([
                'overflow-hidden',
                'shadow-sm',
                'sm:rounded-lg',

                'bg-red-600'        => $role->color == 'red',
                'dark:bg-red-600'   => $role->color == 'red',

                'bg-green-600'      => $role->color == 'green',
                'dark:bg-green-600' => $role->color == 'green',

                'bg-blue-600'       => $role->color == 'blue',
                'dark:bg-blue-600'  => $role->color == 'blue',
            ])>            
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as:") }}
                    {{ $role->name }}
                </div>
            </div>

            @if ($role->id >= 3)
            <div class="text-white">
                <b class="bg-red-600">red</b>
                <b class="bg-green-600">green</b>
                <b class="bg-blue-600">blue</b>
            </div>
            @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @for ($i = 0; $i < count($users); $i++)
                    <div class="bg-gray-600 mb-1 rounded-lg flex justify-between p-5">
                        <div>
                            <b>ID: {{ $i +1 }}</b><br>
                            <b>User Name:  {{ $users[$i]->name }}</b><br>
                            <b>First Name: {{ $users[$i]->first_name }}</b><br>
                            <b>Last Name:  {{ $users[$i]->last_name }}</b><br>
                            <b>Role:       {{ DB::table('roles')->where("id", $users[$i]->role_id )->first()->name }}</b><br>
                        </div>
                        <div class="flex justify-center align-middle mt-auto mb-auto">
                            @if     ($role->id > $users[$i]->role_id)
                            <b>This user has higher privileges then you!</b>
                            @elseif (Auth::user()->id == $i)
                            <b class="flex flex-col justify-center align-middle m-1">You cannot modify your own privileges</b>
                            @else
                            @if     ($role->id != $users[$i]->role_id)
                            <a class="bg-green-700 rounded-lg p-2 m-1"
                                    href ="/profile/e/{{$i+1}}/promote">
                                Promote
                            </a>
                            @endif
                            <a  class="bg-red-700   rounded-lg p-2 m-1"
                                href ="/profile/e/{{$i+1}}/demote">
                                Demote
                            </a>
                            @endif
                            <a  class="bg-blue-700 rounded-lg p-2 m-1"
                                href ="/profile/e/{{$i+1}}/promote">
                                Edit
                            </a>

                        </div>
                    </div>
                @endfor
                </div>
            </div>

            @if(false)
            <form method="post" action="{{ route('profile.promote') }}" class="p-6">
                @csrf
                @method('post')

                <x-text-input
                    id="target_id"
                    name="target_id"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="1"
                />

                <input type="submit" value="Promote">
            </form>

            <form method="post" action="{{ route('profile.demote') }}" class="p-6">
                @csrf
                @method('post')
                <input type="submit" value="Demote">
            </form>
            @endif

            @endif
        </div>
    </div>
</x-app-layout>
