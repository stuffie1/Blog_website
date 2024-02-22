<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-form-section submit="updateProfileInformation" class="my-5">
                <x-slot name="title">
                    {{ __('Profile Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Update your account\'s profile information and email address.') }}
                </x-slot>

                <x-slot name="form">
                    <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">

                        <x-label for="photo" value="{{ __('Photo') }}" />

                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                class="rounded-full h-20 w-20 object-cover">
                        </div>
                        <!-- Followers & Followings -->
                        <div class="col-span-6 sm:col-span-4 mt-4 flex ">
                            <div class="mx-4">
                              <p class="text-md text-gray-700 font-medium">Followers</p>
                              <p class="text-sm text-gray-600">{{ $user->followers->count() }}</p>
                            </div>
                            <div>
                              <p class="text-md text-gray-700 font-medium">Following</p>
                              <p class="text-sm text-gray-600">{{ $user->followings->count() }}</p>
                            </div>
                        </div>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4 mt-10">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" type="text"
                                class="mt-1 block w-full text-slate-500 mb-3 bg-gray-100" value="{{ $user->name }}"
                                required autocomplete="name" readonly />
                            <x-input-error for="name" class="mt-2" />
                        </div>
                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" type="email"
                                class="mt-1 block w-full text-slate-500 mb-3 bg-gray-100" value="{{ $user->email }}"
                                required autocomplete="username" readonly />

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                                    !$this->user->hasVerifiedEmail())
                                <p class="text-sm mt-2">
                                    {{ __(' email address is unverified.') }}
                                </p>
                            @endif
                        </div>

                        <div class="w-full flex justify-end ms-48 mt-16 mb-4">
                            @if (auth()->user()->role == 'admin')

                                <form action="{{ route('dashboard.destroy', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="
      'inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'
      ">
                                        Delete Account
                                    </button>
                                </form>
                            @else
                                @if ($user->followers->contains(auth()->user()->id))
                                    <button type="button"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <a class="block w-full  text-start text-sm leading-5  transition duration-150 ease-in-out"
                                            href="{{ route('user.unfollow', ['following_id' => $user->id]) }}"> unfollow
                                        </a>
                                    </button>
                                @else
                                    <button type="button"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <a class="block w-full  text-start text-sm leading-5  transition duration-150 ease-in-out"
                                            href="{{ route('user.follow', ['following_id' => $user->id]) }}"> follow </a>
                                    </button>
                                @endif


                            @endif
                        </div>
                </x-slot>

            </x-form-section>
        </div>


    </div>
</x-app-layout>
