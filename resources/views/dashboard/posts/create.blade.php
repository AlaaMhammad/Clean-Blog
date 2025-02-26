<x-dashboard title="Main Dashboard">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Add New Post</h1>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-info"><i class="fas fa-long-arrow-alt-left"></i>All Posts</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('dashboard.posts._form')
                <button class='btn btn-success'><i class="fas fa-save"></i> Save</button>
            </form>
        </div>
    </div>

</x-dashboard>

