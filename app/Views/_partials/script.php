
<script src="<?php echo base_url("js/app.js"); ?>"></script>
<script src="<?php echo base_url("js/sweetalert2.js"); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

<script>
    $(document).ready(function() {
        $('#data-administrasi-table').DataTable({
            dom: 'Bfrtip',
            buttons: ['excelHtml5'],
            responsive: true
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('href');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo session()->getFlashdata("success"); ?>',
                timer: 1000,
                showConfirmButton: false
            });
        <?php endif ?>

        <?php if (session()->has('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo session()->getFlashdata("error"); ?>',
                timer: 1000,
                showConfirmButton: false
            });
        <?php endif ?>
    });
</script>

