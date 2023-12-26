<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" x-data="{ personalForm: true, addressForm: false, meterForm: false, emailForm: false }">
        @csrf
        <!-- Personal form -->
        <div x-show="personalForm" style="display: none">
            <!-- First Name -->
            <div>
                <x-input-label for="fname" :value="__('First Name')" />
                <x-text-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')"
                    autofocus autocomplete="given-name" placeholder="Juan" />
                <x-input-error :messages="$errors->get('fname')" class="mt-2" />
            </div>
            <!-- Middle Name -->
            <div class="mt-4">
                <x-input-label for="mname" :value="__('Middle Name')" />
                <x-text-input id="mname" class="block mt-1 w-full" type="text" name="mname" :value="old('mname')"
                    autofocus autocomplete="additional-name" placeholder="Dela" />
                <x-input-error :messages="$errors->get('mname')" class="mt-2" />
            </div>
            <!-- Last Name -->
            <div class="mt-4">
                <x-input-label for="lname" :value="__('Last Name')" />
                <x-text-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')"
                    autofocus autocomplete="family-name" placeholder="Cruz" />
                <x-input-error :messages="$errors->get('lname')" class="mt-2" />
            </div>
            <!-- Phone Number -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                    autofocus autocomplete="tel" placeholder="09123456789" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>
{{--  --}}
        <!-- Next button -->
        <span class="flex justify-between ">
            <div x-show="personalForm" style="display: none" x-on:click="personalForm=false; meterForm=true"
                class=" mt-4 inline-flex items-center px-3 py-3 w-full bg-green-dark border border-transparent rounded-md font-semibold justify-center text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Next') }}
            </div>
        </span>

        <!-- Meter form -->
        <div x-show="meterForm" style="display: none">

            <!-- Meter Number -->
            <div class="mt-4">
                <x-input-label for="MID" :value="__('Meter Serial Number')" />
                <x-text-input id="MID" class="block mt-1 w-full" type="text" name="MID" :value="old('MID')"
                    autofocus placeholder="12345678" />
                @error('MID')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Meter PIN -->
            <div class="mt-4">
                <x-input-label for="PIN" :value="__('Meter PIN')" />
                <x-text-input id="PIN" class="block mt-1 w-full" type="text" name="PIN" :value="old('PIN')"
                    autofocus placeholder="12345678" />
                @error('PIN')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <span class="flex justify-between gap-3">
            <!-- Back button -->
            <div x-show="meterForm" style="display: none" x-on:click="personalForm=true; meterForm=false"
                class="mt-4 inline-flex items-center px-3 py-3 w-3/6 bg-green-dark border border-transparent rounded-md font-semibold justify-center text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back') }}
            </div>
            <!-- Next button -->
            <div x-show="meterForm" style="display: none" x-on:click="meterForm=false; addressForm=true"
                class="mt-4 inline-flex items-center px-3 py-3 w-3/6 bg-green-dark border border-transparent rounded-md font-semibold justify-center text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Next') }}
            </div>
        </span>

        <!-- Address form -->
        <div x-show="addressForm" style="display: none">
            <!-- Province Dropdown -->
            <div class="mt-4" x-data="{ province: 'oldValue' }">
                <x-input-label for="phone" :value="__('Province')" />
                <select id="provinceSelect" name="province" x-model="province"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full">
                    <option value="" disabled selected>Select Province</option>
                </select>
                @error('province')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Municipality Dropdown -->
            <div class="mt-4" x-data="{ municipality: 'oldValue' }">
                <x-input-label for="municipality" :value="__('Municipality')" />

                <select id="municipalitySelect" name="municipality" x-model="municipality"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full">
                    <option value="" disabled selected>Select Municipality</option>
                </select>

                @error('municipality')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Barangay Dropdown -->
            <div class="mt-4" x-data="{ barangay: 'oldValue' }">
                <x-input-label for="phone" :value="__('Barangay')" />

                <select id="barangaySelect" name="barangay" x-model="barangay"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full">
                    <option value="" disabled selected class="text-gray-400">Select Barangay</option>
                </select>

                @error('barangay')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <span class="flex justify-between gap-3">
            <!-- Back button -->
            <div x-show="addressForm" style="display: none" x-on:click="meterForm=true; addressForm=false"
                class="mt-4 inline-flex items-center px-3 py-3 w-full bg-green-dark border border-transparent rounded-md font-semibold justify-center text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back') }}
            </div>
            <!-- Next button -->
            <div x-show="addressForm" style="display: none" x-on:click="addressForm=false; emailForm=true"
                class="mt-4 inline-flex items-center px-3 py-3 w-full bg-green-dark border border-transparent rounded-md font-semibold justify-center text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Next') }}
            </div>
        </span>

        <!-- Email form -->
        <div id="emailForm" x-show="emailForm" style="display: none">
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Username -->
            <div class="mt-4">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                    :value="old('username')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

        </div>
        <span class="flex justify-between gap-3">
            <!-- Back button -->
            <div x-show="emailForm" style="display: none" x-on:click="addressForm=true; emailForm=false"
                class=" mt-4 inline-flex items-center px-3 py-3 w-full bg-green-dark border border-transparent rounded-md font-semibold justify-center text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back') }}
            </div>
            <!-- Button Register -->
            <button x-show="emailForm" style="display: none" type="submit"
                class=" mt-4 inline-flex items-center px-3 py-3 w-full bg-green-dark border border-transparent rounded-md font-semibold justify-center text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Register') }}</button>
        </span>
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
    </form>
    @vite('resources/js/registration.js')
</x-guest-layout>
