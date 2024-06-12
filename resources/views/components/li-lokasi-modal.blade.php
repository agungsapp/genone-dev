<li>
		<!-- Button trigger modal -->
		<button type="button" id="modalLokasiBtn"
				style="background: none; 
																				border: none; 
																				padding: 10px;
																				font-size: 16px;  
																				color: black;
    font: inherit;
    cursor: pointer;"
				class="dark-menu-item" data-toggle="modal" data-target="#modalLokasi">
				<i class="fa fa-map-marker"></i>
				<span id="lokasiTextShow" class="lokasiTextShow ms-2">Lokasi</span>
		</button>

		<!-- Modal -->
		<div class="modal fade" id="modalLokasi" tabindex="-1" aria-labelledby="modalLokasiLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title text-dark" id="modalLokasiLabel">Temukan Lokasi Anda</h5>
										<button type="button" class="close close_modal_lokasi" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
										</button>
								</div>
								<div class="modal-body">
										<div class="form-group">
												<label for="lokasi">Lokasi Anda</label>
												<select id="lokasi" class="form-control select2 select2-modal w-100" style="width: 100%;" name="lokasi">
														<option>-- pilih lokasi --</option>
														@foreach ($lokasis as $lokasi)
																<option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
														@endforeach
												</select>
										</div>
								</div>
								<div class="modal-footer">
										<button type="button" class="btn btn-secondary close_modal_lokasi" data-dismiss="modal">Tutup</button>
										<button type="button" class="btn btn-danger">Simpan</button>
								</div>
						</div>
				</div>
		</div>

</li>
