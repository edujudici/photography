@extends('layouts.app')

@section('content')
<div id="koCompanies">
    
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline">
                
                {{-- <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Cadastrar Empresa">
                </div> --}}
                
                <button type="submit" class="btn btn-default">Nova Empresa</button>
            </form>
        </div>    
    </div>

    <div class="row" style="margin-top: 30px">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Token</th>
                        <th>Fotos</th>
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
        
        var data =  {!! $model !!};
        {{--   var url_salvar = "{{ route('usuario.salvar') }}";--}}
        {{--  var url_excluir = "{{ route('usuario.excluir') }}";  --}}

        function Company(emp_id,emp_description,emp_token,created_at,editFlag) {

            var self = this;

            self.id          = emp_id;
            self.token       = ko.observable(emp_token);
            self.editFlag    = ko.observable(editFlag);
            self.description = ko.observable(emp_description).extend({
                required: { params: true, message: 'O campo Nome é obrigatório.'}
            });

            self.erros = ko.validation.group(self);

            self.delete = function(item) {
                confirmModal.show(
                    'Tem certeza que deseja remover a empresa ?',
                    function() {            

                        var data = { id : item.id()};
                        var deleteCallback = function(response) {
                            if(!response.status) {
                                globalMsgVm.erros([response.mesage]);

                            } else { 
                                viewModel.companies.remove(item);
                                globalMsgVm.showSuccessMessage(response.mesage);
                            }
                        };
                        viewModelComum.doPost(url_delete, data, deleteCallback);
                    }
                );
            };
            
            self.save = function() {
                
                if (self.erros().length > 0) {
                    globalMsgVm.erros(self.erros());
                    return;
                }
                
                var data = {
                    id:    self.id(),
                    description:  self.description()
                };

                var saveCallback = function(response) {
                    if(!response.status) {
                        globalMsgVm.erros([response.message]);
                        return;

                    } else  {
                        self.id(response.empresa.id);
                        self.token(response.empresa.token);
                        self.editFlag(false);
                        globalMsgVm.showSuccessMessage(response.message);
                    }
                };
                viewModelComum.doPost(url_save, data, saveCallback);
                
            };
            
            self.original = null;
            self.edit = function() {
                self.original = {description:description};
                self.editFlag(true);
            };
            
            self.cancelar = function() {
                if (!self.id()) {
                    viewModel.companies.remove(self);
                    return;
                }
                self.goBackData();
                self.editFlag(false);
            };
            
            self.goBackData = function() {
                self.description(self.original.description);
            };
        }

        
        function ViewModel() {
            var self = this;
            
            self.companies = ko.observableArray();
            
            self.setData = function(companies) {

                self.companies(ko.utils.arrayMap(companies, function() {
                    
                }));
            }
        }
    
        var viewModel;
        $(document).ready(function () {
            viewModel = new ViewModel();
            viewModel.setData(data);
            ko.applyBindings(viewModel, document.getElementById('koCompanies'));
            
        });
        
    </script>

@endsection
