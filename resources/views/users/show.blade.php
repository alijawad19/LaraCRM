<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-gray-200">
                    
                    <div class="min-w-full align-middle">
                        <div class="p-6 text-gray-900">
                            @if($message = Session::get('success'))
                            <div class="alert success">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                
                                <div class="flex space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        class="flex-none fill-current text-green-500 h-4 w-4">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z"/>
                                    </svg>
                                    <div class="flex-1 leading-tight text-sm font-medium"><strong>Success!</strong> {{$message}}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <div class="card-div text-right">
                            
                        </div>
                        @php
                            $roleId = DB::table('model_has_roles')->where('model_id', $user->id)->value('role_id');
                            $roleId == '1' ? $role = 'Admin' : $role = 'User'
                        @endphp
                        <h1 style="display: block; font-size:xx-large;" class="font-semibold">{{ $user->name }}</h1>
                        
                        <h3>Email: <a class="text-base" href="mailto:{{$user->email}}">{{ $user->email }}</a></h3>
                        <h3>Role: {{ $role }}</h3>
                        <div class="col-md-6">

                            <div class="card-title">Contacts</div>
                            @if($user->contacts->isEmpty())
                            <div class="alert alert-dark">
                                {{ _('This user has no contacts') }}
                            </div>
                            @else
                            <table class="min-w-full divide-y divide-gray-200 border">
                                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                    @foreach($user->contacts as $contact)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                                <img src="{{ asset($contact->contact_image) }}" alt="Contact Image" height="100" width="100">
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                                {{ $contact->contact_name }}, <div class="text-xs">{{ $contact->company_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                                <a class="text-sm" href="mailto:{{$contact->contact_email}}">{{ $contact->contact_email }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                                <a href="{{route('contacts.show', $contact)}}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                                    Show
                                                </a>
                                                <a href="{{route('contacts.edit', $contact->id)}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"}}>
                                                    Edit
                                                </a>
                                                @can('delete')
                                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                                                        onsubmit="return confirm('Are your sure?');"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')

                                                    <input type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" value="Delete">
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            <div class="card-title">Tasks</div>
                            @if($user->tasks->isEmpty())
                            <div class="alert alert-dark">
                                    {{ _('This user has no tasks assigned') }}
                            </div>
                            @else
                            <table class="min-w-full divide-y divide-gray-200 border">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Assigned To</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Deadline</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></span>
                                    </th>
                                </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($user->tasks as $task)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ $task->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ \App\Models\User::findOrFail($task->assigned_to)->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ Carbon\Carbon::parse($task->deadline)->format('d F Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ $task->status }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            <a href="{{route('tasks.show', $task)}}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                                Show
                                            </a>
                                            <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"}}>
                                                Edit
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                    onsubmit="return confirm('Are your sure?');"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')

                                                <input type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif

                            <div class="card-title">Documents</div>
                            @if($user->documents->isEmpty())
                            <div class="alert alert-dark">
                                    {{ _('This user has not uploaded any document') }}
                            </div>
                            @else
                            <table class="min-w-full divide-y divide-gray-200 border">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Details</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Uplaoaded By</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></span>
                                    </th>
                                </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($user->documents as $document)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ $document->details }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ \App\Models\User::findOrFail($document->user_id)->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            <a href="{{route('documents.show', $document)}}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                                Show
                                            </a>
                                            <form action="{{ route('documents.destroy', $document) }}" method="POST"
                                                    onsubmit="return confirm('Are your sure?');"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')

                                                <input type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif

                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>