@extends('admin.layouts.main')
@section('content')
		<section class="content">
				<div class="row">
						<div class="col-12">
								<div class="card card-primary">
										<div class="card-header with-border">
												<h3 class="card-title">Tambah data jabatan</h3>
										</div>
										<form action="{{ route('admin.jabatan.store') }}" method="post">
												@csrf
												<div class="card-body">
														<div class="form-group">
																<label for="input-kota">Nama Jabatan</label>
																<input name="nama" type="text" class="form-control" id="input-color"
																		placeholder="SPV, Sales Digital Marketing" value="{{ old('nama') }}">
														</div>
												</div>
												<div class="card-footer">
														<button type="submit" class="btn btn-primary">Submit</button>
												</div>
										</form>
								</div>

						</div>
				</div>
		</section>

		<section class="content">
				<div class="row">
						<div class="col-12">
								<div class="card card-primary">
										<div class="card-header">
												<h3 class="card-title">Data Jabatan</h3>
										</div>
										<!-- /.card-header -->
										<div class="card-body">

												<table id="data-kota" class="table-bordered table-striped table">
														<thead>
																<tr role="row">
																		<th>NO</th>
																		<th>Nama Jabatan</th>
																		<th width="170px">Action</th>
																</tr>
														</thead>
														<tbody>

																@foreach ($jabatans as $index => $jabatan)
																		<tr role="row" class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
																				<td>{{ $loop->iteration }}</td>
																				<td class="text-capitalize">{{ $jabatan->nama }}</td>
																				<td>
																						<div class="btn-group">

																								<!-- Button trigger modal -->
																								<button type="button" class="btn btn-primary" data-toggle="modal"
																										data-target="#modalEdit{{ $jabatan->id }}">
																										Edit
																								</button>
																								<button class="btn btn-danger delete-button" data-id="{{ $jabatan->id }}">delete</button>

																						</div>
																						<!-- Modal update -->
																						<div class="modal fade" id="modalEdit{{ $jabatan->id }}" tabindex="-1" role="dialog"
																								aria-labelledby="myModalLabel">
																								<div class="modal-dialog" role="document">
																										<div class="modal-content">
																												<div class="modal-header">
																														<h4 class="modal-title" id="myModalLabel">Edit data: {{ $jabatan->nama }}</h4>
																												</div>
																												<form action="{{ route('admin.jabatan.update', $jabatan->id) }}" method="post">
																														@csrf
																														@method('PUT')
																														<div class="modal-body">
																																{{ csrf_field() }}
																																<input type="hidden" value="{{ $jabatan->id }}">
																																<div class="form-group">
																																		<label for="exampleInputTypeMotor">Nama Jabatan</label>
																																		<input value="{{ $jabatan->nama }}" name="nama_edit" type="text"
																																				class="form-control" id="exampleInputTypeMotor"
																																				placeholder="SPV, Sales Digital Marketing">
																																</div>
																														</div>
																														<div class="modal-footer">
																																<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
																																<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
																														</div>
																												</form>
																										</div>
																								</div>
																						</div>
																				</td>
																		</tr>
																@endforeach
														</tbody>
												</table>
										</div>
								</div>
						</div>
				</div>
		</section>
@endsection
@push('script')
		<script>
				$(function() {
						$("#data-kota").DataTable({
								"responsive": true,
								"lengthChange": false,
								"autoWidth": false,
								//"buttons": ["copy", "csv", "excel", "pdf", "print"] //, "colvis"
						}).buttons().container().appendTo('#dataMotor_wrapper .col-md-6:eq(0)');
				});
				$(document).ready(function() {
						$('.show_confirm').click(function(event) {
								var form = $(this).closest("form");
								var name = $(this).data("name");
								event.preventDefault();
								swal({
												title: `Delete Data ?`,
												text: "data yang di hapus tidak dapat dipulihkan!",
												icon: "warning",
												buttons: true,
												dangerMode: true,
										})
										.then((willDelete) => {
												if (willDelete) {
														form.submit();
												}
										});
						});
				})

				$(document).ready(function() {
						$('.delete-button').on('click', function(e) {
								e.preventDefault();
								const userId = $(this).data('id');
								const row = $(this).closest('tr');

								Swal.fire({
										title: 'Anda yakin?',
										text: "Data yang dihapus tidak dapat dikembalikan!",
										icon: 'warning',
										showCancelButton: true,
										confirmButtonColor: '#d33',
										cancelButtonColor: '#3085d6',
										confirmButtonText: 'Ya, hapus!',
										cancelButtonText: 'Batal'
								}).then((result) => {
										if (result.isConfirmed) {
												// Submit form penghapusan dengan AJAX
												$.ajax({
														url: `/app/jabatan/${userId}`,
														type: 'DELETE',
														data: {
																_token: '{{ csrf_token() }}',
														},
														success: function(response) {
																Swal.fire('Dihapus!', response.message, 'success');
																row.remove(); // Hapus baris dari tabel
														},
														error: function(xhr) {
																Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
																console.error(xhr);
														}
												});
										}
								});
						});
				});
		</script>
@endpush
