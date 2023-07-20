@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table Product</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-right">
                                <a href="#" id="addDataButton" class="btn btn-primary">Add New Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="productTable" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Add New Data Modal -->
    <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataModalLabel">Add New Data Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add Data Form -->
                    <form id="addDataForm" action="{{ route('products.store') }}" method="POST">
                        <div class="form-group">
                            <label for="nama_product">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_product" name="nama_product" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_category">Kategori</label>
                            <select class="form-control" id="nama_category" name="nama_category" required>
                                <option value="1">Electronics</option>
                                <option value="2">Fashion</option>
                                <option value="3">Home</option>
                                <option value="4">Sports</option>
                                <option value="5">Books</option>
                                <option value="6">Beauty</option>
                                <option value="7">Toys</option>
                                <option value="8">Food</option>
                                <option value="9">Health</option>
                                <option value="10">Automotive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="qty_product" name="qty_product" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga_product" name="harga_product" required>
                        </div>
                        <input type="hidden" name="_method" value="POST">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" form="addDataForm" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- View Data Modal -->
    <div class="modal fade" id="viewDataModal" tabindex="-1" role="dialog" aria-labelledby="viewDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDataModalLabel">View Data Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="viewDataContent">
                    {{-- Data akan tertampil disini --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap4.min.css">
@endpush

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="/assets/js/page/modules-datatables.js"></script>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('products.index') }}",
                "columns": [{
                        "data": "DT_RowIndex",
                        "searchable": false
                    },
                    {
                        "data": "nama_product",
                        "searchable": true
                    },
                    {
                        "data": "nama_category",
                        "searchable": true
                    },
                    {
                        "data": "qty_product",
                        "searchable": true
                    },
                    {
                        "data": "harga_product",
                        "searchable": true,
                        "render": function(data, type, row) {
                            return "Rp. " + data;
                        }
                    },
                    {
                        "data": null,
                        "orderable": false,
                        "searchable": false,
                        "render": function(data, type, row) {
                            var editButton = '<a href="" class="btn btn-sm btn-warning">Edit</a>';
                            editButton = editButton.replace(':id', row.id);
                            var viewButton =
                                '<button class="btn btn-sm btn-info btn-view" data-id="' + row.id +
                                '" data-toggle="modal" data-target="#viewDataModal">View</button>';
                            var deleteButton =
                                '<button class="btn btn-sm btn-danger btn-delete" data-id="' + row
                                .id + '">Delete</button>';

                            return editButton + ' ' + viewButton + ' ' + deleteButton;
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-delete', function() {
            var productId = $(this).data('id');
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#addDataButton', function() {
                $('#addDataModal').modal('show');
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-view', function() {
            var productId = $(this).data('id');
            $.ajax({
                url: "{{ route('products.show', ':id') }}".replace(':id', productId),
                method: 'GET',
                success: function(response) {
                    var productData = response.data;
                    var html = '<div>' +
                        '<h5>Nama Produk: ' + productData.nama_product + '</h5>' +
                        '<h5>Kategori: ' + productData.nama_category + '</h5>' +
                        '<h5>Jumlah: ' + productData.qty_product + '</h5>' +
                        '<h5>Harga: Rp. ' + productData.harga_product + '</h5>' +
                        '</div>';

                    $('#viewDataContent').html(html);
                    $('#viewDataModal').modal('show');
                }
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            // Handle delete button click
            $(document).on('click', '.btn-delete', function() {
                var productId = $(this).data('id');
                $('#deleteButton').data('product-id', productId); // Set the product ID to the delete button's data attribute
                $('#deleteModal').modal('show');
            });

            // Handle delete confirmation
            $('#deleteButton').click(function() {
                var productId = $(this).data('product-id');

                // Send AJAX request to delete the product
                $.ajax({
                    url: "/products/" + productId,
                    method: 'DELETE',
                    success: function(response) {
                        // Hide the modal
                        $('#deleteModal').modal('hide');

                        // Display success message or perform any other action
                        alert(response.message);

                        // You can also reload the DataTable to update the table after deletion
                        $('#productTable').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        // Handle error response
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush