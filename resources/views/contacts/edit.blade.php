<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Contact') }}
                        </h2>

                        <!-- <p class="mt-1 text-sm text-gray-600">
                            {{ __("Create a new contact.") }}
                        </p> -->
                    </header>

                    <form method="post" action="{{ route('contacts.update', $contact) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card">
                            <img src="{{asset($contact->contact_image)}}" alt="Contact Image" style="width:100%">
                            <figcaption>Contact Image</figcaption>
                        </div>

                        <div>

                            <x-input-label for="contact_image" :value="__('Change Contact Image')"/>
                            <x-text-input id="contact_image" name="contact_image" type="file" :value="old('contact_image')" class="mt-1 block w-full" autofocus autocomplete="contact_image" />
                            <x-input-error class="mt-2" :messages="$errors->get('contact_image')" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Contact Name')"/>
                            <x-text-input id="name" name="contact_name" type="text" :value="old('contact_name', $contact->contact_name)" class="mt-1 block w-full" required autofocus autocomplete="contact_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('contact_name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Contact E-mail')"/>
                            <x-text-input id="email" name="contact_email" type="email" :value="old('contact_email', $contact->contact_email)" class="mt-1 block w-full" required autocomplete="contact_email" />
                            <x-input-error class="mt-2" :messages="$errors->get('contact_email')" />
                        </div>

                        <div>
                            <x-input-label for="contact_phone_number" :value="__('Contact Phone Number')"/>
                            <x-text-input id="contact_phone_number" name="contact_phone_number" type="number" :value="old('contact_phone_number', $contact->contact_phone_number)" class="mt-1 block w-full" required autofocus autocomplete="contact_phone_number" />
                            <x-input-error class="mt-2" :messages="$errors->get('contact_phone_number')" />
                        </div>

                        <div>
                            <x-input-label for="contact_address" :value="__('Contact Address')"/>
                            <x-text-input id="contact_address" name="contact_address" type="text" :value="old('contact_address', $contact->contact_address)" class="mt-1 block w-full" required autofocus autocomplete="contact_address" />
                            <x-input-error class="mt-2" :messages="$errors->get('contact_address')" />
                        </div>

                        <div>
                            <x-input-label for="contact_description" :value="__('Contact Description')"/>
                            <textarea id="contact_description" name="contact_description" class="mt-1 block w-full" required autofocus autocomplete="contact_description" >{{ __(old('contact_description', $contact->contact_description)) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('contact_description')" />
                        </div>

                        <div>
                            <x-input-label for="company_name" :value="__('Company Name')"/>
                            <x-text-input id="company_name" name="company_name" type="text" :value="old('company_name', $contact->company_name)" class="mt-1 block w-full" required autofocus autocomplete="company_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                        </div>

                        <div>
                            <x-input-label for="job_title" :value="__('Job Title')"/>
                            <x-text-input id="job_title" name="job_title" type="text" :value="old('job_title', $contact->job_title)" class="mt-1 block w-full" required autofocus autocomplete="job_title" />
                            <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')"/>
                            <x-select id="status" name="status" type="text" class="mt-1 block w-full" required autofocus autocomplete="status">
                                <option value="">Select Status</option>
                                @foreach($status as $data)
                                <option value="{{$data}}" {{ (old('status', $contact->status) == $data ? 'selected':'') }}>{{$data}}</option>
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
