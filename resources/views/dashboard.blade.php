<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="row">

                        <!-- Card Example -->
                        @can('manage users')
                        <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <a href="{{ route('users.index') }}">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Total Users </div>
                                    <div class="h5 mb-0 font-weight-bold text-red-800"> {{ $usersCount }} </div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </a>
                            </div>
                            </div>
                        </div>
                        </div>
                        @endcan

                        <!-- Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <a href="{{ route('contacts.index') }}">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Total Contacts </div>
                                    <div class="h5 mb-0 font-weight-bold text-red-800"> {{ $contactsCount }} </div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                    </div>
                                </a>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Card Example -->
                        @can('manage users')
                        <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <a href="{{ route('items.index') }}">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Total Items </div>
                                    <div class="h5 mb-0 font-weight-bold text-red-800"> {{ $itemsCount }} </div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-tag fa-2x text-gray-300"></i>
                                    </div>
                                </a>
                            </div>
                            </div>
                        </div>
                        </div>
                        @endcan

                        <!-- Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <a href="{{ route('deals.index') }}">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Total Deals </div>
                                    <div class="h5 mb-0 font-weight-bold text-red-800"> {{ $dealsCount }} </div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-handshake fa-2x text-gray-300"></i>
                                    </div>
                                </a>
                            </div>
                            </div>
                        </div>
                        </div>


                        <!-- Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <a href="{{ route('documents.index') }}">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Total Documents </div>
                                    <div class="h5 mb-0 font-weight-bold text-red-800"> {{ $documentsCount }} </div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                    </div>
                                </a>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <a href="{{ route('tasks.index') }}">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Total Tasks </div>
                                    <div class="h5 mb-0 font-weight-bold text-red-800"> {{ $tasksCount }} </div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </a>
                            </div>
                            </div>
                        </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
