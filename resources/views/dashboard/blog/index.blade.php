@extends('layouts.master')

@section('content')
<!-- Main Container -->
<main id="main-container">
  <!-- Hero Content -->
  <div class="bg-image" style="background-image: url('{{ asset('dashboard/assets/media/photos/photo23@2x.jpg') }}');">
      <div class="bg-primary-dark-op">
          <div class="content content-full overflow-hidden">
              <div class="mt-7 mb-5 text-center">
                  <h1 class="h2 text-white mb-2 js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown">The latest stories only for you.</h1>
                  <h2 class="h4 font-w400 text-white-75 js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown">Feel free to explore and read.</h2>
              </div>
          </div>
      </div>
  </div>

  <!-- Page Content -->
  <div class="content content-boxed">
    <div class="row">
      <livewire:posts>
    </div>
  </div>
</main>
<!-- END Main Container -->
@endsection
