   <li class="sidebar-item">
       <a href="{{ route('admin.home') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('admin.home') }}</span>
       </a>
   </li>
   <li class="sidebar-item">
       <a href="{{ route('admin.users.index') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('admin.users') }}</span>
       </a>
   </li>
   <li class="sidebar-item">
       <a href="{{ route('admin.admins.index') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('admin.admins') }}</span>
       </a>
   </li>
   <li class="sidebar-item">
       <a href="{{ route('admin.roles.index') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('admin.roles') }}</span>
       </a>
   </li>
