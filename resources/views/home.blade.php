@extends('layouts.app')

@section('content')
<div class="container" id="koImagens">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    
        <div class="col-md-12">
            <h1>Imagens</h1>
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
                <label>Upload</label>
                <input type="file" class="upload" data-bind="event: {'change': function() { fileSelected($element); }}" multiple>
            </div>
        </div>
        
        <ul data-bind="foreach: imagens, sortableList: imagens, options: {ordenar: ordenar}" id="sortable">
            <li style="float: left" class="col-md-3 center-block mB10">
                <div>
                    <button type="button" class="btn btn-default btn-circle btn-lg pull-left" data-bind="click: deletar"><i class="glyphicon glyphicon-trash"></i></button>
                </div>
                <img data-bind="attr: {src: imagem}" alt="..." height="205">
            </li>
        </ul>
    </div>
</div>
@endsection

@section('custom_scripts')

    <script type="text/javascript">
        
        var url_salvar = "{{ route('galeria.salvar') }}";
        var url_ordenar = "{{ route('galeria.ordenar') }}";
        var url_excluir = "{{ route('galeria.excluir') }}";
        var data =  "{{ json_encode($model) }}";
        
        function Galeria(id, imagem, posicao) {
            var self = this;
            
            self.id = ko.observable(id);
            self.imagem = ko.observable(imagem);
            self.posicao = ko.observable(posicao);
            
            // deletar registro
            self.deletar = function(item) {

                confirmModal.show(
                    'Tem certeza que deseja remover a imagem ?',
                    function() {            

                        var data = {
                            id : item.id()
                        };

                        var excluirCallback = function(response) {
                            if(!response.status) {
                                globalMsgVm.erros([response.mensagem]);

                            } else { 
                                viewModel.imagens.remove(item);
                                globalMsgVm.showSuccessMessage(response.mensagem);
                            }
                        };
                        viewModelComum.doPost(url_excluir, data, excluirCallback);
                    }
                );
            };
        }
        
        function ViewModel() {
            var self = this;
            
            self.imagens = ko.observableArray();
            
            self.setData = function(model) {

                self.imagens(ko.utils.arrayMap(model.imagens, function(g) {
                    return new Galeria(g.img_id, g.img_imagem, g.img_posicao);
                }));

            }
            
            self.fileSelected = function(el) {
                
                if (el) {
                    
                    var counter = -1,
                        file,
                        formData = new FormData(),
                        i = 0;
                    while ( file = el.files[ ++counter ] ) {
                        
                        if(file.size > 10 * 1024 * 1024) {
                            globalMsgVm.erros(['Arquivo grande demais.']);

                        } else {
                            var fileNamePieces = file.name.split('.');
                            var extensao = fileNamePieces[fileNamePieces.length - 1];

                            if (extensao != 'jpg' && extensao != 'png' && extensao != 'jpeg') {
                                globalMsgVm.erros(['Tipo de arquivo inválido.']);
                                return;
                            }
                            
                            formData.append('imagens['+i+']', file);
                            i++
                        }
                    }
                }                    
                
                self.enviarArquivo(formData);
            }
            
            self.enviarArquivo = function(formData) {

                var callback = function(response) {

                    if (!response.status) {
                        globalMsgVm.erros(response.mensagem)
                    } else {
                        globalMsgVm.showSuccessMessage([response.mensagem]);
                        self.setData(response);
                    }
                };

                viewModelComum.doPostImage(url_salvar, formData, callback)
            };
            
            self.ordenar = function() {
                    
                var data =  {
                    imagens: ko.utils.arrayMap(self.imagens(), function(item, i) {
                        return {id: item.id(), position: i};
                    })
                };

                var callback = function(response) {

                    if (!response.status) {
                        globalMsgVm.erros(response.mensagem)
                    } else {
                        globalMsgVm.showSuccessMessage(response.mensagem);
                    }
                };

                viewModelComum.doPost(url_ordenar, data, callback)
            };
            
        }
    
        var viewModel;
        $(document).ready(function () {
            viewModel = new ViewModel();
            viewModel.setData(data);
            ko.applyBindings(viewModel, document.getElementById('koImagens'));
            
        });
        
    </script>

@endsection
