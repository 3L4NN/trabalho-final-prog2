@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-plus-circle me-2"></i> Criar Novo Feedback
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.sent.feedback') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Título do Feedback</label>
                                <input type="text" class="form-control"
                                       id="title" name="title"
                                       value="{{ old('title') }}"
                                       placeholder="Descreva brevemente seu feedback"
                                       required>
                                <small class="text-muted">Seja claro e objetivo no título (máx. 100 caracteres)</small>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Comentário</label>
                                <textarea class="form-control"
                                          id="comment" name="comment"
                                          rows="5"
                                          placeholder="Descreva com detalhes seu feedback, sugestão ou problema encontrado..."
                                          required>{{ old('comment') }}</textarea>

                                <small class="text-muted">Quanto mais detalhes você fornecer, melhor podemos entender e resolver</small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Avaliação</label>
                                <div class="rating-container">
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" id="star{{ $i }}" name="stars" value="{{ $i }}"
                                                {{ old('stars') == $i ? 'checked' : '' }}>
                                            <label for="star{{ $i }}" title="{{ $i }} estrela(s)">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                    <div class="rating-description mt-2">
                                        <small id="ratingHelp" class="text-muted">
                                            @if(old('stars', 0) > 0)
                                                @switch(old('stars'))
                                                    @case(1)
                                                        Péssimo - Não gostei nada
                                                        @break
                                                    @case(2)
                                                        Ruim - Precisa melhorar muito
                                                        @break
                                                    @case(3)
                                                        Regular - Tem potencial, mas precisa de ajustes
                                                        @break
                                                    @case(4)
                                                        Bom - Gostei, mas tem pequenos problemas
                                                        @break
                                                    @case(5)
                                                        Excelente - Adorei, está perfeito!
                                                        @break
                                                @endswitch
                                            @else
                                                Selecione uma avaliação de 1 a 5 estrelas
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-times me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-1"></i> Enviar Feedback
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .rating-container {
            display: flex;
            flex-direction: column;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            color: #ddd;
            font-size: 2rem;
            padding: 0 0.2rem;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating-stars input:checked ~ label,
        .rating-stars input:hover ~ label {
            color: #ffc107;
        }

        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #ffc107;
        }

        .rating-stars input:checked + label {
            color: #ffc107;
        }

        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            border: none;
        }

        .card-header {
            font-weight: 600;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const starInputs = document.querySelectorAll('.rating-stars input');
            const ratingHelp = document.getElementById('ratingHelp');

            starInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const value = parseInt(this.value);
                    let description = '';

                    switch(value) {
                        case 5:
                            description = 'Péssimo - Não gostei nada';
                            break;
                        case 4:
                            description = 'Ruim - Precisa melhorar muito';
                            break;
                        case 3:
                            description = 'Regular - Tem potencial, mas precisa de ajustes';
                            break;
                        case 2:
                            description = 'Bom - Gostei, mas tem pequenos problemas';
                            break;
                        case 1:
                            description = 'Excelente - Adorei, está perfeito!';
                            break;
                        default:
                            description = 'Selecione uma avaliação de 1 a 5 estrelas';
                    }

                    ratingHelp.textContent = description;
                });
            });
        });
    </script>
@endpush
