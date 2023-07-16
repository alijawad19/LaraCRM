<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Upload Document') }}
                        </h2>
                    </header>

                    <form method="post" action="{{ route('documents.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="details" :value="__('Details')"/>
                            <x-text-input id="details" name="details" type="text" :value="old('details')" class="mt-1 block w-full" required autofocus autocomplete="details" />
                            <x-input-error class="mt-2" :messages="$errors->get('details')" />
                        </div>

                        <div>
                            <x-input-label for="file_path" :value="__('File (less than 4 MB)')"/>
                            <x-text-input id="file_path" name="file_path" type="file" class="mt-1 block w-full" required autofocus autocomplete="file_path" />
                            <x-input-error class="mt-2" :messages="$errors->get('file_path')" />
                        </div>

                        <x-text-input id="user_id" name="user_id" type="hidden" :value="old('user_id', Auth::user()->id)" class="mt-1 block w-full" required autofocus autocomplete="user_id" />


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>