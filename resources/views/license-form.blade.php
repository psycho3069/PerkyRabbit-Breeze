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
                    

                    <div class="card">
                        <div class="row">
                            <h4 id="msg"></h4>
                            
                        </div>
                        {{-- {{ date('d-m-Y') }} --}}
                        {{-- {{ Carbon\Carbon::now() }} --}}
                        <div class="card-header">Activate Your License</div>
                        <div class="card-body">

                            

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form action="">
                                @csrf

                                <!-- license key -->
                                <div>
                                    <x-label for="license_key" :value="__('License Key')" />

                                    <x-input id="license_key" class="block mt-1 w-full" type="text" name="license_key" :value="old('license_key')" autofocus />
                                </div>
                                

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-white-600 hover:text-white-900" href="{{ route('license') }}">
                                        {{ __('Generate License?') }}
                                    </a>

                                    <button id="submit" class="btn btn-primary ml-3">Submit Key</button>
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
    $('#submit').click(function(event) {
        var license_key = $('#license_key').val();
            // alert(license_key);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/activate-license',
                data: {license_key: license_key},
                success: function (data) {
                    // alert(data);
                    $("#msg").text(data);
                    console.log(data);
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