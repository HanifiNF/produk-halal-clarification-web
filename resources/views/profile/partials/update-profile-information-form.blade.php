<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-700">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-800">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label-app for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label-app for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label-app for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                :value="old('phone_number', $user->phone_number)" autocomplete="phone_number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <div>
            <x-input-label-app for="nama_umkm" :value="__('Nama UMKM')" />
            <x-text-input id="nama_umkm" name="nama_umkm" type="text" class="mt-1 block w-full" :value="old('nama_umkm', $user->nama_umkm)" autocomplete="nama_umkm" />
            <x-input-error class="mt-2" :messages="$errors->get('nama_umkm')" />
        </div>

        <div>
            <x-input-label-app for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label-app for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)"
                autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label-app for="province" :value="__('Province')" />
            <x-text-input id="province" name="province" type="text" class="mt-1 block w-full" :value="old('province', $user->province)" autocomplete="province" />
            <x-input-error class="mt-2" :messages="$errors->get('province')" />
        </div>

        <div>
            <x-input-label-app for="establish_year" :value="__('Establish Year')" />
            <x-text-input id="establish_year" name="establish_year" type="number" class="mt-1 block w-full"
                :value="old('establish_year', $user->establish_year)" min="1900" max="{{ date('Y') }}"
                autocomplete="establish_year" />
            <x-input-error class="mt-2" :messages="$errors->get('establish_year')" />
        </div>

        <div class="flex items-center gap-4">
            <x-auth-button>{{ __('Save') }}</x-auth-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>