<script>
    $(document).ready(function() {
        delete_btn = $('input[type="submit"][value="Delete"]');
        delete_btn.attr('type', 'button');
        delete_btn.on('click', function (event) {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'border-0',
            cancelButtonClass: 'border-0',
            confirmButtonColor: '#DD0F20',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).attr('type', 'submit');
                    $(this).off('click');
                    $(this).click();
                }
            });
        });
    });
</script>
