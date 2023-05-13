@include('dashboard.includes.head')
    <!-- Page Container -->
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
        @include('dashboard.includes.sidebar-overlay')
        @include('dashboard.includes.sidebar')
        @include('dashboard.includes.header')

        @yield('content')

        @include('dashboard.includes.footer')
        @include('dashboard.includes.apps-modal')
    </div>
    <!-- END Page Container -->
@include('dashboard.includes.foot')
