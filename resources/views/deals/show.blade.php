<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deals') }}
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
                            <a href="{{route('deals.edit', $deal->id)}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"}}>
                                Edit
                            </a>
                            @can('delete')
                            <form action="{{ route('deals.destroy', $deal) }}" method="POST"
                                    onsubmit="return confirm('Are your sure?');"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    
                                <input type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" value="Delete">
                            </form>
                            @endcan
                        </div>
                        
                        <h1 style="display: block; font-size:xx-large;" class="font-semibold">{{ $deal->name }}</h1>
                        <p><a style="text-decoration: underline;" href="{{route('contacts.show', $deal->contact->id)}}">{{ \App\Models\Contact::findOrFail($deal->contact->id)->contact_name }}, {{ \App\Models\Contact::findOrFail($deal->contact->id)->company_name }}</a></p>
                        <p>Owned By: 
                            @if($deal->owner_id == auth()->user()->id)
                                {{__('You')}}
                            @else
                                {{ \App\Models\User::findOrFail($deal->owner_id)->name }}
                            @endif
                        </p>

                        @if($deal->status == 'Won')
                            <em>Closed on: {{ Carbon\Carbon::parse($deal->closed_on)->format('d F Y') }}</em>
                        @elseif($deal->status == 'Lost')
                            <em>Closed on: {{ Carbon\Carbon::parse($deal->closed_on)->format('d F Y') }}</em>
                        @else
                            <em style="color: red;" class="title">Should close on: {{ Carbon\Carbon::parse($deal->closed_on)->format('d F Y') }}</em>
                        @endif

                        <h3>Amount: ₹{{ number_format($deal->deal_amount) }}</h3>
                        <h3>Status: {{ $deal->status }}</h3>
                        <h3>Created On: {{ $deal->created_on }}</h3>
                        <h3>Note:</h3>
                        <p class="title text-sm">{{ $deal->note }}</p>
                        <div class="col-md-6">
                            <div class="card-title">Deal Items</div>

                            <table class="min-w-full divide-y divide-gray-200 border">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Cost</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Price</span>
                                    </th>
                                </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                <?php $cost = 0; $price = 0; ?>
                                @foreach($deal->deal_items as $dealItem)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ \App\Models\Item::findOrFail($dealItem->item_id)->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ \App\Models\Item::findOrFail($dealItem->item_id)->description }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            ₹{{ number_format(\App\Models\Item::findOrFail($dealItem->item_id)->cost) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            ₹{{ number_format(\App\Models\Item::findOrFail($dealItem->item_id)->price) }}
                                        </td>
                                    </tr>
                                    <?php $cost = $cost+(\App\Models\Item::findOrFail($dealItem->item_id)->cost);
                                    $price = $price+(\App\Models\Item::findOrFail($dealItem->item_id)->price); ?>
                                @endforeach
                                </tbody>
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        Total Cost: {{ number_format($cost) }} | Total Price: {{ number_format($price) }}
                                    </td>
                                </tr>
                            </table>



                        </div>
                        <!-- <p><button style="cursor:default; opacity:unset; background-color:red;" class="card-btn">Should close on: {{ Carbon\Carbon::parse($deal->closed_on)->format('d F Y',) }}</button></p> -->
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>