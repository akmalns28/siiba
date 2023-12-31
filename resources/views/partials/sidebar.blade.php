<!-- sidebar       -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper mb-3">
        <div class="sidebar-brand">
            <a href="index.html">SIIBA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Request::is('home*') ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                        style="
                        margin-left : 4px;
                        margin-right : 20px;
                        ">
                        <path fill="currentColor"
                            d="M20 10a1 1 0 1 0-2 0h2ZM6 10a1 1 0 0 0-2 0h2Zm14.293 2.707a1 1 0 0 0 1.414-1.414l-1.414 1.414ZM12 3l.707-.707a1 1 0 0 0-1.414 0L12 3Zm-9.707 8.293a1 1 0 1 0 1.414 1.414l-1.414-1.414ZM7 22h10v-2H7v2Zm13-3v-9h-2v9h2ZM6 19v-9H4v9h2Zm15.707-7.707l-9-9l-1.414 1.414l9 9l1.414-1.414Zm-10.414-9l-9 9l1.414 1.414l9-9l-1.414-1.414ZM17 22a3 3 0 0 0 3-3h-2a1 1 0 0 1-1 1v2ZM7 20a1 1 0 0 1-1-1H4a3 3 0 0 0 3 3v-2Z" />
                    </svg>
                    <span>Home</span>
                </a>
            </li>
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 36 36"
                        style="
                    margin-left : 4px;
                    margin-right : 20px;
                    ">
                        <path fill="currentColor" d="m25.18 12.32l-5.91 5.81a3 3 0 1 0 1.41 1.42l5.92-5.81Z"
                            class="clr-i-outline clr-i-outline-path-1" />
                        <path fill="currentColor"
                            d="M18 4.25A16.49 16.49 0 0 0 5.4 31.4l.3.35h24.6l.3-.35A16.49 16.49 0 0 0 18 4.25Zm11.34 25.5H6.66a14.43 14.43 0 0 1-3.11-7.84H7v-2H3.55A14.41 14.41 0 0 1 7 11.29l2.45 2.45l1.41-1.41l-2.43-2.46A14.41 14.41 0 0 1 17 6.29v3.5h2V6.3a14.47 14.47 0 0 1 13.4 13.61h-3.48v2h3.53a14.43 14.43 0 0 1-3.11 7.84Z"
                            class="clr-i-outline clr-i-outline-path-2" />
                        <path fill="none" d="M0 0h36v36H0z" />
                    </svg> <span>Dashboard</span>
                </a>
            </li>
            @if (Auth::check() && Auth::user()->hak_akses_id == '1')
                <li class="menu-header ">Data Master</li>
                <li
                    class="dropdown {{ Request::is('kategori*', 'hak-akses*', 'ruangan*', 'satuan*', 'hak-akses*', 'departemen*', 'dana*', 'supplier*', 'sub-kategori') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 48 48"
                            style="
                    margin-left : 4px;
                    margin-right : 20px;
                    ">
                            <mask id="ipSData0">
                                <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="4">
                                    <path d="M44 11v27c0 3.314-8.954 6-20 6S4 41.314 4 38V11" />
                                    <path
                                        d="M44 29c0 3.314-8.954 6-20 6S4 32.314 4 29m40-9c0 3.314-8.954 6-20 6S4 23.314 4 20" />
                                    <ellipse cx="24" cy="10" fill="#fff" rx="20"
                                        ry="6" />
                                </g>
                            </mask>
                            <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipSData0)" />
                        </svg>
                        <span>Data Master</span></a>
                    <ul class="dropdown-menu ">
                        <li class="{{ str_contains(Route::current()->getName(), 'hak-akses') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('hak-akses') }}">Hak Akses</a>
                        </li>
                        <li class="{{ request()->is('kategori') ? 'active' : '' }}">
                            <a class="nav-link " href="{{ route('kategori') }}">Kategori</a>
                        </li>
                        <li class="{{ request()->is('sub*') ? 'active' : '' }}">
                            <a class="nav-link " href="{{ route('sub-kategori') }}">Sub Kategori</a>
                        </li>
                        <li class="{{ Request::is('ruangan*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('ruangan') }}">Ruangan</a>
                        </li>
                        <li class="{{ Request::is('satuan*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('satuan') }}">Satuan</a>
                        </li>
                        <li class="{{ Request::is('departemen*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('departemen') }}">Departemen</a>
                        </li>
                        <li class="{{ Request::is('dana*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dana') }}">Dana</a>
                        </li>
                        <li class="{{ Request::is('supplier*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('supplier') }}">Supplier</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (Auth::check() &&  Auth::user()->hak_akses_id != '2')
                <li class="menu-header">Layanan</li>
                <li class="{{ request()->is('barang') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('barang') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            style="
                    margin-left : 4px;
                    margin-right : 20px;
                    ">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12 1.25c-.605 0-1.162.15-1.771.402c-.589.244-1.273.603-2.124 1.05L6.037 3.787c-1.045.548-1.88.987-2.527 1.418c-.668.447-1.184.917-1.559 1.554c-.374.635-.542 1.323-.623 2.142c-.078.795-.078 1.772-.078 3.002v.194c0 1.23 0 2.207.078 3.002c.081.82.25 1.507.623 2.142c.375.637.89 1.107 1.56 1.554c.645.431 1.481.87 2.526 1.418l2.068 1.085c.851.447 1.535.806 2.124 1.05c.61.252 1.166.402 1.771.402s1.162-.15 1.771-.402c.589-.244 1.273-.603 2.124-1.05l2.068-1.084c1.045-.549 1.88-.988 2.526-1.419c.67-.447 1.185-.917 1.56-1.554c.374-.635.542-1.323.623-2.142c.078-.795.078-1.772.078-3.002v-.194c0-1.23 0-2.207-.078-3.002c-.081-.82-.25-1.507-.623-2.142c-.375-.637-.89-1.107-1.56-1.554c-.645-.431-1.481-.87-2.526-1.418l-2.068-1.085c-.851-.447-1.535-.806-2.124-1.05c-.61-.252-1.166-.402-1.771-.402ZM8.77 4.046c.89-.467 1.514-.793 2.032-1.007c.504-.209.859-.289 1.198-.289c.34 0 .694.08 1.198.289c.518.214 1.141.54 2.031 1.007l2 1.05c1.09.571 1.855.974 2.428 1.356c.282.189.503.364.683.54l-3.331 1.665l-8.5-4.474l.262-.137Zm-1.825.958l-.174.092c-1.09.571-1.855.974-2.427 1.356a4.646 4.646 0 0 0-.683.54L12 11.162l3.357-1.68l-8.206-4.318a.749.749 0 0 1-.206-.16ZM2.938 8.307c-.05.214-.089.457-.117.74c-.07.714-.071 1.617-.071 2.894v.117c0 1.278 0 2.181.071 2.894c.069.697.2 1.148.423 1.528c.222.377.543.696 1.1 1.068c.572.382 1.337.785 2.427 1.356l2 1.05c.89.467 1.513.793 2.031 1.007c.164.068.311.122.448.165v-8.663L2.938 8.308Zm9.812 12.818c.137-.042.284-.096.448-.164c.518-.214 1.141-.54 2.031-1.007l2-1.05c1.09-.572 1.855-.974 2.428-1.356c.556-.372.877-.691 1.1-1.068c.223-.38.353-.83.422-1.528c.07-.713.071-1.616.071-2.893v-.117c0-1.278 0-2.181-.071-2.894a5.627 5.627 0 0 0-.117-.74L17.75 9.963V13a.75.75 0 0 1-1.5 0v-2.287l-3.5 1.75v8.662Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Barang</span>
                    </a>
                </li>
                <li class="{{ str_contains(Route::current()->getName(), 'masuk') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('barang-masuk') }}">
                        <svg width="42" height="42" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            style="
                    margin-left : 4px;
                    margin-right : 20px;
                    ">
                            <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                                d="M14.75 5C14.145 5 13.588 5.15 12.979 5.402C12.39 5.646 11.706 6.005 10.855 6.452L8.787 7.537C7.742 8.085 6.907 8.524 6.26 8.955C5.592 9.402 5.076 9.872 4.701 10.509C4.327 11.144 4.159 11.832 4.078 12.651C4 13.446 4 14.423 4 15.653V15.847C4 17.077 4 18.054 4.078 18.849C4.159 19.669 4.328 20.356 4.701 20.991C5.076 21.628 5.591 22.098 6.261 22.545C6.906 22.976 7.742 23.415 8.787 23.963L10.855 25.048C11.706 25.495 12.39 25.854 12.979 26.098C13.589 26.35 14.145 26.5 14.75 26.5C15.355 26.5 15.912 26.35 16.521 26.098C17.11 25.854 17.794 25.495 18.645 25.048L20.713 23.964C22 24.876 18.7649 21.422 19.4109 20.991C19.75 17.5 21.125 17.8016 21.5 17.1646C21.874 16.5296 22.407 16.5 25 16.5C26.118 16.5 25.5 17.077 25.5 15.847V15.653C25.5 14.423 25.5 13.446 25.422 12.651C25.341 11.831 25.172 11.144 24.799 10.509C24.424 9.872 23.909 9.402 23.239 8.955C22.594 8.524 21.758 8.085 20.713 7.537L18.645 6.452C17.794 6.005 17.11 5.646 16.521 5.402C15.911 5.15 15.355 5 14.75 5ZM11.52 7.796C12.41 7.329 13.034 7.003 13.552 6.789C14.056 6.58 14.411 6.5 14.75 6.5C15.09 6.5 15.444 6.58 15.948 6.789C16.466 7.003 17.089 7.329 17.979 7.796L19.979 8.846C21.069 9.417 21.834 9.82 22.407 10.202C22.689 10.391 22.91 10.566 23.09 10.742L19.759 12.407L11.259 7.933L11.52 7.796ZM9.695 8.754L9.521 8.846C8.431 9.417 7.666 9.82 7.094 10.202C6.84993 10.3602 6.62126 10.541 6.411 10.742L14.75 14.912L18.107 13.232L9.901 8.914C9.8235 8.87313 9.75378 8.81897 9.695 8.754ZM5.688 12.057C5.638 12.271 5.599 12.514 5.571 12.797C5.501 13.511 5.5 14.414 5.5 15.691V15.808C5.5 17.086 5.5 17.989 5.571 18.702C5.64 19.399 5.771 19.85 5.994 20.23C6.216 20.607 6.537 20.926 7.094 21.298C7.666 21.68 8.431 22.083 9.521 22.654L11.521 23.704C12.411 24.171 13.034 24.497 13.552 24.711C13.716 24.779 13.863 24.833 14 24.876V16.213L5.688 12.057ZM15.5 24.875C15.637 24.833 15.784 24.779 15.948 24.711C16.466 24.497 17.089 24.171 17.979 23.704L19.979 22.654C18.5 20 20.14 17.882 20.713 17.5C21.269 17.128 21.6449 17.2419 22.407 16.75C23.239 16.213 23.09 16.213 24 16.213C24.07 15.5 24 17.086 24 15.809V15.692C24 14.414 24 13.511 23.929 12.798C23.9065 12.549 23.8674 12.3018 23.812 12.058L20.5 13.713V16.75C20.5 16.9489 20.421 17.1397 20.2803 17.2803C20.1397 17.421 19.9489 17.5 19.75 17.5C19.5511 17.5 19.3603 17.421 19.2197 17.2803C19.079 17.1397 19 16.9489 19 16.75V14.463L15.5 16.213V24.875Z"
                                fill="#868E96" />
                            <path fill="currentColor"
                                d="M27 21C27 21.0955 26.9621 21.187 26.8946 21.2546C26.827 21.3221 26.7355 21.36 26.64 21.36H24.36V23.64C24.36 23.7355 24.3221 23.827 24.2546 23.8946C24.187 23.9621 24.0955 24 24 24C23.9045 24 23.813 23.9621 23.7454 23.8946C23.6779 23.827 23.64 23.7355 23.64 23.64V21.36H21.36C21.2645 21.36 21.173 21.3221 21.1054 21.2546C21.0379 21.187 21 21.0955 21 21C21 20.9045 21.0379 20.813 21.1054 20.7454C21.173 20.6779 21.2645 20.64 21.36 20.64H23.64V18.36C23.64 18.2645 23.6779 18.173 23.7454 18.1054C23.813 18.0379 23.9045 18 24 18C24.0955 18 24.187 18.0379 24.2546 18.1054C24.3221 18.173 24.36 18.2645 24.36 18.36V20.64H26.64C26.7355 20.64 26.827 20.6779 26.8946 20.7454C26.9621 20.813 27 20.9045 27 21Z"
                                fill="#868E96" />
                            <circle cx="24" cy="21" r="4.5" stroke="#868E96" />
                        </svg>
                        <span>Barang Masuk</span>
                    </a>
                </li>
                <li class="dropdown {{ Request::is('peminjaman*', 'riwayat-peminjaman*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            style="
                    margin-left : 4px;
                    margin-right : 20px;
                    ">
                            <path fill="currentColor" d="M6.61538 29L2 34L6.61539 39M2.64103 34L12 34"
                                stroke="#868E96" stroke-linecap="round" stroke-linejoin="round" />
                            <path fill="currentColor" d="M34.3846 2L39 7L34.3846 12M38.359 7L29 7" stroke="#868E96"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                                d="M21 9C20.3247 9 19.7029 9.16744 19.0231 9.44874C18.3656 9.72112 17.602 10.1219 16.6521 10.6208L14.3436 11.832C13.1771 12.4437 12.245 12.9338 11.5228 13.4149C10.7771 13.9139 10.2011 14.4385 9.78251 15.1496C9.36502 15.8584 9.17749 16.6264 9.08707 17.5407C9 18.4281 9 19.5187 9 20.8917V21.1083C9 22.4813 9 23.5719 9.08707 24.4593C9.17749 25.3747 9.36614 26.1416 9.78251 26.8504C10.2011 27.5615 10.776 28.0861 11.5239 28.5851C12.2439 29.0662 13.1771 29.5563 14.3436 30.168L16.6521 31.3792C17.602 31.8781 18.3656 32.2789 19.0231 32.5513C19.704 32.8326 20.3247 33 21 33C21.6753 33 22.2971 32.8326 22.9769 32.5513C23.6344 32.2789 24.398 31.8781 25.3479 31.3792L27.6564 30.1691C28.8229 29.5563 29.755 29.0662 30.4761 28.5851C31.224 28.0861 31.7989 27.5615 32.2175 26.8504C32.635 26.1416 32.8225 25.3736 32.9129 24.4593C33 23.5719 33 22.4813 33 21.1083V20.8917C33 19.5187 33 18.4281 32.9129 17.5407C32.8225 16.6253 32.6339 15.8584 32.2175 15.1496C31.7989 14.4385 31.224 13.9139 30.4761 13.4149C29.7561 12.9338 28.8229 12.4437 27.6564 11.832L25.3479 10.6208C24.398 10.1219 23.6344 9.72112 22.9769 9.44874C22.296 9.16744 21.6753 9 21 9ZM17.3944 12.1211C18.3879 11.5998 19.0845 11.2359 19.6627 10.997C20.2253 10.7637 20.6216 10.6744 21 10.6744C21.3795 10.6744 21.7747 10.7637 22.3373 10.997C22.9155 11.2359 23.611 11.5998 24.6045 12.1211L26.837 13.2932C28.0538 13.9306 28.9077 14.3805 29.5473 14.8069C29.8621 15.0179 30.1088 15.2132 30.3098 15.4097L26.5914 17.2683L17.1031 12.274L17.3944 12.1211ZM15.3572 13.1905L15.163 13.2932C13.9462 13.9306 13.0923 14.3805 12.4538 14.8069C12.1813 14.9835 11.9261 15.1853 11.6913 15.4097L21 20.0646L24.7474 18.1892L15.5872 13.3691C15.5007 13.3235 15.4228 13.263 15.3572 13.1905ZM10.8843 16.8776C10.8285 17.1165 10.7849 17.3877 10.7537 17.7036C10.6755 18.5007 10.6744 19.5087 10.6744 20.9341V21.0647C10.6744 22.4913 10.6744 23.4993 10.7537 24.2953C10.8307 25.0733 10.9769 25.5767 11.2259 26.0009C11.4737 26.4218 11.832 26.7779 12.4538 27.1931C13.0923 27.6195 13.9462 28.0694 15.163 28.7068L17.3955 29.8789C18.389 30.4002 19.0845 30.7641 19.6627 31.003C19.8458 31.0789 20.0099 31.1392 20.1628 31.1872V21.5168L10.8843 16.8776ZM21.8372 31.186C21.9901 31.1392 22.1542 31.0789 22.3373 31.003C22.9155 30.7641 23.611 30.4002 24.6045 29.8789L26.837 28.7068C28.0538 28.0683 28.9077 27.6195 29.5473 27.1931C30.168 26.7779 30.5263 26.4218 30.7753 26.0009C31.0242 25.5767 31.1693 25.0744 31.2463 24.2953C31.3245 23.4993 31.3256 22.4913 31.3256 21.0659V20.9353C31.3256 19.5087 31.3256 18.5007 31.2463 17.7047C31.2212 17.4268 31.1776 17.1508 31.1157 16.8787L27.4186 18.7261V22.1163C27.4186 22.3383 27.3304 22.5513 27.1734 22.7083C27.0164 22.8653 26.8034 22.9535 26.5814 22.9535C26.3594 22.9535 26.1464 22.8653 25.9894 22.7083C25.8324 22.5513 25.7442 22.3383 25.7442 22.1163V19.5633L21.8372 21.5168V31.186Z"
                                fill="#868E96" />
                        </svg>
                        <span>Peminjaman</span></a>
                    <ul class="dropdown-menu ">
                        <li class="{{ request()->is('peminjaman') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('peminjaman') }}">Peminjaman</a>
                        </li>
                        <li class="{{ str_contains(Route::current()->getName(), 'riwayat') ? 'active' : '' }}">
                            <a class="nav-link " href="{{ route('riwayat-peminjaman') }}">Riwayat Peminjaman</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ str_contains(Route::current()->getName(), 'lokasi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('lokasi') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            style="
                    margin-left : 4px;
                    margin-right : 20px;
                    ">
                            <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2">
                                <path d="M13 9a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z" />
                                <path
                                    d="M17.5 9.5c0 3.038-2 6.5-5.5 10.5c-3.5-4-5.5-7.462-5.5-10.5a5.5 5.5 0 1 1 11 0Z" />
                            </g>
                        </svg>
                        <span>Lokasi</span>
                    </a>
                </li>
                <div class="dropdown-divider"> </div>
            @endif
            @if (Auth::check() && Auth::user()->hak_akses_id == '1')
                <li class="{{ str_contains(Route::current()->getName(), 'user') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            style="
                    margin-left : 4px;
                    margin-right : 20px;
                    ">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12 1.25a4.75 4.75 0 1 0 0 9.5a4.75 4.75 0 0 0 0-9.5ZM8.75 6a3.25 3.25 0 1 1 6.5 0a3.25 3.25 0 0 1-6.5 0ZM12 12.25c-2.313 0-4.445.526-6.024 1.414C4.42 14.54 3.25 15.866 3.25 17.5v.102c-.001 1.162-.002 2.62 1.277 3.662c.629.512 1.51.877 2.7 1.117c1.192.242 2.747.369 4.773.369s3.58-.127 4.774-.369c1.19-.24 2.07-.605 2.7-1.117c1.279-1.042 1.277-2.5 1.276-3.662V17.5c0-1.634-1.17-2.96-2.725-3.836c-1.58-.888-3.711-1.414-6.025-1.414ZM4.75 17.5c0-.851.622-1.775 1.961-2.528c1.316-.74 3.184-1.222 5.29-1.222c2.104 0 3.972.482 5.288 1.222c1.34.753 1.961 1.677 1.961 2.528c0 1.308-.04 2.044-.724 2.6c-.37.302-.99.597-2.05.811c-1.057.214-2.502.339-4.476.339c-1.974 0-3.42-.125-4.476-.339c-1.06-.214-1.68-.509-2.05-.81c-.684-.557-.724-1.293-.724-2.601Z"
                                clip-rule="evenodd" />
                        </svg> <span>User</span>
                    </a>
                </li>
            @endif
            <li class="{{ str_contains(Route::current()->getName(), 'laporan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/laporan') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                        style="
                margin-left : 4px;
                margin-right : 20px;
                ">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M4.25 5A2.75 2.75 0 0 1 7 2.25h7.987a1.75 1.75 0 0 1 1.421.73l3.014 4.197c.213.298.328.655.328 1.02V19A2.75 2.75 0 0 1 17 21.75H7A2.75 2.75 0 0 1 4.25 19V5ZM7 3.75c-.69 0-1.25.56-1.25 1.25v14c0 .69.56 1.25 1.25 1.25h10c.69 0 1.25-.56 1.25-1.25V8.897H15a.75.75 0 0 1-.75-.75V3.75H7Z"
                            clip-rule="evenodd" />
                    </svg><span>Laporan</span>
                </a>
            </li>
        </ul>
    </aside>

</div>
