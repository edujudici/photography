@extends('layouts.app')

@section('content')
<div class="container" id="koEmpresas">
    
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline">
                 <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Cadastrar Empresa">
                </div>
                
                <button type="submit" class="btn btn-default">Cadastrar</button>
            </form>
        </div>    
    </div>

    <div class="row" style="margin-top: 50px">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Token</th>
                        <th>Fotos</th>
                        <th>Data de Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Empresa de Teste 1</th>
                        <td>abcdefghijklmn12</td>
                        <td>25</td>
                        <td>30/04/2017 08:00:00</td>
                    </tr>
                    <tr>
                        <th>Empresa de Teste 2</th>
                        <td>abcdefghijklmn12</td>
                        <td>25</td>
                        <td>30/04/2017 08:00:00</td>
                    </tr>
                    <tr>
                        <th>Empresa de Teste 3</th>
                        <td>abcdefghijklmn12</td>
                        <td>25</td>
                        <td>30/04/2017 08:00:00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('custom_scripts')

    <script type="text/javascript">        
        
        var data =  "{{ json_encode($model) }}";       
        
        function ViewModel() {
            var self = this;
            
            self.empresas = ko.observableArray();
            
            self.setData = function(model) {

                

            }
        }
    
        var viewModel;
        $(document).ready(function () {
            viewModel = new ViewModel();
            viewModel.setData(data);
            ko.applyBindings(viewModel, document.getElementById('koEmpresas'));
            
        });
        
    </script>

@endsection
