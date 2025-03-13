<x-dashboard title="Main Dashboard">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Contact Messages</h1>

    <div class="card">
        <div class="card-body">
            <h2>Message From : {{ $message->name }}</h2>
            <h2>Message : {{ $message->message }}</h2>
            <p>Phone : {{ $message->phone }}</p>
            <p>Email : {{ $message->email }}</p>

            <hr>
            <h3>Reply</h3>
            <form action="{{ route('contact_messages.reply', $message->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="reply">Reply</label>
                    <textarea name="reply" id="reply" class="form-control" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-info bx-5"><i class="fas fa-paper-plane mr-2"></i> Reply</button>
            </form>
        </div>
    </div>

    @push('css')
        <!-- Custom styles for this page -->
        <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    @push('js')
        <!-- Page level plugins -->
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    @endpush
</x-dashboard>
