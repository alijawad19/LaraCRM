<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Create Deal') }}
                        </h2>

                        <!-- <p class="mt-1 text-sm text-gray-600">
                            {{ __("Create a new contact.") }}
                        </p> -->
                    </header>

                    <form method="post" action="{{ route('deals.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Deal Name')"/>
                            <x-text-input id="name" name="name" type="text" :value="old('name')" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="contact_id" :value="__('Contact')"/>
                            <x-select id="contact_id" name="contact_id" type="number" class="mt-1 block w-full" required autofocus autocomplete="contact_id">
                                <option value="">Select Contact</option>
                                @foreach($contacts as $contact)
                                    <option value="{{$contact->id}}" {{ (old('contact_id')) }}>{{$contact->contact_name}}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('contact_email')" />
                        </div>

                        <div>
                            <x-input-label for="owner_id" :value="__('Deal Owner')"/>
                            <x-select id="owner_id" name="owner_id" type="number" class="mt-1 block w-full" required autofocus autocomplete="owner_id">
                                <option value="">Select Owner</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{ old('owner_id') }}>{{$user->name}}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div>
                            <x-input-label for="deal_amount" :value="__('Deal Amount (₹)')"/>
                            <x-text-input id="deal_amount" name="deal_amount" type="number" :value="old('deal_amount')" class="mt-1 block w-full" required autofocus autocomplete="deal_amount" />
                            <x-input-error class="mt-2" :messages="$errors->get('deal_amount')" />
                        </div>

                        <div class="checkbox-container" class="mt-1 block w-full">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Select</span>
                                        </th>
                                        <th class="px-2 py-1 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</span>
                                        </th>
                                        <th class="px-2 py-1 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</span>
                                        </th>
                                        <th class="px-2 py-1 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Cost</span>
                                        </th>
                                        <th class="px-2 py-1 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Price</span>
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($items as $item)
                                    <tr class="bg-white">
                                        <td class="px-2 py-1 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            <input type="checkbox" name="deal_items[]" value="{{$item->id}}" />
                                        </td>
                                        <td class="px-2 py-1 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-2 py-1 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ $item->description }}
                                        </td>
                                        <td class="px-2 py-1 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            ₹{{ number_format($item->cost) }}
                                        </td>
                                        <td class="px-2 py-1 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            ₹{{ number_format($item->price) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('deal_items')" />

                        <div>
                            <x-input-label for="note" :value="__('Note')"/>
                            <textarea id="note" name="note" class="mt-1 block w-full" required autofocus autocomplete="note" >{{ __(old('note')) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('note')" />
                        </div>

                        <div>
                            <x-input-label for="closed_on" :value="__('Close On')"/>
                            <x-text-input id="closed_on" name="closed_on" type="date" :value="old('closed_on')" class="mt-1 block w-full" required autofocus autocomplete="closed_on" />
                            <x-input-error class="mt-2" :messages="$errors->get('closed_on')" />
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