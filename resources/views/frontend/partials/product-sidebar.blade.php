 <!-- partial:partials/_sidebar.html -->
 <nav class="product-sidebar sidebar-offcanvas" id="product-sidebar">
     <ul class="nav">
         <li class="nav-item">
             <!-- @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
             <a href="#main-{{ $parent->id }}" class="list-group-item list-group-item-action" data-toggle="collapse">
                 <img class="parent-img" src="{{ asset('images/categories/'.$parent->image) }}" alt="">
                 {{ $parent->name }}
             </a>
             @endforeach -->
             @php $i = 0 @endphp
             @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)

             <a class="nav-link" data-toggle="collapse" href="#{{ $parent->id }}" aria-expanded="false"
                 aria-controls="general-pages">
                 <img class="parent-img" src="{{ asset('images/categories/'.$parent->image) }}" alt=""><span
                     class="sidebar-menu-title">{{ $parent->name }}</span>

             </a>
             @endforeach
         </li>
     </ul>
 </nav>
 <!-- partial -->
