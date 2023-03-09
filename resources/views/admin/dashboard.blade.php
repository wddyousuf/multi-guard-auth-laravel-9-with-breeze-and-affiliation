<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
        <div>
            <a href="{{route('affiliateCreate')}}">Create Affiliate</a>
        </div>
        <div>
            <a href="{{route('recharge')}}">Recharge and Commissions</a>
        </div>
        <div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <x-dropdown-link :href="route('admin.logout')"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
