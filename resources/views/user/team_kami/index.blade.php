@extends('user.layouts.main')
@section('content')
		<!-- breadcrumb start -->
		<div class="breadcrumb-main bg-dark">
				<div class="container">
						<div class="row">
								<div class="col">
										<div class="breadcrumb-contain">
												<div>
														<h2 class="text-white">Team kami</h2>
														<ul>
																<li>
																		<a class="text-white" href="javascript:void(0)">Team</a>
																</li>
																<li><i class="fa fa-angle-double-right text-white"></i></li>
																<li>
																		<a class="text-white" href="javascript:void(0)">Team</a>
																</li>
														</ul>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>


		{{-- TRY LOOP --}}

		@if ($jabatans->count() > 0)
				@foreach ($jabatans as $jabatan)
						<!--title start-->
						<div class="title6">
								<h4>{{ $jabatan->nama }}</h4>
						</div>
						<!--title end-->

						<!-- team start -->
						<section class="team1">
								<div class="custom-container">
										<div class="row">
												<div class="col-12 pr-0">
														<div class="team-slide4 no-arrow">
																@if ($jabatan->sales->count() > 0)
																		@foreach ($jabatan->sales as $sales)
																				<div>
																						<div class="team-box">
																								<div class="img-wrraper">
																										<img src="{{ Storage::url('sales/' . $sales->path_image) }}" alt="team"
																												class="img-fluid img-team">
																								</div>
																								<div class="team-detail">
																										<h3 class="text-center">{{ $sales->nama }}</h3>
																										<h5 class="text-center">{{ $sales->jabatan->nama }}</h5>
																										<p>{{ $sales->slogan }}</p>
																										<ul class="d-flex justify-content-center gap-2">
																												<li class="bg-success"><a href="https://wa.me/{{ Str::wanomor($sales->nomor) }}?text=Hallo"
																																target="_blank" tabindex="0">
																																<i class="fa fa-whatsapp" aria-hidden="true"></i></a>
																												</li>
																										</ul>
																								</div>
																						</div>
																				</div>
																		@endforeach
																@else
																		<h4 class="text-center">-- belum ada data tim --</h4>
																@endif
														</div>
												</div>
										</div>
								</div>
						</section>
						<!-- team end -->
				@endforeach
		@else
				<h4 class="text-center">-- belum ada data tim --</h4>
		@endif

@endsection


@push('css')
		<style>
				.img-team {
						width: 736px;
						height: 200px;
						object-fit: cover;
						object-position: top center;
				}
		</style>
@endpush
