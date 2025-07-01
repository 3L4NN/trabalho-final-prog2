@extends('layout.app')

@section('title', 'Dashboard - Sistema de Feedbacks')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <x-sidebar :user="auth()->user()"/>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Minhas Avaliações</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                    </div>
                </div>

                @forelse($feedbacks as $feedback)
                    <x-feedback
                        :title="$feedback->title"
                        :comment="$feedback->comment"
                        :stars="$feedback->stars"
                        :createdAt="$feedback->created_at"
                        :editable="true"
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
                alert('Erro de configuração: Token CSRF não encontrado. A página não funcionará corretamente.');
                return;
            }

            document.querySelectorAll('.save-feedback-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const button = this;
                    const modal = button.closest('.modal');
                    const form = modal.querySelector('form');
                    const formData = new FormData(form);

                    button.disabled = true;
                    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Salvando...';

                    fetch('/feedback-update', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json().then(data => ({ ok: response.ok, data })))
                        .then(({ ok, data }) => {
                            if (ok && data.success) {
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();

                                const cardToRemove = document.getElementById(`feedback-card-${feedbackId}`);
                                if (cardToRemove) {
                                    cardToRemove.style.transition = 'opacity 0.5s ease';
                                    cardToRemove.style.opacity = '0';
                                    setTimeout(() => cardToRemove.remove(), 500);
                                } else {
                                    location.reload();
                                }
                            } else {
                                alert(`Erro: ${data.message || 'Não foi possível excluir.'}`);
                            }
                        })
                        .finally(() => {
                            button.disabled = false;
                            button.innerHTML = 'Salvar Alterações';
                        });
                });
            });


            document.querySelectorAll('.confirm-delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const button = this;
                    const feedbackId = button.dataset.id;
                    const modal = button.closest('.modal');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    button.disabled = true;
                    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Excluindo...';

                    const formData = new FormData();
                    formData.append('id', feedbackId);

                    fetch('/feedback-delete', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json().then(data => ({ ok: response.ok, data })))
                        .then(({ ok, data }) => {
                            if (ok && data.success) {
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();

                                const cardToRemove = document.querySelector(`#deleteFeedbackModal-${feedbackId}`).previousElementSibling;
                                if(cardToRemove) {
                                    cardToRemove.style.transition = 'opacity 0.5s ease';
                                    cardToRemove.style.opacity = '0';
                                    setTimeout(() => cardToRemove.remove(), 500);
                                } else {
                                    location.reload();
                                }
                            } else {
                                alert(`Erro: ${data.message || 'Não foi possível excluir.'}`);
                            }
                        })
                        .finally(() => {
                            button.disabled = false;
                            button.innerHTML = 'Sim, Excluir';
                        });
                });
            });

            document.body.addEventListener('click', function(e) {
                if (e.target.classList.contains('star-rating')) {
                    const star = e.target;
                    const modal = star.closest('.modal');
                    if (!modal) return;

                    const value = star.getAttribute('data-value');
                    const starsInput = modal.querySelector('input[name="stars"]');
                    starsInput.value = value;

                    modal.querySelectorAll('.star-rating').forEach(s => {
                        s.classList.toggle('text-warning', s.getAttribute('data-value') <= value);
                        s.classList.toggle('text-secondary', s.getAttribute('data-value') > value);
                    });
                }
            });
        });
    </script>
@endsection
