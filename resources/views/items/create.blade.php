<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Create Item') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Create a new item.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('items.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Item Name')"/>
                            <x-text-input id="name" name="name" type="text" :value="old('name')" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Item Description')"/>
                            <textarea id="description" name="description" class="mt-1 block w-full" required autofocus autocomplete="description" >{{ __(old('description')) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="cost" :value="__('Item Cost (₹)')"/>
                            <x-text-input id="cost" name="cost" type="number" :value="old('cost')" class="mt-1 block w-full" required autofocus autocomplete="cost" />
                            <x-input-error class="mt-2" :messages="$errors->get('cost')" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Item Price (₹)')"/>
                            <x-text-input id="price" name="price" type="number" :value="old('price')" class="mt-1 block w-full" required autofocus autocomplete="price" />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

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
