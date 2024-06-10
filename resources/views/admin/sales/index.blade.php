@extends('admin.layouts.main')
@section('content')
		<section class="content">
				<div class="row">
						<div class="col-12">
								<div class="card card-primary">
										<div class="card-header with-border">
												<h3 class="card-title">Input Data Sales</h3>
										</div>
										<form action="{{ route('admin.sales.store') }}" method="post" enctype="multipart/form-data">
												@csrf
												<div class="card-body">
														<div class="row">
																<div class="form-group col-md-6">
																		<label class="text-capitalize" for="input-nama">Nama Sales</label>
																		<input name="nama" type="text" class="form-control" placeholder="Masukan nama sales"
																				value="{{ old('nama') }}">
																</div>
																<div class="form-group col-md-6">
																		<label class="text-capitalize" for="input-kode">NIP Sales</label>
																		<input name="kode" type="text" class="form-control" placeholder="Masukan NIP sales"
																				value="{{ old('kode') }}">
																</div>
														</div>
														<div class="row">
																<div class="form-group col-md-6">
																		<label class="text-capitalize" for="input-username">Username</label>
																		<input name="username" type="text" class="form-control" id="input-username"
																				placeholder="Masukan username sales" value="{{ old('username') }}">
																</div>
																<div class="form-group col-md-6">
																		<label class="text-capitalize" for="input-password">Password</label>
																		<input name="password" type="password" class="form-control" placeholder="Masukan password">
																</div>
														</div>

														{{-- tambahan baru --}}
														<div class="row">
																{{-- jabatan --}}
																<div class="form-group col-md-4">
																		<label class="text-capitalize" for="jabatan">Jabatan</label>
																		<select id="jabatan" class="form-control" name="jabatan">
																				<option>-- pilih jabatan --</option>
																				@foreach ($jabatans as $jabatan)
																						<option class="text-capitalize" value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
																				@endforeach
																		</select>
																</div>
																{{-- nomor --}}
																<div class="form-group col-md-4">
																		<label class="text-capitalize" for="nomor">Nomor</label>
																		<input name="nomor" id="nomor" type="text" class="form-control" placeholder="nomor"
																				value="{{ old('nomor') }}">
																</div>
																{{-- slogan --}}
																<div class="form-group col-md-4">
																		<label class="text-capitalize" for="slogan">slogan</label>
																		<input name="slogan" id="slogan" type="text" class="form-control" placeholder="slogan"
																				value="{{ old('slogan') }}">
																</div>
																{{-- dealer --}}
																<div class="form-group col-md-4">
																		<label class="text-capitalize" for="dealer">Dealer</label>
																		<select id="dealer" class="form-control" name="dealer">
																				<option>-- pilih dealer --</option>
																				@foreach ($dealers as $dealer)
																						<option class="text-capitalize" value="{{ $dealer->id }}">{{ $dealer->nama }}</option>
																				@endforeach
																		</select>
																</div>
																{{-- urutan --}}
																<div class="form-group col-md-2 col-4">
																		<label class="text-capitalize" for="urutan">urutan</label>
																		<input name="urutan" id="urutan" type="number" class="form-control" placeholder="urutan"
																				value="{{ old('urutan') }}">
																</div>
																{{-- foto --}}
																<div class="form-group col-md-4">
																		<label for="foto" class="text-capitalize form-label">foto</label>
																		<div class="input-group" id="foto">
																				<div class="custom-file">
																						<input name="foto" type="file" class="custom-file-input" id="fotoUpload"
																								aria-describedby="fotoUpload">
																						<label class="custom-file-label" for="fotoUpload">Pilih Foto</label>
																				</div>
																		</div>
																</div>
																{{-- active --}}
																<div class="form-group d-flex justify-content-end align-items-end col-md-2">
																		<div>
																				<label class="text-capitalize" for="active">Active</label>
																				<input id="active" type="checkbox" name="active" data-toggle="toggle">
																		</div>
																</div>
														</div>
														<div class="row">
																<div class="col-2">
																		<img src="" id="preview_image" class="w-100 img-fluid" alt="" srcset="">
																</div>
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
												<h3 class="card-title">Data Akun Sales</h3>
										</div>
										<!-- /.card-header -->
										<div class="card-body">

												<div class="table-responsive">
														<table id="data-sale" class="table-bordered table-striped table">
																<thead>
																		<tr role="row">
																				<th>NO</th>
																				<th>Nama Sales</th>
																				<th>Dealer</th>
																				<th>Username</th>
																				<th>Status online</th>
																				<th>Active</th>
																				<th>Jabatan</th>
																				<th>Urutan</th>
																				<th>NIP</th>
																				<th width="170px">Action</th>
																		</tr>
																</thead>
																<tbody>
																		@foreach ($sales as $index => $sale)
																				<tr role="row" class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
																						<td>{{ $loop->iteration }}</td>
																						<td>{{ $sale->nama }}</td>
																						<td>{{ $sale->dealer->nama }}</td>
																						<td>{{ $sale->username }}</td>
																						<td>{{ $sale->status_online ? 'Online' : 'Offline' }}</td>
																						<td>
																								<span
																										class="badge {{ $sale->active ? 'badge-info' : 'badge-secondary' }}">{{ $sale->active ? 'aktif' : 'tidak aktif' }}</span>
																						</td>
																						<td>{{ $sale->jabatan->nama }}</td>
																						<td>{{ $sale->urutan }}</td>
																						<td>{{ $sale->nip }}</td>
																						<td>
																								<div class="btn-group">
																										<form action="{{ route('admin.sales.destroy', $sale->id) }}" method="post">
																												<!-- Button trigger modal -->
																												<button type="button" class="btn btn-primary" data-toggle="modal"
																														data-target="#modalEdit{{ $sale->id }}">
																														Edit
																												</button>
																												@csrf
																												@method('DELETE')
																												<button type="submit" class="btn btn-danger show_confirm">Delete</button>
																										</form>
																								</div>
																								<!-- Modal update -->
																								<div class="modal fade" id="modalEdit{{ $sale->id }}" tabindex="-1" role="dialog"
																										aria-labelledby="myModalLabel">
																										<div class="modal-dialog" role="document">
																												<div class="modal-content">
																														<div class="modal-header">
																																<h4 class="modal-title" id="myModalLabel">Edit data:
																																		{{ $sale->nama }}</h4>
																														</div>
																														<form action="{{ route('admin.sales.update', $sale->id) }}" method="post">
																																@csrf
																																@method('PUT')
																																<div class="modal-body">
																																		<div class="card card-primary">
																																				<div class="card-header with-border">
																																						<h3 class="card-title">Update Data sales</h3>
																																				</div>
																																				<input type="hidden" value="{{ $sale->id }}">
																																				<div class="card-body">
																																						<div class="form-group">
																																								<label for="input-nama">Nama Sales</label>
																																								<input name="nama" type="text" class="form-control"
																																										placeholder="Masukan nama sales" value="{{ $sale->nama }}">
																																						</div>
																																						<div class="form-group">
																																								<label for="input-kode">NIP Sales</label>
																																								<input name="kode" type="text" class="form-control"
																																										placeholder="Masukan NIP sales" value="{{ $sale->nip }}">
																																						</div>
																																						<div class="form-group">
																																								<label for="input-username">Username</label>
																																								<input name="username" type="text" class="form-control" id="input-username"
																																										placeholder="Masukan username sales)" value="{{ $sale->username }}">
																																						</div>
																																						<div class="form-group">
																																								<label for="input-password">Password</label>
																																								<input name="password" type="text" class="form-control"
																																										placeholder="Masukan password jika ingin ganti">
																																								<input name="password_old" type="hidden" class="form-control"
																																										placeholder="Masukan password" value="{{ $sale->password }}">
																																						</div>
																																						{{-- tambahan baru --}}

																																						{{-- jabatan --}}
																																						<div class="form-group col-12">
																																								<label class="text-capitalize" for="jabatan">Jabatan</label>
																																								<select id="jabatan" class="form-control" name="jabatan">
																																										<option>-- pilih jabatan --</option>
																																										@foreach ($jabatans as $jabatan)
																																												<option class="text-capitalize"
																																														{{ $sale->id_jabatan == $jabatan->id ? 'selected' : '' }}
																																														value="{{ $jabatan->id }}">
																																														{{ $jabatan->nama }}</option>
																																										@endforeach
																																								</select>
																																						</div>
																																						{{-- nomor --}}
																																						<div class="form-group col-12">
																																								<label class="text-capitalize" for="nomor">Nomor</label>
																																								<input name="nomor" id="nomor" type="text" class="form-control"
																																										placeholder="nomor" value="{{ $sale->nomor }}">
																																						</div>
																																						{{-- slogan --}}
																																						<div class="form-group col-12">
																																								<label class="text-capitalize" for="slogan">slogan</label>
																																								<input name="slogan" id="slogan" type="text" class="form-control"
																																										placeholder="slogan" value="{{ $sale->slogan }}">
																																						</div>
																																						{{-- dealer --}}
																																						<div class="form-group col-12">
																																								<label class="text-capitalize" for="dealer">Dealer</label>
																																								<select id="dealer" class="form-control" name="dealer">
																																										<option>-- pilih dealer --</option>
																																										@foreach ($dealers as $dealer)
																																												<option class="text-capitalize"
																																														{{ $sale->id_dealer == $dealer->id ? 'selected' : '' }}
																																														value="{{ $dealer->id }}">
																																														{{ $dealer->nama }}</option>
																																										@endforeach
																																								</select>
																																						</div>
																																						{{-- urutan --}}
																																						<div class="form-group col-12">
																																								<label class="text-capitalize" for="urutan">urutan</label>
																																								<input name="urutan" id="urutan" type="number" class="form-control"
																																										placeholder="urutan" value="{{ $sale->urutan }}">
																																						</div>
																																						{{-- foto --}}
																																						<div class="form-group col-12">
																																								<label for="foto" class="text-capitalize form-label">foto</label>
																																								<div class="input-group" id="foto">
																																										<div class="custom-file">
																																												<input name="foto" type="file" class="custom-file-input"
																																														id="fotoUpload" aria-describedby="fotoUpload">
																																												<label class="custom-file-label" for="fotoUpload">Pilih Foto</label>
																																										</div>
																																								</div>
																																						</div>
																																						{{-- active --}}
																																						<div class="form-group col-12">
																																								<div>
																																										<label class="text-capitalize" for="active">Active</label>
																																										<input style="width: 100px;" {{ $sale->active ? 'checked' : '' }}
																																												id="active" type="checkbox" name="active" data-toggle="toggle">
																																								</div>
																																						</div>

																																				</div>
																																		</div>
																																</div>
																																<div class="modal-footer">
																																		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																																		<button type="submit" class="btn btn-primary">Simpan perubahan</button>
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
				</div>
		</section>
@endsection
@push('css')
		<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
				rel="stylesheet">
@endpush
@push('script')
		<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
		<script>
				$(function() {
						$("#data-sale").DataTable({
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



						// load image
						// Ambil elemen input file dan elemen gambar pratinjau
						const fileInput = document.getElementById('fotoUpload');
						const previewImage = document.getElementById('preview_image');

						// Tambahkan event listener untuk perubahan pada input file
						fileInput.addEventListener('change', function() {
								const file = this.files[0];

								// Jika ada file yang dipilih
								if (file) {
										const reader = new FileReader();

										// Saat pembacaan file selesai
										reader.onload = function(e) {
												// Tampilkan pratinjau gambar
												previewImage.src = e.target.result;
												previewImage.style.display = 'block'; // Tampilkan elemen img
										};

										// Baca file sebagai data URL
										reader.readAsDataURL(file);
								} else {
										// Jika tidak ada file, sembunyikan pratinjau gambar
										previewImage.src = '';
										previewImage.style.display = 'none';
								}
						});


				})
		</script>
@endpush
