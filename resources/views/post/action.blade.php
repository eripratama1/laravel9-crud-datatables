<a href="{{ route('post.edit',$model) }}" class="btn btn-warning btn-sm">Update</a>
<button href="{{ route('post.destroy',$model) }}" id="delete" class="btn btn-danger btn-sm">Delete</button>

{{-- Inisiasi sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

    // Menampilkan pesan konfirmasi hapus data dengan sweetalert2
    // Ketika button dengan id delete di klik akan menjalankan fungsi
    // dari sweetalert2  seperti dibawah ini 

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
            confirmButtonText: 'Ya, Hapus Data!',
            cancelButtonText: 'Batal!'
        }).then((result) => {
            if (result.isConfirmed) {

                // Jika confirm button 'Ya Hapus Data' yang dipilih maka isi
                // atribut action pada form, yang memiliki id deleteForm dengan nilai dari href pada button
                // delete di atas.
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