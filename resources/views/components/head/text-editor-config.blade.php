<script src="{{ asset('backend/assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.text-editor',
        height: 300,
        plugins: 'code table lists wordcount ',
        toolbar: 'undo redo | formatselect | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        // plugins: [
        //     'advlist autolink lists link image charmap print preview anchor',
        //     'searchreplace visualblocks code fullscreen',
        //     'insertdatetime media table paste code help wordcount'
        // ],
        // toolbar: 'undo redo | formatselect | bold italic backcolor | \
        //                   alignleft aligncenter alignright alignjustify | \
        //                   bullist numlist outdent indent | removeformat | help'
    });
</script>
