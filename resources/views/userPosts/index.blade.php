<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="mt-4 bg-white rounded shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-xl font-semibold">Your Posts
                    <a href="{{ url('add-post') }}"
                        class="float-right text-white bg-blue-500 hover:bg-blue-600 rounded px-2 py-1">Add Post</a>
                </h4>
            </div>
            <div class="p-6">
                @if (session('message'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
                        id="alertMessage">{{ session('message') }}</div>
                @endif

                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">No.</th>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Published Date</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Categories</th>
                            <th class="px-4 py-2">Edit</th>
                            <th class="px-4 py-2">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $item->title }}</td>
                                <td class="border px-4 py-2">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                <td class="border px-4 py-2">{{ $item->is_draft == true ? 'Draft' : 'Published' }}</td>
                                <td class="border px-4 py-2">
                                    @foreach ($item->categories as $category)
                                        {{ $category->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ url('edit-post/' . $item->id) }}"
                                        class="text-white bg-green-500 hover:bg-green-600 rounded px-2 py-1">Edit</a>
                                </td>
                                <td class="border px-4 py-2">
                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}"
                                        class="text-white bg-red-500 hover:bg-red-600 hover:cursor-pointer rounded px-2 py-1">Delete</a>
                                </td>
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                                                    Confirm
                                                    Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this post?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="text-white bg-gray-500  rounded px-3 py-2"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ url('delete-post/' . $item->id) }}"
                                                    class="text-white bg-red-500  rounded px-3 py-2">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
@section('scripts')
    <script>
        // Wait for the document to be ready
        document.addEventListener("DOMContentLoaded", function() {
            // Get the alert element by its ID
            const alertMessage = document.getElementById('alertMessage');

            // Set a timeout to hide the alert after 5 seconds (adjust the time as needed)
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 2500); // 5000 milliseconds = 5 seconds
        });
    </script>
@endsection
