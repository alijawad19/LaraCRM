<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents') }}
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
                            @can('delete')
                            <form action="{{ route('documents.destroy', $document) }}" method="POST"
                                    onsubmit="return confirm('Are your sure?');"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    
                                <input type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" value="Delete">
                            </form>
                            @endcan
                        </div>
                        
                        <em style="color: red;">Document Name: {{ str_replace("/storage/documents/", "", $document->file_path) }}</em> &nbsp;
                        <h1>Details:</h1>
                        <p class="title">{{ $document->details }}</p>
                        <p>Uploaded By: <a style="text-decoration: underline;" href="{{route('users.show', $document->user_id)}}">{{ \App\Models\User::findOrFail($document->user_id)->name }}</a></p>
                        
                        <h3>Uploaded On: {{ Carbon\Carbon::parse($document->created_at)->format('d F Y') }}</h3>
                        
                        <a href="{{ route('documents.download', $document->id) }}">
                        <button class="card-btn">
                            <i class="fa fa-download"></i>
                            Download
                        </button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>