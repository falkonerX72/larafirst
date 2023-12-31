<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Easy<span>Admin</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Mainss</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">RealEstate</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Property Type </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.type') }}" class="nav-link">All Type</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Add Type</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Property State </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="state">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.state') }}" class="nav-link">All state</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Add state</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#amenitie" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Amenitie </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="amenitie">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.amenitie') }}" class="nav-link">All Amenitie</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.amenitie') }}" class="nav-link">Add Amenitie</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">property </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="property">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.property') }}" class="nav-link">All property</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.property') }}" class="nav-link">Add property</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.package.history') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">package History</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.property.message') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">property message</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.blog.comment') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Blog comment</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('smtp.setting') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">smtp setting</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('site.setting') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">site setting</span>
                </a>
            </li>
            <li class="nav-item nav-category">User All Function</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button"
                    aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">manage Agent</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.agent') }}" class="nav-link">All Agent </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/alerts.html" class="nav-link">Add Agent</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#blogcategory" role="button"
                    aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Blog category</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="blogcategory">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.blog.category') }}" class="nav-link">All blog </a>
                        </li>


                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#post" role="button" aria-expanded="false"
                    aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Blog post</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="post">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.post') }}" class="nav-link">All post </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.blog.category') }}" class="nav-link">Add post </a>
                        </li>


                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#testimonials" role="button"
                    aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">testmionials manage </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="testimonials">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.testimonial') }}" class="nav-link">all testimonials</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Add testimonials</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button"
                    aria-expanded="false" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Advanced UI</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">role and permissions</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#roles" role="button" aria-expanded="false"
                    aria-controls="roles">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">role and permissions</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="roles">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.permission') }}" class="nav-link">all persmisioss</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.roles') }}" class="nav-link">All Roles</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.roles.permission') }}" class="nav-link">Assign Roles</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.roles.permission') }}" class="nav-link">All roles perimissions</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button" aria-expanded="false"
                    aria-controls="admin">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Manage Admin User</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="admin">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.admin') }}" class="nav-link">All Admin</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.admin') }}" class="nav-link">Add Admin </a>
                        </li>
                    </ul>
                </div>
            </li>







            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="#" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
