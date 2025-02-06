<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('backend/vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo" />
            <img src="{{ asset('backend/vendors/images/deskapp-logo.svg') }}" alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="/" class="dropdown-toggle no-arrow active">
                        <span class="micon bi bi-graph-up-arrow"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                {{-- posts --}}
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Blogs</div>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-collection"></span>
                        <span class="mtext">Categories</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="/">List</a></li>
                        <li><a href="/">Add</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-tags"></span><span class="mtext">Tags</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="/">List</a></li>
                        <li><a href="/">Add</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-text"></span><span class="mtext">Posts</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="/">List</a></li>
                        <li><a href="/">Add</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-chat-text"></span>
                        <span class="mtext">Comments</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="/">List</a></li>
                        <li><a href="/">Add</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-newspaper"></span>
                        <span class="mtext">Newsletter</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="/">List</a></li>
                        <li><a href="/">Add</a></li>
                    </ul>
                </li>
                {{-- end posts --}}

                {{-- Media --}}
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Media</div>
                </li>
                <li>
                    <a href="/" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-image"></span><span class="mtext">Image</span>
                    </a>
                </li>
                {{-- End Media --}}

                {{-- user --}}
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Users</div>
                </li>
                <li>
                    <a href="/" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-ui-checks"></span><span class="mtext">Role</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-people"></span><span class="mtext">Users</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="/">List</a></li>
                        <li><a href="/">Add</a></li>
                    </ul>
                </li>
                {{-- End user --}}

                {{-- page settings --}}
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Page Settings</div>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-sliders"></span><span class="mtext">Settings</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="/">List</a></li>
                        <li><a href="/">Add</a></li>
                    </ul>
                </li>
                {{-- End page settings --}}
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
