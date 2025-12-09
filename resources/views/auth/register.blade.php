<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name and Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nama Pemilik')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('UMKM Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- UMKM Name -->
        <div class="mt-4">
            <x-input-label for="nama_umkm" :value="__('Nama UMKM atau Instansi')" />
            <x-text-input id="nama_umkm" class="block mt-1 w-full" type="text" name="nama_umkm"
                :value="old('nama_umkm')" autocomplete="nama_umkm" />
            <x-input-error :messages="$errors->get('nama_umkm')" class="mt-2" />
        </div>

        <!-- Phone Number and Establish Year -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="phone_number" :value="__('Nomor kontak(Handphone)')" />
                <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                    :value="old('phone_number')" autocomplete="phone_number" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="establish_year" :value="__('Tahun Berdiri')" />
                <x-text-input id="establish_year" class="block mt-1 w-full" type="number" name="establish_year"
                    :value="old('establish_year')" min="1900" max="{{ date('Y') }}" autocomplete="establish_year" />
                <x-input-error :messages="$errors->get('establish_year')" class="mt-2" />
            </div>
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Alamat')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- City and Province -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="city" :value="__('Kota')" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')"
                    autocomplete="city" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="province" :value="__('Provinsi')" />
                <x-text-input id="province" class="block mt-1 w-full" type="text" name="province"
                    :value="old('province')" autocomplete="province" />
                <x-input-error :messages="$errors->get('province')" class="mt-2" />
            </div>
        </div>

        <!-- Pembina -->
        <div class="mt-4">
            <x-input-label for="pembina" :value="__('Pembina')" />
            <select id="pembina" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="pembina" autocomplete="pembina">
                <option value="">-- Pilih Pembina --</option>
                @foreach($pembinaList as $pembina)
                    <option value="{{ $pembina->name }}" {{ old('pembina') == $pembina->name ? 'selected' : '' }}>
                        {{ $pembina->name }} ({{ $pembina->email }})
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('pembina')" class="mt-2" />
        </div>

        <!-- Password and Confirm Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>