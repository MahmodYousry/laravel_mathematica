@include('dashboard.includes.head')
    <!-- Page Container -->
    @if (App::getLocale() == 'ar')
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay sidebar-r side-scroll page-header-fixed main-content-narrow">
    @else
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    @endif
        @include('dashboard.includes.sidebar-overlay')
        @include('dashboard.includes.sidebar')
        @include('dashboard.includes.header')

        @yield('content')

        @include('dashboard.includes.footer')
        @include('dashboard.includes.apps-modal')
    </div>
    <!-- END Page Container -->
@include('dashboard.includes.foot')
