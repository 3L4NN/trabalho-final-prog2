<div class="card mb-4 shadow-sm" id="feedback-card-{{ $id }}">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">{{ $title }}</h5>
            <small class="text-muted">{{ $formattedDate() }}</small>
        </div>
        <p class="card-text">{{ $comment }}</p>
        <div class="mb-3">
            @for ($i = 0; $i < $stars()['full']; $i++)
                <i class="fas fa-star text-warning"></i>
            @endfor

            @for ($i = 0; $i < $stars()['empty']; $i++)
                <i class="far fa-star text-warning"></i>
            @endfor
        </div>
        @if($editable)
            <button class="btn btn-sm btn-outline-primary mt-3"
                    aria-label="Editar feedback"
                    data-bs-toggle="modal"
                    data-bs-target="#editFeedbackModal-{{ $id }}">
                <i class="fas fa-edit me-1"></i> Editar
            </button>
            <button class="btn btn-sm btn-outline-danger mt-3 ms-2"
                    aria-label="Excluir feedback"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteFeedbackModal-{{ $id }}">
                <i class="fas fa-trash-alt me-1"></i> Excluir
            </button>
        @endif
    </div>
</div>

@if($editable)
    <div class="modal fade" id="editFeedbackModal-{{ $id }}" tabindex="-1" aria-labelledby="editFeedbackModalLabel-{{ $id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFeedbackModalLabel-{{ $id }}">Editar Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFeedbackForm-{{ $id }}">
                        <input type="hidden" name="id" value="{{ $id }}">
                        <div class="mb-3">
                            <label for="feedbackTitle-{{ $id }}" class="form-label">Título</label>
                            <input type="text" class="form-control" id="feedbackTitle-{{ $id }}" name="title" value="{{ $title }}">
                        </div>
                        <div class="mb-3">
                            <label for="feedbackComment-{{ $id }}" class="form-label">Comentário</label>
                            <textarea class="form-control" id="feedbackComment-{{ $id }}" name="comment" rows="3">{{ $comment }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Avaliação</label>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star star-rating {{ $i <= $stars()['full'] ? 'text-warning' : 'text-secondary' }}"
                                       data-value="{{ $i }}" style="cursor: pointer; font-size: 1.5rem;"></i>
                                @endfor
                                <input type="hidden" name="stars" id="feedbackStars-{{ $id }}" value="{{ $stars()['full'] }}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary save-feedback-btn">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteFeedbackModal-{{ $id }}" tabindex="-1" aria-labelledby="deleteFeedbackModalLabel-{{ $id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFeedbackModalLabel-{{ $id }}">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja excluir este feedback?
                    <br>
                    <strong>Esta ação não pode ser desfeita.</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger confirm-delete-btn" data-id="{{ $id }}">
                        Sim, Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
