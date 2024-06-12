@extends('user.layouts.main')
@section('content')
		<div class="breadcrumb-main bg-dark">
				<div class="container">
						<div class="row">
								<div class="col">
										<div class="breadcrumb-contain">
												<div>
														<h2 class="text-white">Team</h2>
														<ul>
																<li>
																		<a class="text-white" href="javascript:void(0)">Profil</a>
																</li>
																<li><i class="fa fa-angle-double-right text-white"></i></li>
																<li>
																		<a class="text-white" href="javascript:void(0)">{{ $sales->nama }}</a>
																</li>
														</ul>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>

		<section class="team1">
				<div class="container">
						<div class="row">
								<div class="col-12 pr-0">
										<img class="w-100 img_dealer" src="{{ asset('assets') }}/images/dealers/{{ $sales->dealer->gambar }}"
												alt="dealer background">

								</div>
								<div class="row position-relative pb-5">
										<div class="col-3">
												<img src="{{ Storage::url('sales/' . $sales->path_image) }}" class="img_sales" alt="">
												{{-- <div style="background-image: url('');" class="img_sales">
												</div> --}}
										</div>
										<div class="col-9 d-flex justify-content-between p-3">
												<h3 class="align-self-center nama_sales">{{ $sales->nama }}</h3>
												<h5 class="nama_delaer">{{ $sales->dealer->nama }}</h5>
										</div>
										<div class="row">
												<div class="col-3"></div>
												<div class="col-9">
														<p class="slogan rounded-1 mt-5 text-center text-white">"{{ $sales->slogan }}"</p>
												</div>
										</div>

								</div>
						</div>
				</div>
		</section>
@endsection

@push('css')
		<style>
				.img_dealer {
						height: 300px;
						object-fit: cover;
						object-position: center center;
				}

				.nama_sales {
						font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
						color: #DD0202;
				}

				.nama_delaer {
						color: #E2185A;
				}

				.slogan {
						font-family: 'Quicksand', Arial, Helvetica, sans-serif;
						font-size: 1.5em;
						font-style: italic;
						background-color: #424242;
				}

				.img_sales {
						width: 200px;
						height: 200px;
						border: 4px solid #FEF7F4;
						border-radius: 100%;
						object-fit: cover;
						object-position: center;
						position: absolute;
						top: -5rem;
						left: 3rem;
				}
		</style>
@endpush
