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
   <li class="nav-item {{Request::segment(1) == 'data-master' ? 'menu-open' : ''}}">
      <a href="#" class="nav-link {{Request::segment(1) == 'data-master' ? 'active' : ''}}">
         <i class="nav-icon fas fa-cash-register"></i>
         <p>
            Data Master
            <i class="fas fa-angle-left right"></i>
         </p>
      </a>
      <ul class="nav nav-treeview" 
         style="display: {{Request::segment(1) == 'data-master' ? 'block' : 'none'}}; padding-left: 10%;">
         <li class="nav-item">
            <a href="{{url('/data-master/jam')}}" 
               class="nav-link {{Request::segment(2) == 'jam' ? 'active' : ''}}">
               <i class="fas fa-money-bill-wave-alt"></i>
               <p> &nbsp;
                  Jam
               </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="{{url('/data-master/matkul')}}" 
               class="nav-link {{Request::segment(2) == 'matkul' ? 'active' : ''}}">
               <i class="fas fa-exchange-alt"></i>
               <p> &nbsp;
                  Mata Kuliah
               </p>
            </a>
         </li>
      </ul>
   </li>

   <li class="nav-item {{Request::segment(1) == 'jadwal' ? 'menu-open' : ''}}">
      <a href="#" class="nav-link {{Request::segment(1) == 'jadwal' ? 'active' : ''}}">
         <i class="nav-icon  fas fa-check"></i>
         <p>
            Data Jadwal
            <i class="fas fa-angle-left right"></i>
         </p>
      </a>
      <ul class="nav nav-treeview"
         style="display: {{Request::segment(1) == 'jadwal' ? 'block' : 'none'}};padding-left: 10%;">
         <li class="nav-item">
            <a href="{{url('/jadwal/jadwal-mengajar')}}" 
               class="nav-link {{Request::segment(2) == 'jadwal-mengajar' ? 'active' : ''}}">
               <i class="fas fa-money-bill-wave-alt"></i>
               <p> &nbsp;
                  Jadwal Dosen
               </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="{{url('/jadwal/jadwal-mahasiswa')}}" 
               class="nav-link {{Request::segment(2) == 'jadwal-mahasiswa' ? 'active' : ''}}">
               <i class="fas fa-exchange-alt"></i>
               <p> &nbsp;
                  Jadwal Mahasiswa
               </p>
            </a>
         </li>
      </ul>
   </li>

   <li class="nav-item">
      <a href="{{ url('/absensi/dosen') }}"
         class="nav-link {{ Request::segment(1) == 'absensi' && Request::segment(2) == 'dosen' ? 'active' : '' }}">
         <i class="fas fa-calendar-check"></i>
         <p>&nbsp; Absensi Dosen</p>
      </a>
   </li>
   <li class="nav-item">
      <a href="{{url('/absensi/mahasiswa')}}"
         class="nav-link {{Request::segment(1) == 'absensi' && Request::segment(2) == 'mahasiswa' ? 'active' : ''}}">
         <i class="fas fa-calendar-check"></i>
         <p> &nbsp;
            Absensi Mahasiswa
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
