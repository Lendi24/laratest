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
                            <b>ID: {{ $i }}</b><br>
                            <b>User Name:  {{ $users[$i]->name }}</b><br>
                            <b>First Name: {{ $users[$i]->first_name }}</b><br>
                            <b>Last Name:  {{ $users[$i]->last_name }}</b><br>
                            <b>Role:       {{ DB::table('roles')->where("id", $users[$i]->role_id )->first()->name }}</b><br>
                        </div>
                        <div class="flex justify-center align-middle mt-auto mb-auto">
                            @if     ($role->id > $users[$i]->role_id)
                            <b>This user has higher privileges then you!</b>
                            @elseif (Auth::user()->id == $i)
                            <b>You cannot modify your own privileges</b>
                            @else
                            @if     ($role->id != $users[$i]->role_id)
                            <button class="bg-green-700 rounded-lg p-2 m-1">
                                Promote
                            </button>
                            @endif
                            <button class="bg-red-700 rounded-lg p-2 m-1">
                                Demote
                            </button>
                            @endif
                        </div>
                    </div>
                @endfor
                </div>
            </div>
            @endif





        </div>
    </div>
</x-app-layout>
