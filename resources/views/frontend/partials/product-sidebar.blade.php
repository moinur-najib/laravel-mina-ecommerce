 <!-- partial:partials/_sidebar.html -->
 <!-- <a class="top-bar">
     <i class="fa fa-bars" style="visibility: visible;"></i>
 </a> -->

 <nav class="sidebar sidebar-offcanvas mb-0" id="sidebar">

     <li class="nav-item">
         @php $i = 0 @endphp

         @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
         <div id="product-sidebar-{{ $parent->id }}">

             <a href="#main-{{ $parent->id }}" class="nav-link" data-toggle="collapse">
                 <img class="parent-img" src="{{ asset('images/categories/'.$parent->image) }}" alt="">
                 <span style="color: #fff;">
                     {{ $parent->name }}
                 </span>
                 <span class="fa fa-caret-down product-sidebar-icons category-{{ $parent->id }}"></span>
             </a>
         </div>
         @endforeach

     </li>

 </nav>

 <!-- 
 <nav class="product-sidebar sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             @php $i = 0 @endphp
             @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
             <div id="product-sidebar-{{ $parent->id }}">
                 <a class="nav-link" id="parent-category" data-toggle="collapse" href="#main-{{ $parent->id }}"
                     aria-expanded="false" aria-controls="main-{{ $parent->id }}">
                     <div class="sidebar-product-parent-card">
                         <img class="parent-img" src="{{ asset('images/categories/'.$parent->image) }}"
                             alt=" {{ $parent->name }} ">
                         <p class="sidebar-menu-title d-inline">{{ $parent->name }}
                             <span class="fa fa-caret-down product-sidebar-icons category-{{ $parent->id }} "></span>
                         </p>
                     </div>
                 </a>
                 <div class="collapse
               @if (Route::is('categories.show'))
                @if (App\Models\Category::ParentOrNotCategory($parent->id, $category->id))
                    active
                @endif
               @endif
               " id="main-{{ $parent->id }}">

                     <ul class="nav flex-column sub-menu">
                         @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get()
                         as
                         $child)
                         <a href="{{ route('categories.show', $child->id) }}" class="nav-link d-inline
                        @if (Route::is('categories.show'))
                            @if ($child->id == $category->id) 
                                active
                            @endif
                        @endif">
                             <div class="sidebar-product-child-card">
                                 <img class="child-img d-inline" src="{{ asset('images/categories/'.$child->image) }}">
                                 <span class="nav-item child-title d-inline"> {{ $child->name }}
                                 </span>
                             </div>

                         </a>

                         @endforeach
                     </ul>
                 </div>
             </div>
             @endforeach
         </li>
     </ul>
 </nav> -->

 @section('scripts')
 <script>
     $("#product-sidebar-1").on("click", function () {
         $(".category-1").toggleClass("fa-rotate-180")
     });

     $("#product-sidebar-2").on("click", function () {
         $(".category-2").addClass("fa-rotate-180")
     });

     $("#product-sidebar-3").on("click", function () {
         $(".category-3").addClass("fa-rotate-180")
     });

     $("#product-sidebar-4").on("click", function () {
         $(".category-4").addClass("fa-rotate-180")
     });

     $("#product-sidebar-5").on("click", function () {
         $(".category-5").addClass("fa-rotate-180")
     });

     $("#product-sidebar-6").on("click", function () {
         $(".category-6").addClass("fa-rotate-180")
     });

     $("#product-sidebar-7").on("click", function () {
         $(".category-7").addClass("fa-rotate-180")
     });

     $("#product-sidebar-7").on("click", function () {
         $(".category-7").addClass("fa-rotate-180")
     });

     $("#product-sidebar-8").on("click", function () {
         $(".category-8").addClass("fa-rotate-180")
     });

     $("#product-sidebar-9").on("click", function () {
         $(".category-9").addClass("fa-rotate-180")
     });

     $("#product-sidebar-10").on("click", function () {
         $(".category-10").addClass("fa-rotate-180")
     });

 </script>
 @endsection
 <!--partial-->
