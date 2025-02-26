<div class="row">
    <div class="col-md-9">
        <div class="mb-3">
            <x-form.input label="Title" name="title" placeholder="Enter Post Title" :oldval="$post->title" />
        </div>

        <div class="mb-3">
            <x-form.input label="Subtitle" name="subtitle" placeholder="Enter Post Subtitle" :oldval="$post->subtitle" />
        </div>

        <div class="mb-3">
            <x-form.area label="Content" name="content" placeholder="Enter Post Content" :oldval="$post->content" :tiny=true />
        </div>

        <div class="mb-3">
            <x-form.select label="Category" name="category_id" placeholder='Select Category' :options="$categories" :oldval="$post->category_id" />
        </div>

        <div class="mb-3">
            <x-form.check label="Tags" name="tags[]" :options="$tags" :oldval="$post->tags_ids" multiple=true />
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label class="d-block" for="image">
                <img class="img-thumbnail prev-img" style="width: 100%; height: 300px; object-fit: cover;" 
                src="{{ asset($post->image ? $post->image : '') }}" alt="img">
            </label>
            <div class="d-none">
                <x-form.file label="Image" name="image" :oldimage="$post->image" />
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            // Image Preview
            $('#image').change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('.prev-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
