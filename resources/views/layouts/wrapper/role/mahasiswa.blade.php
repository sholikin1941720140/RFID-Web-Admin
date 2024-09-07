<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" 
   data-accordion="false">
   <li class="nav-item">
      <a href="{{url('/dashboard')}}"
         class="nav-link {{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
         <i class="fas fa-home"></i>
         <p> &nbsp;
            Dashboard
         </p>
      </a>
   </li>
   <li class="nav-item">
      <a href="{{url('/mahasiswa-jadwal')}}"
         class="nav-link {{Request::segment(1) == 'mahasiswa-jadwal' ? 'active' : ''}}">
         <i class="fas fa-check"></i>
         <p> &nbsp;
            Jadwal
         </p>
      </a>
   </li>
   <li class="nav-item">
      <a href="{{url('/mahasiswa-absen')}}"
         class="nav-link {{Request::segment(1) == 'mahasiswa-absen' ? 'active' : ''}}">
         <i class="fas fa-calendar-check"></i>
         <p> &nbsp;
            Absensi
         </p>
      </a>
   </li>
</ul>

<style>
   .nav-sidebar .nav-item > .nav-link.active, .nav-treeview > .nav-item > .nav-link.active {
      background-color: #007bff !important;
      color: white;
   }
</style>
