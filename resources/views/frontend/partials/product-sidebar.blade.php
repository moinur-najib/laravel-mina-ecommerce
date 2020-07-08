 <!-- partial:partials/_sidebar.html -->
 <nav class="product-sidebar sidebar sidebar-offcanvas" id="sidebar">
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

             <a id="product-sidebar-arrows-{{ $parent->id }}" class="nav-link" id="parent-category"
                 data-toggle="collapse" href="#main-{{ $parent->id }}" aria-expanded="false"
                 aria-controls="main-{{ $parent->id }}">
                 <img class="parent-img" src="{{ asset('images/categories/'.$parent->image) }}"
                     alt=" {{ $parent->name }} "><span class="sidebar-menu-title">{{ $parent->name }} </span>
                 <i id="change-product-sidebar-arrows-{{ $parent->id }}" class="fa fa-angle-right sidebar-arrows"
                     style="color: black; margin-right: auto;"></i>
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

                         <img class="child-img d-inline" src="{{ asset('images/categories/'.$child->image) }}">
                         <span class="nav-item child-title d-inline"> {{ $child->name }}
                         </span>
                     </a>

                     @endforeach
                 </ul>
             </div>
             @endforeach
         </li>
     </ul>
 </nav>

 @section('scripts')
 <script>
     var counter = 1;

     $("#product-sidebar-arrows-" + 1).on("click", function () {
         if ($("#change-product-sidebar-arrows-" + counter).hasClass("fa-angle-down")) {
             console.log("down");
             $("#change-product-sidebar-arrows-" + counter).removeClass('fa-angle-down');
             $("#change-product-sidebar-arrows-" + counter).addClass('fa-angle-right');
         } else {
             console.log("right");
             $("#change-product-sidebar-arrows-" + counter).removeClass('fa-angle-right');
             $("#change-product-sidebar-arrows-" + counter).addClass('fa-angle-down');
         }
     });

     $("#product-sidebar-arrows-" + 2).on("click", function () {

         if ($("#change-product-sidebar-arrows-" + 2).hasClass("fa-angle-down")) {
             console.log("down");
             $("#change-product-sidebar-arrows-" + 2).removeClass('fa-angle-down');
             $("#change-product-sidebar-arrows-" + 2).addClass('fa-angle-right');
         } else {
             console.log("right");
             $("#change-product-sidebar-arrows-" + 2).removeClass('fa-angle-right');
             $("#change-product-sidebar-arrows-" + 2).addClass('fa-angle-down');
         }
     });

     $("#product-sidebar-arrows-" + 3).on("click", function () {

         if ($("#change-product-sidebar-arrows-" + 3).hasClass("fa-angle-down")) {
             console.log("down");
             $("#change-product-sidebar-arrows-" + 3).removeClass('fa-angle-down');
             $("#change-product-sidebar-arrows-" + 3).addClass('fa-angle-right');
         } else {
             console.log("right");
             $("#change-product-sidebar-arrows-" + 3).removeClass('fa-angle-right');
             $("#change-product-sidebar-arrows-" + 3).addClass('fa-angle-down');
         }
     });

 </script>
 @endsection
 <!--partial-->
