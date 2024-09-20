@extends('layouts.master')

@section('content')
    <div class="container mx-auto py-6">
        <form id="create_user_form" enctype="multipart/form-data" class="w-full max-w-lg bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter name">
                <span class="text-red-600 text-sm" id="nameError"></span>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter email">
                <span class="text-red-600 text-sm" id="emailError"></span>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone:</label>
                <input type="text" id="phone" name="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter phone number">
                <span class="text-red-600 text-sm" id="phoneError"></span>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" placeholder="Enter description"></textarea>
                <span class="text-red-600 text-sm" id="descriptionError"></span>
            </div>

            <div class="mb-4">
                <label for="role_id" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                <select id="role_id" name="role_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                    <option value="">Select a role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <span class="text-red-600 text-sm" id="role_idError"></span>
            </div>

            <div class="mb-4">
                <label for="profile_image" class="block text-gray-700 text-sm font-bold mb-2">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                <span class="text-red-600 text-sm" id="profile_imageError"></span>
            </div>

            <button type="button" id="submitUserForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none">Submit</button>
        </form>
    </div>

    <div class="container mx-auto py-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden dark:bg-zinc-900">
            <table id="userTable" class="min-w-full bg-white table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">Name</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Phone</th>
                        <th class="py-2 px-4 text-left">Description</th>
                        <th class="py-2 px-4 text-left">Role</th>
                        <th class="py-2 px-4 text-left">Profile Image</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('custom_scripts')
<script>
    window.routes = {
        store: "{{ route('users.store') }}",
        fetch: "{{ route('users.all') }}"
    };
</script>
<script src="{{ asset('js/user.js') }}"></script>
@endpush
