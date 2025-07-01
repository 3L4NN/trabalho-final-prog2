@extends('layout.app')

@section('title', 'Dashboard - Sistema de Feedbacks')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <x-sidebar :user="auth()->user()"/>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                    </div>
                </div>
                <div>
                    <p class="p">Todas as Avaliações</p>
                </div>

                @forelse($feedbacks as $feedback)
                    <x-feedback
                        :title="$feedback->title"
                        :comment="$feedback->comment"
                        :stars="$feedback->stars"
                        :createdAt="$feedback->created_at"
                        :editable="false"
                        :id="$feedback->id"
                    />
                @empty
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Nenhum feedback disponível no momento.
                    </div>
                @endforelse

            </main>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
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

        .rating {
            unicode-bidi: bidi-override;
            direction: ltr;
            font-size: 14px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
