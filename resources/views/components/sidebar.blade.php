@props(['user'])
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="position-sticky pt-3">
        <div class="text-center mb-4">
            <div class="sidebar-user">
                <h6 class="text-white mb-1">{{ $user->name }}</h6></div>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('user.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('user.new.feedback') }}">
                    <i class="fas fa-plus-circle me-2"></i>Novo Feedback
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('user.owner')}}">
                    <i class="fas fa-list me-2"></i>Meus Feedbacks
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 56px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        overflow-y: auto;
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #adb5bd;
        padding: 0.75rem 1rem;
        border-left: 4px solid transparent;
    }

    .sidebar .nav-link:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar .nav-link.active {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.2);
        border-left: 4px solid #0d6efd;
    }

    .sidebar .nav-link i {
        margin-right: 4px;
        color: #6c757d;
    }

    .sidebar .nav-link.active i,
    .sidebar .nav-link:hover i {
        color: inherit;
    }

    .sidebar-user {
        padding: 0 1rem;
    }

    .sidebar-user .avatar img {
        border: 3px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-heading {
        font-size: 0.75rem;
        text-transform: uppercase;
    }
</style>
