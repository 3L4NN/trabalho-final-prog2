<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .register-header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .register-body {
            padding: 30px;
            background-color: white;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }
        .btn-register {
            background-color: #0d6efd !important;
            border: none;
            padding: 10px;
            font-weight: 600;
        }
        .btn-register:hover {
            background-color: #218838;
        }
        .password-strength {
            height: 5px;
            margin-top: 5px;
            background: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="register-card">
                <div class="register-header">
                    <h3><i class="fas fa-user-plus me-2"></i>Criar Nova Conta</h3>
                </div>
                <div class="register-body">
                    <form method="POST" action="{{ route('signup') }}" id="registerForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nome Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control"
                                           id="name" name="name" value="{{ old('name') }}"
                                           placeholder="Digite seu nome" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control"
                                           id="email" name="email" value="{{ old('email') }}"
                                           placeholder="Digite seu e-mail" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control"
                                           id="password" name="password" placeholder="Digite sua senha" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength mt-2">
                                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                                </div>
                                <small class="text-muted">Mínimo de 8 caracteres</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation"
                                           placeholder="Confirme sua senha" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    Eu concordo com os <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Termos de Serviço</a>
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-register">
                                <i class="fas fa-user-plus me-2"></i>Cadastrar
                            </button>
                        </div>

                        <div class="mt-3 text-center">
                            <p>Já tem uma conta? <a href="{{ route('login') }}">Faça login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Termos de Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Termos de Compromisso para Utilização do Sistema de Feedback</p>
                <p>1. Objetivo e Aceitação dos Termos</p>
                <p>Ao utilizar este sistema, você declara ter lido, compreendido e concordado integralmente com as condições aqui estabelecidas. Caso não concorde com qualquer um dos termos, solicitamos que não utilize a plataforma.</p>
                <p>2. Definições</p>
                <p>Sistema/Plataforma: Refere-se ao software ou ambiente online disponibilizado para o registro, envio e recebimento de feedbacks.</p>
                <p>3. Responsabilidades do Usuário</p>
                <p>Ao utilizar este sistema, o Usuário compromete-se a:</p>
                <p>Fornecer Informações Verídicas: Manter seus dados cadastrais atualizados e precisos. A utilização de identidade de terceiros ou o fornecimento de informações falsas é estritamente proibida.</p>
                <p>Confidencialidade da Conta: Manter a confidencialidade de suas credenciais de acesso (login e senha), que são de uso pessoal e intransferível. O Usuário é o único responsável por todas as atividades realizadas através de sua conta.</p>
                <p>Uso Adequado: Utilizar a plataforma exclusivamente para os fins a que se destina, ou seja, a troca de feedbacks construtivos.</p>
                <p>4. Diretrizes para o Conteúdo do Feedback</p>
                <p>O Usuário concorda que todo feedback fornecido será:</p>
                <p>Respeitoso e Profissional: A comunicação deve ser pautada pelo respeito, ética e cordialidade. Não serão tolerados linguagem ofensiva, assédio, discriminação de qualquer natureza ou ataques pessoais.</p>
                <p>Construtivo e Específico: O feedback deve ser claro, objetivo e focado em comportamentos, situações ou processos, evitando generalizações e julgamentos sobre a pessoa. O objetivo é contribuir para o crescimento e a melhoria.</p>
                <p>Verídico e Baseado em Fatos: As informações compartilhadas devem ser verdadeiras e, sempre que possível, baseadas em fatos e exemplos concretos. A disseminação de boatos, calúnias ou informações falsas é vedada.</p>
                <p>É expressamente proibido publicar conteúdo que:</p>
                <p>Seja ilegal, ameaçador, difamatório, obsceno ou que viole a privacidade de terceiros.</p>
                <p>Contenha informações confidenciais da empresa ou de outros indivíduos sem a devida autorização.</p>
                <p>Promova atividades ilegais ou incite à violência.</p>
                <p>Viole direitos de propriedade intelectual (marcas, patentes, direitos autorais).</p>
                <p>5. Privacidade e Confidencialidade dos Dados</p>
                <p>A Avis compromete-se a tratar as informações inseridas no sistema com o devido sigilo e em conformidade com a legislação de proteção de dados aplicável, como a Lei Geral de Proteção de Dados (LGPD).</p>
                <p>Visibilidade: A visibilidade do feedback (se será anônimo, identificado, público para uma equipe ou privado entre duas partes) será determinada pelas configurações da plataforma, que devem ser observadas pelo Usuário no momento do envio.</p>
                <p>Uso das Informações: Os dados e feedbacks coletados poderão ser utilizados de forma anônima e agregada para a geração de relatórios e análises estatísticas, visando a melhoria contínua do ambiente e dos processos organizacionais.</p>
                <p>6. Consequências do Descumprimento</p>
                <p>A violação de qualquer um dos termos aqui descritos poderá resultar em:</p>
                <p>Advertência ao Usuário.</p>
                <p>Remoção do conteúdo inadequado.</p>
                <p>Suspensão temporária ou exclusão permanente do acesso ao Sistema.</p>
                <p>Outras medidas administrativas ou legais cabíveis, dependendo da gravidade da infração.</p>
                <p>A administração do sistema reserva-se o direito de monitorar o uso da plataforma para garantir o cumprimento destes termos, sem, no entanto, ter a obrigação de fazê-lo de forma contínua.</p>
                <p>7. Isenção de Responsabilidade</p>
                <p>A plataforma é uma ferramenta para facilitar a comunicação. As opiniões, comentários e conteúdos expressos nos feedbacks são de exclusiva responsabilidade de quem os publicou e não refletem, necessariamente, a opinião ou a posição da Avis.</p>
                <p>Ao clicar em "Aceito" ou ao iniciar o uso do sistema, o Usuário confirma sua total e irrestrita concordância com todos os termos e condições acima.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            const password = $('#password');
            const icon = $(this).find('i');

            if (password.attr('type') === 'password') {
                password.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                password.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#togglePassword2').click(function() {
            const password = $('#password_confirmation');
            const icon = $(this).find('i');

            if (password.attr('type') === 'password') {
                password.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                password.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#password').on('input', function() {
            const password = $(this).val();
            const strengthBar = $('#passwordStrengthBar');
            let strength = 0;

            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;

            if (password.match(/[a-z]/)) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

            const width = (strength / 6) * 100;
            strengthBar.css('width', width + '%');

            if (strength <= 2) {
                strengthBar.css('background-color', '#dc3545');
            } else if (strength <= 4) {
                strengthBar.css('background-color', '#ffc107');
            } else {
                strengthBar.css('background-color', '#28a745');
            }
        });
    });
</script>
</body>
</html>
