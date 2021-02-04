<x-app-layout>
    <x-slot name="title">
        {{ config('app.name') }} - API Dashboard
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            API Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                  <section>

                    <div class="card" style="margin: 50px;">
                        <div class="card-header">
                            <b>Your Clients</b>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                              <p><b>Note: Clients with <span style="color: red;">RED</span> ID number are revoked.</b></p>
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th scope="col">Client ID</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Client Secret</th>
                                        <th scope="col">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($clients as $client)
                                        <tr>
                                            <th scope="row">
                                              <span style="{{ $client->revoked ? 'color:red;' : '' }}">{{ $client->id }}</span>
                                            </th>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->secret }}</td>

                                                <td>
                                                  @if (!$client->revoked)
                                                    <!-- Edit or Delete -->

                                                    <p onclick="document.getElementById('EditForm').style.display='inline'"
                                                    style="cursor: pointer; display: inline;">Edit</p> &nbsp;

                                                    <form class="form-group" onsubmit="event.preventDefault()" style="display: none;" id="EditForm">
                                                      @csrf
                                                      @method('PUT')
                                                      <input class="form-control" type="text" name="name" id="app_new_name" placeholder="New App Name">
                                                      <input class="form-control" type="url" name="redirect" id="app_new_redirect" placeholder="New App Redirect URL">
                                                      <input type="submit" onclick="edit_client('{{ $client->id }}')" value="save" class="form-control">
                                                    </form>

                                                    <a onclick="event.preventDefault();
                                                                      delete_client('{{ $client->id }}')" 
                                                      style="color: red;">Delete</a>
                                                    @endif
                                                </td>

                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                  </section>

                  <section>

                    <div class="card" style="margin: 50px;">
                        <div class="card-header">
                            <b>Authorized Clients</b>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th scope="col">Client ID</th>
                                        <th scope="col">Access Token</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($tokens as $token)
                                        <tr>
                                            <th scope="row">{{ $token->client_id }}</th>
                                            <td>{{ $token->id }}</td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                  </section>

                  <div class="card" style="margin: 50px;">
                    <div class="card-header">
                        <b>New Client</b>
                    </div>
                    <div class="card-body">
                      <div class="card-title"><b>Create a new client</b></div>
                      <hr>
                      <div class="card-text">
                        <form class="form-group" onsubmit="event.preventDefault();">
                          @csrf
                          <div class="form-group">
                            <label for="app_name">Name <span style="color: red">*</span></label>
                            <input id="app_name" type="text" class="form-control" name="name" required>
                          </div>
                          <div class="form-group">
                            <label for="redirect_url">Redirect URL <span style="color: red">*</span></label>
                            <input id="app_redirect" type="url" class="form-control" name="redirect" required>
                          </div>
                          <button type="submit" onclick="create_client()" class="btn btn-primary">Create Client</button>
                        </form>
                      </div>
                    </div>

            </div>
        </div>
    </div>
</x-app-layout>