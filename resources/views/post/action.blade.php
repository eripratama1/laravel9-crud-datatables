<a href="{{ route('post.edit',$model) }}" class="btn btn-warning btn-sm">Update</a>
<button href="{{ route('post.destroy',$model) }}" id="delete" class="btn btn-danger btn-sm">Delete</button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('button#delete').on('click', function(e) {
        e.preventDefault();

        var href = $(this).attr('href');

        Swal.fire({
            title: 'Hapus Data Ini?',
            text: "Perhatian data yang sudah di hapus tidak bisa di kembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal!'
        }).then((result) => {
            if (result.isConfirmed) {

                document.getElementById('deleteForm').action = href;
                document.getElementById('deleteForm').submit();

                Swal.fire({
                    position: 'top-mid',
                    icon: 'success',
                    title: 'Data berhasil dihapus',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        })
    });
</script>