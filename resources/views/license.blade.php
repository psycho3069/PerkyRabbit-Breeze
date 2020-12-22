<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <table class="table table-bordered" id="table" border="1">
                      <thead>
                        <tr>
                          <th width="100">First Name</th>
                          <th width="100">Last Name</th>
                          <th width="100">Organization</th>
                          <th width="100">Street</th>
                          <th width="140">City</th>
                          <th width="100">Phone</th>
                          <th width="100">Email</th>
                          <th width="100">License Key</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                       </tbody>
                    </table>

                    <div class="card">
                        <div class="card-header">License Key Generator</div>
                        <div class="card-body">

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form action="">
                                @csrf

                                <!-- client id -->
                                <div>
                                    <x-label for="client_id" :value="__('Client ID')" />

                                    <x-input id="client_id" class="block mt-1 w-full" type="text" name="client_id" :value="old('client_id')" required autofocus />
                                </div>

                                <!-- license key -->
                                <div>
                                    <x-label for="license_key" :value="__('License Key')" />

                                    <x-input id="license_key" class="block mt-1 w-full" type="text" name="license_key" :value="old('license_key')" autofocus />
                                </div>
                                
                                <!-- license period -->
                                <div>
                                    <x-label for="license_period" :value="__('License Period')" />

                                    <select id="license_period" class="block mt-1 w-full ring-black rounded-md shadow-lg" type="text" name="license_period" :value="old('license_period')" autofocus >
                                        <option class="rounded-md shadow-lg ring-1" value="3">3 Months</option>
                                        <option class="rounded-md shadow-lg ring-1" value="6">6 Months</option>
                                        <option class="rounded-md shadow-lg ring-1" value="12">12 Months</option>
                                    </select>
                                </div>

                                

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-white-600 hover:text-white-900" href="{{ route('license-form') }}">
                                        {{ __('Activate License?') }}
                                    </a>

                                    <x-button class="ml-4">
                                        {{ __('Get User Data') }}
                                    </x-button>

                                    <button id="create" class="btn btn-primary ml-3">Create Key</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script type="text/javascript">
$(document).ready(function() {

    // process the form
    $('form').submit(function(event) {
        var client_id = $('#client_id').val();

            // alert(client_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/get-user',
                data: {client_id: client_id},
                success: function (data) {
                    // alert(data);
                    console.log(data);
                    var table = $("#table tbody");
                    var x=0,txt='';
                    for (x in data) {
                        table.append("<tr><td>"+data[x].first_name+"</td><td>"+data[x].last_name+"</td><td>"+data[x].org_name+"</td><td>"+data[x].street+"</td><td>"+data[x].city+"</td><td>"+data[x].phone+"</td><td>"+data[x].email+"</td><td>"+data[x].license_key+"</td></tr>");
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();

    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {

    // process the form
    $('#create').click(function(event) {
        var client_id = $('#client_id').val();
        var license_period = $('#license_period').val();
        var data = {client_id:client_id,license_period:license_period};
            // alert(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/get-license',
                data: {data: data},
                success: function (data) {
                    // alert(data);
                    console.log(data);
                    $("#license_key").val(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();

    });

});
</script>
