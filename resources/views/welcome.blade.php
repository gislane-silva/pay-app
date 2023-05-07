<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pay App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <h2>Finalize seu pedido</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Seu carrinho</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Caneca</h6>
                            <small class="text-muted">Preta</small>
                        </div>
                        <span class="text-muted">R$ 20,00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Blusa</h6>
                            <small class="text-muted">Branca</small>
                        </div>
                        <span class="text-muted">R$ 50,00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>R$ 70,00</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Informações Pessoais</h4>
                <form class="needs-validation" novalidate action="{{url('finalizar-pagamento')}}" method="POST">
                @csrf
                    <input type="number" class="form-control" id="value" name="value" placeholder="" value="70" hidden>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Nome é obrigatório.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                CPF é obrigatório.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@exemplo.com" required>
                            <div class="invalid-feedback">
                                Por favor insira um e-mail válido.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone">Telefone Celular</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                            <div class="invalid-feedback">
                                Número de telefone é obrigatório.
                            </div>
                        </div>

                    </div>

                    <hr class="mb-4">
                    <h4 class="mb-3">Pagamento</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="pix" value="pix" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="pix">Pix</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="card" value="card" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="card">Cartão de Crédito</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="ticket" value="ticket" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="ticket">Boleto</label>
                        </div>
                    </div>

                    <div id="paymentCreditCard" style="display: none">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="holderName">Nome impresso no cartão</label>
                                <input type="text" class="form-control" id="holderName" name="holderName" placeholder="" disabled required>
                                <small class="text-muted">Nome igual aparece no cartão</small>
                                <div class="invalid-feedback">
                                    Nome impresso no cartão é obrigatório.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="number">Número do cartão</label>
                                <input type="text" class="form-control" id="number" name="number" placeholder="" disabled required>
                                <div class="invalid-feedback">
                                    Número do cartão é obrigatório.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="expiryMonth">Mês</label>
                                <input type="text" class="form-control" id="expiryMonth" name="expiryMonth" placeholder="05" disabled required>
                                <div class="invalid-feedback">
                                    Mês de vencimento é obrigatório.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="expiryYear">Ano</label>
                                <input type="text" class="form-control" id="expiryYear" name="expiryYear" placeholder="2023" disabled required>
                                <div class="invalid-feedback">
                                    Ano de vencimento é obrigatório.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cvv">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="" disabled required>
                                <div class="invalid-feedback">
                                    CVV é obrigatório.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="installmentCount">Número de parcelas</label>
                                <select class="form-control" id="installmentCount" name="installmentCount" disabled required>
                                    <option value="1">1x R$ 70,00</option>
                                    <option value="2">2x R$ 35,00</option>
                                    <option value="3">3x R$ 23,33</option>
                                </select>
                                <div class="invalid-feedback">
                                    Número de parcelas é obrigatório.
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">
                        <h4 class="mb-3">Endereço de cobrança</h4>

                        <div class="d-block my-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="postalCode">CEP</label>
                                    <input type="text" maxlength="8" class="form-control" id="postalCode" name="postalCode" placeholder="00000-000" disabled required>
                                    <div class="invalid-feedback">
                                        CEP é obrigatório.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="addressNumber">Número</label>
                                    <input type="text" maxlength="10" class="form-control" id="addressNumber" name="addressNumber" disabled required>
                                    <div class="invalid-feedback">
                                        Número é obrigatório.
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="addressComplement">Complemento</label>
                                    <input type="text" maxlength="100" class="form-control" id="addressComplement" name="addressComplement" disabled placeholder="Apartamento 10">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Confirmar pagamento</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2023</p>
        </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            $(document).ready(function () {
                $('input[name="paymentMethod"]').on('change', function () {
                    if ($('input[name="paymentMethod"]:checked').val() == "card") {
                        $('#paymentCreditCard').show();
                        $("#paymentCreditCard :input").removeAttr("disabled");
                    } else {
                        $('#paymentCreditCard').hide();
                        $("#paymentCreditCard :input").attr("disabled", true);
                    }
                });

                $("#cpf").mask('000.000.000-00');
                $("#phone").mask('(00) 00000-0000');
                $("#postalCode").mask('00000-000');
                $("#number").mask('0#');
                $("#addressNumber").mask('0#');
                $("#cvv").mask('000');
                $("#expiryMonth").mask('00');
                $("#expiryYear").mask('0000');
            });

            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    </body>
</html>
