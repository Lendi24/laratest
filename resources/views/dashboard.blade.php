@php
    $role_id        = Auth::user()->role_id;
    $role_colour    = 'green';
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

                'bg-red-600'        => $role_colour == 'red',
                'dark:bg-red-600'   => $role_colour == 'red',

                'bg-green-600'      => $role_colour == 'green',
                'dark:bg-green-600' => $role_colour == 'green',
            ])>            
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as:") }}
                    {{ (DB::table('roles')->where("id", $role_id )->first('name')->name) }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    also here
                </div>
            </div>
            <div class="bg-red-600">red</div>
            <div class="bg-green-600">green</div>
            <div class="bg-blue-600">blue</div>


        </div>
    </div>
</x-app-layout>
