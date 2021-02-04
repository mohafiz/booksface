<x-app-layout>
    <x-slot name="title">
        {{ config('app.name') }} - Authorization
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Authorization Request
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card card-default">
                                <div class="card-header">
                                    Authorization Request
                                </div>
                                <div class="card-body">
                                    <!-- Introduction -->
                                    <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>
            
                                    <!-- Scope List -->
                                    @if (count($scopes) > 0)
                                        <div class="scopes">
                                                <p><strong>This application will be able to:</strong></p>
            
                                                <ul>
                                                    @foreach ($scopes as $scope)
                                                        <li>{{ $scope->description }}</li>
                                                    @endforeach
                                                </ul>
                                        </div>
                                    @endif
            
                                    <div class="buttons">
                                        <!-- Authorize Button -->
                                        <form method="post" action="{{ route('passport.authorizations.approve') }}">
                                            @csrf
            
                                            <input type="hidden" name="state" value="{{ $request->state }}">
                                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                                            <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                            <button type="submit" class="btn btn-success btn-approve">Authorize</button>
                                        </form>
            
                                        <!-- Cancel Button -->
                                        <form method="post" action="{{ route('passport.authorizations.deny') }}">
                                            @csrf
                                            @method('DELETE')
            
                                            <input type="hidden" name="state" value="{{ $request->state }}">
                                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                                            <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                            <button class="btn btn-danger">Cancel</button>
                                        </form>
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