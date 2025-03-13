<x-dashboard title="Main Dashboard">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Website Settings</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.settings') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <x-form.input label="Site Name" name="site_name" placeholder="Enter Website Name" oldval="{{ $settings['site_name'] }}" />
                </div>
                <div class="mb-3">
                    <x-form.file label="Site Logo" name="site_logo" oldimage="{{ $settings['site_logo'] ?? ''}}" can_delete='true' />
                </div>
                <div class="mb-3">
                    <x-form.input label="Facebook" name="facebook" placeholder="Enter Facebook URL" oldval="{{ $settings['facebook'] }}" />
                </div>
                <div class="mb-3">
                    <x-form.input label="Twitter" name="twitter" placeholder="Enter Twitter URL" oldval="{{ $settings['twitter'] }}" />
                </div>
                <div class="mb-3">
                    <x-form.input label="Linked In" name="linkedin" placeholder="Enter Linked In URL" oldval="{{ $settings['linkedin'] }}" />
                </div>
                <div class="mb-3">
                    <x-form.area label="Copyright" name="copyright" placeholder="Enter Copyright URL" oldval="{{ $settings['copyright'] }}" />
                </div>
                <button class='btn btn-success'><i class="fas fa-save"></i> Save</button>
            </form>
        </div>
    </div>

    @push('js')
        <script>
            let del_img = document.querySelector('#del_site_image');
            del_img.onclick = () => {
                $.get('/admin/delete_site_logo')
                .done((res) => {
                    del_img.parentElement.remove();
                })
                .fail((err) => {
                    console.log(err);
                });
            }
            document.getElementById('del_site_image').addEventListener('click', function() {
                document.getElementById('site_logo').value = '';
                this.parentElement.remove();
            });
        </script>
    @endpush

</x-dashboard>
