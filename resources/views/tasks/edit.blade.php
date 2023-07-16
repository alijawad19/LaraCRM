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
                            {{ __('Edit Task') }}
                        </h2>
                    </header>

                    <form method="post" action="{{ route('tasks.update', $task) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input id="title" name="title" type="text" :value="old('title', $task->title)" class="mt-1 block w-full" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="assigned_to" :value="__('Assigned To')"/>
                            <x-text-input type="text" :value="\App\Models\User::findOrFail($task->assigned_to)->name" class="mt-1 block w-full" disabled/>
                            <x-text-input id="assigned_to" name="assigned_to" type="hidden" :value="old('assigned_to', $task->assigned_to)" class="mt-1 block w-full" required autofocus autocomplete="assigned_to" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')"/>
                            <textarea id="description" name="description" class="mt-1 block w-full" required autofocus autocomplete="description" >{{ __(old('description', $task->description)) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="deadline" :value="__('Deadline')"/>
                            <x-text-input id="deadline" name="deadline" type="date" :value="old('deadline', $task->deadline)" class="mt-1 block w-full" required autofocus autocomplete="deadline" />
                            <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')"/>
                            <x-select id="status" name="status" type="text" class="mt-1 block w-full" required autofocus autocomplete="status">
                                <option value="">Select Status</option>
                                @foreach($status as $data)
                                <option value="{{$data}}" {{ (old('status', $task->status) == $data ? 'selected':'') }}>{{$data}}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div>
                            <x-input-label for="remarks" :value="__('Remarks')"/>
                            <textarea id="remarks" name="remarks" class="mt-1 block w-full" required autofocus autocomplete="remarks" >{{ __(old('remarks', $task->remarks)) }}</textarea>
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