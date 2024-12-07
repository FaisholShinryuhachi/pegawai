<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.2/css/fileinput.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">

    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <style>
        .select2-container {
            z-index: 9999;
            /* Tingkatkan z-index untuk Select2 */
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

</head>

<body class="">
    <div class="container">
        <div class="class row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Daftar Pegawai</h3>
                        <a href="javascript:void(0)" id="button_add" class="edit btn btn-primary btn-sm">Tambah
                            Pegawai</a>
                    </div>
                    {{-- <h3 class="card-header p-3">Daftar Pegawai</h3> --}}
                    <div class="card-body overflow-auto">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Kemampuan</th>
                                    <th>Tanggal Aktif</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="modal_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Konten modal -->
                    <form id="add_employee_form" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input name="name" type="text" class="form-control" id="name"
                                placeholder="Masukkan nama">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_aktif" class="form-label">Tanggal Aktif</label>
                            <input name="tanggal_aktif" type="text" class="form-control" id="tanggal_aktif"
                                placeholder="Select a date">
                        </div>
                        <div class="mb-3">
                            <label for="kemampuan" class="form-label">Pilih Skill</label>
                            <select class="form-control js-example-basic-multiple" id="kemampuan" name="kemampuan[]"
                                multiple="multiple">
                                <option value="HTML">HTML</option>
                                <option value="CSS">CSS</option>
                                <option value="JavaScript">JavaScript</option>
                                <option value="PHP">PHP</option>
                                <option value="Python">Python</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="datepicker" class="form-label">File Pendukung</label>
                            {{-- <input id="filependukung" name="file" type="file" class="file" multiple> --}}
                            <input type="file" class="file-input" name="file[]" multiple>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button id="saveBtn" type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Data berhasil disimpan!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
        <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Gagal menyimpan data!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            // $("#add_employee_form").validate({
            //     rules: {
            //         name: {
            //             required: false,
            //             maxlength: 255
            //         },
            //         tanggal_aktif: {
            //             required: false,
            //             date: true
            //         },
            //         "kemampuan[]": {
            //             required: false
            //         },
            //         "file[]": {
            //             required: false,
            //             extension: "jpg|png|gif|pdf",
            //             filesize: 2048 * 1024 // 2 MB
            //         }
            //     },
            //     messages: {
            //         name: {
            //             required: "Nama wajib diisi",
            //             maxlength: "Nama tidak boleh lebih dari 255 karakter"
            //         },
            //         tanggal_aktif: {
            //             required: "Tanggal aktif wajib diisi",
            //             date: "Masukkan format tanggal yang benar"
            //         },
            //         "kemampuan[]": {
            //             required: "Pilih setidaknya satu kemampuan"
            //         },
            //         "file[]": {
            //             required: "File wajib diunggah",
            //             extension: "Hanya file JPG, PNG, GIF, dan PDF yang diperbolehkan",
            //             filesize: "Ukuran file maksimal adalah 2 MB"
            //         }
            //     },
            //     submitHandler: function(form) {
            //         saveData(); // Panggil fungsi simpan data
            //     }
            // });

            function saveData() {
                var formData = new FormData($("#add_employee_form")[0]);
                console.log('jalan')
                $.ajax({
                    url: "{{ route('pegawai.add') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        showToast("successToast");
                        $('#modal_add').modal('hide');
                        fetchData();
                        resetForm();
                    },
                    error: function(xhr, status, error) {
                        showToast("errorToast");
                    }
                });
            }

            function resetForm() {
                $("#add_employee_form")[0].reset();
                $('.js-example-basic-multiple').val(null).trigger('change');
                $(".file-input").fileinput('clear');
            }

            function showToast(toastId) {
                const toast = new bootstrap.Toast(document.getElementById(toastId));
                toast.show();
            }

            function fetchData() {
                return $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: "{{ route('pegawai.list') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'kemampuan',
                            name: 'kemampuan',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'tanggal_aktif',
                            name: 'tanggal_aktif'
                        },
                        {
                            data: 'image', // The image column
                            name: 'image',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                // Check if 'data' is a valid image URL and return the image HTML
                                return data ?
                                    `<img src="${data}" alt="Image" width="50" height="50">` :
                                    'No image';
                            }
                        },
                    ]
                });
            }

            fetchData()

            $("#tanggal_aktif").datepicker();

            // Inisialisasi Select2
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih skill",
                allowClear: true,
                dropdownParent: $('#modal_add'),
                width: '100%'
            });

            $(".file-input").fileinput({
                theme: "fas",
                allowedFileExtensions: ["jpg", "png", "gif", "pdf"],
                maxFileSize: 2048,
                showUpload: false,
                previewFileType: "any",
                browseClass: "btn btn-primary",
                removeClass: "btn btn-danger",
                showPreview: true,
                showRemove: false,
                fileActionSettings: {
                    showZoom: false,
                },
                maxFileCount: 5
            });

            $("#button_add").click(function() {
                // Tampilkan modal
                $('#modal_add').modal('show');
            });

            $("#saveBtn").click(function() {
                // $("#add_employee_form").submit(); // Trigger submit agar validator bekerja
                saveData()
            });
        });
    </script>
</body>

</html>
