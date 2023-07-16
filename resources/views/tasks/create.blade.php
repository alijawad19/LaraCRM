<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Create Task') }}
                        </h2>
                    </header>

                    <form method="post" action="{{ route('tasks.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input id="title" name="title" type="text" :value="old('title')" class="mt-1 block w-full" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="assigned_to" :value="__('Assigned To')"/><x-select id="assigned_to" name="assigned_to" type="number" class="mt-1 block w-full" required autofocus autocomplete="assigned_to">
                                <option value="">Select Owner</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{ (old('assigned_to')) }}>{{$user->name}}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')"/>
                            <textarea id="description" name="description" class="mt-1 block w-full" required autofocus autocomplete="description" >{{ __(old('description')) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="deadline" :value="__('Deadline')"/>
                            <x-text-input id="deadline" name="deadline" type="date" :value="old('deadline')" class="mt-1 block w-full" required autofocus autocomplete="deadline" />
                            <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')"/>
                            <x-select id="status" name="status" type="text" class="mt-1 block w-full" required autofocus autocomplete="status">
                                <option value="">Select Status</option>
                                @foreach($status as $data)
                                <option value="{{$data}}" {{ (old('status')) }}>{{$data}}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div>
                            <x-input-label for="remarks" :value="__('Remarks (optional)')"/>
                            <textarea id="remarks" name="remarks" class="mt-1 block w-full" autofocus autocomplete="remarks" >{{ __(old('remarks')) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('remarks')" />
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