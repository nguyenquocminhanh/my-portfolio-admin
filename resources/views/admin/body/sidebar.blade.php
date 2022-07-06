<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ url('/dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Data</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-info"></i>
                        <span>About</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('about.edit') }}">About Me</a></li>
                        <li><a href="{{ route('highlight.all') }}">Highlight</a></li>
                        <li><a href="{{ route('skill.all') }}">Skill</a></li>
                        <li><a href="{{ route('programming_language.all') }}">Programming Language</a></li>
                        <li><a href="{{ route('education.all') }}">Education</a></li>
                        <li><a href="{{ route('award.all') }}">Award</a></li>
                        <li><a href="{{ route('experience.all') }}">Experience</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('testimonial.all') }}" class=" waves-effect">
                        <i class="ri-discuss-line"></i>
                        <span>Testimonial</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-code-box-line"></i>
                        <span>Project</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('project.all') }}">All Project</a></li>
                        <li><a href="{{ route('project.category.all') }}">Project Category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-quill-pen-line"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('blog.all') }}">All Blog</a></li>
                        <li><a href="{{ route('blog.category.all') }}">Blog Category</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ route('contact.edit') }}" class=" waves-effect">
                        <i class="ri-contacts-book-line"></i>
                        <span>Contact Info</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('comment.all') }}" class=" waves-effect">
                        <i class="fas fa-comments"></i>
                        <span>Comment</span>
                    </a>
                </li>

                <li class="menu-title">Pages</li>

                <li>
                    <a href="{{ route('home.page.edit') }}" class=" waves-effect">
                        <i class="fas fa-home"></i>
                        <span>Home Page</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('about.page.edit') }}" class=" waves-effect">
                        <i class="fas fa-graduation-cap"></i>
                        <span>About Page</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('testimonial.page.edit') }}" class=" waves-effect">
                        <i class="ri-feedback-line"></i>
                        <span>Testimonial Page</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('project.page.edit') }}" class=" waves-effect">
                        <i class="fab fa-medapps"></i>
                        <span>Project Page</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('blog.page.edit') }}" class=" waves-effect">
                        <i class="ri-newspaper-line"></i>
                        <span>Blog Page</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact.page.edit') }}" class="waves-effect">
                        <i class="fas fa-phone"></i>
                        <span>Contact Page</span>
                    </a>
                </li>

                <li class="menu-title">Messages</li>

                <li>
                    <a href="{{ route('message.all') }}" class=" waves-effect">
                        <i class="fas fa-envelope-open-text"></i>
                        <span>Contact Message</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('hire.all') }}" class=" waves-effect">
                        <i class="ri-briefcase-line"></i>
                        <span>Hire Requests</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>