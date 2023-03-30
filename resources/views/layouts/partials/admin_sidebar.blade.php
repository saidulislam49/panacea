<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('home') }}">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}">
                        <i class="fe-list"></i>
                        <span> Category </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('book_shop.index') }}">
                        <i class="fe-book"></i>
                        <span> Book Shop </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('options.index') }}">
                        <i class="fe-settings"></i>
                        <span> Options </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('writer.index') }}">
                        <i class="fas fa-user-edit "></i>
                        <span> Writer </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-box"></i>
                        <span> Products </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('product.index') }}">Product List</a></li>
                        <li><a href="{{ route('product.create') }}">Add Product</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-book-reader"></i>
                        <span> Posts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('posts.index') }}">All Posts</a></li>
                        <li><a href="{{ route('posts.create') }}">Create New Post</a></li>
                        <li><a href="{{ route('post-categories.index') }}">Categories</a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
