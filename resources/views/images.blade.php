@extends('layouts.app')

@section('custom_styles')
    
    <link href="{{ asset('cropperjs-master/dist/cropper.css') }}" rel="stylesheet">

    <style>
        img {
            max-width: 100%;
        }

        .editor-container
        {
            width: 650px;
            /*height: 330px;*/
        }

        .img-preview
        {
            /*margin: 1em;*/
            display: inline-block;
            overflow: hidden;
        }

        .img-preview.large
        {
            width: 256px;
            height: 256px;
        }

        .img-preview.medium
        {
            width: 150px;
            height: 76px;
        }

        .img-preview.medium img
        {
            display: block;
            width: 150px;
            /*height: 84.375px;*/
            height: 100%;
            max-height: 85px;
        }

        .img-preview.small
        {
            width: 64px;
            height: 64px;
        }

        .thumbnail img {transform: inherit !important;}
    </style>
@endsection

@section('content')
<div id="koImages">

    <div class="row">

        <div class="col-md-5">
            {{-- <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div id="divTotal" class="panel-heading">
                            <h3 class="panel-title">Total</h3>
                        </div>
                        <div class="panel-body">
                            <h2>Rs. 100</h2>
                        </div>
                    </div>
                </div>
            </div> --}}
           
            <div class="form-group">
                <label class="btn btn-info btn-file">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Adicionar Imagens <input type="file" hidden data-bind="event: {'change': function() { fileSelected($element); }}" multiple>
                </label>
            </div>
            <div class="row">
                <div class="col-md-12">
                <!-- ko foreach: images -->
                    <div class='img-preview medium' data-bind="click: setCroppendImage, attr: {id: id}">
                        <img data-bind="attr: {src: imageURL}">
                    </div>

                    {{-- <div class="row">
                      <div class="col-md-5">
                        <div class="thumbnail" >
                            <div data-bind="click: setCroppendImage, attr: {id: id}">
                                
                          <img data-bind="attr: {src: imageURL}">
                            </div>
                          <div class="caption">
                            <h3>Thumbnail label</h3>
                            <p>...</p>
                            <p>
                                <a href="#" class="btn btn-primary" role="button">Button</a>
                                <a href="#" class="btn btn-default" role="button">Button</a>
                           </p>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                <!-- /ko -->
                </div>
            </div>

            <div class="row mt30" data-bind="visible: images().length > 0">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" data-bind="click: sendDataList">Enviar</button>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-6 pull-right">
                    <div class="panel panel-primary">
                        <div id="divTotal" class="panel-heading">
                            <h3 class="panel-title text-center">Total</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 pl0">
                                <span>Total de imagens: </span>
                                <span data-bind="text: imagesTotal"></span>
                            </div>
                            <div class="col-md-12 pl0">
                                <span>Total de cópias: </span>
                                <span data-bind="text: imagesCopy"></span>
                            </div>
                            <div class="row pull-right">
                                <h3 style="padding-right: 10px;margin-bottom: 0;margin-top: 0;">R$: <span data-bind="text: moneyTotal"></span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ko with: croppendImage --> 
            <fieldset style="margin-bottom: 30px">
                <legend>Clique em uma imagem para edição!</legend>            
                <div class="editor-container">
                    <img
                        id="image"
                        alt="Picture"                        
                        data-bind="attr: {src: imageURL},
                            cropper: {
                                valueData: imageURL,
                                btnActions: '#btnActions',
                                ratio: ratio,
                                options: options
                            }"/>
                </div>
                
                <div id="btnActions" style="margin-top: 10px; margin-bottom: 15px">
                    <div class="btn-group">
                      	<button type="button" class="btn btn-primary crop" data-method="zoom" data-option="0.1" title="Zoom In">
                          	<span class="fa fa-search-plus"></span>
                      	</button>
                      	<button type="button" class="btn btn-primary crop" data-method="zoom" data-option="-0.1" title="Zoom Out">
                              <span class="fa fa-search-minus"></span>
                      	</button>
                    </div>

        			<div class="btn-group">
          				<button type="button" class="btn btn-primary crop" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
              				<span class="fa fa-arrow-left"></span>
          				</button>
          				<button type="button" class="btn btn-primary crop" data-method="move" data-option="10" data-second-option="0" title="Move Right">
              				<span class="fa fa-arrow-right"></span>
          				</button>
          				<button type="button" class="btn btn-primary crop" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
              				<span class="fa fa-arrow-up"></span>
          				</button>
          				<button type="button" class="btn btn-primary crop" data-method="move" data-option="0" data-second-option="10" title="Move Down">
              				<span class="fa fa-arrow-down"></span>
          				</button>
        			</div>

    		        <div class="btn-group">
    		          	<button type="button" class="btn btn-primary crop" data-method="rotate" data-option="-45" title="Rotate Left">
    		              	<span class="fa fa-rotate-left"></span>
    		          	</button>
    		          	<button type="button" class="btn btn-primary crop" data-method="rotate" data-option="45" title="Rotate Right">
    		              	<span class="fa fa-rotate-right"></span>
    		          	</button>
    		        </div>

    		        <div class="btn-group">
    		          	<button type="button" class="btn btn-primary crop" data-method="scaleX" data-option="-1" title="Flip Horizontal">
    		              	<span class="fa fa-long-arrow-left"></span>
    		          	</button>
    		          	<button type="button" class="btn btn-primary crop" data-method="scaleX" data-option="1" title="Flip Horizontal">
    		              	<span class="fa fa-long-arrow-right"></span>
    		          	</button>
    		          	<button type="button" class="btn btn-primary crop" data-method="scaleY" data-option="-1" title="Flip Vertical">
    		              	<span class="fa fa-long-arrow-down"></span>
    		          	</button>
    		          	<button type="button" class="btn btn-primary crop" data-method="scaleY" data-option="1" title="Flip Vertical">
    		              	<span class="fa fa-long-arrow-up"></span>
    		          	</button>
    		        </div>

    		        <div class="btn-group">
    		          	<button type="button" class="btn btn-primary crop" data-method="disable" title="Disable">
    		              	<span class="fa fa-lock"></span>
    		          	</button>
    		          	<button type="button" class="btn btn-primary crop" data-method="enable" title="Enable">
    		              	<span class="fa fa-unlock"></span>
    		          	</button>
    		        </div>

    		        <div class="btn-group">
    		          	<button type="button" class="btn btn-primary crop" data-method="reset" title="Reset">
    		              	<span class="fa fa-refresh"></span>
    		          	</button>
        			</div>
    			</div>

                <form class="form-inline">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="radio-inline"><input type="radio" name="radDPI" value="250" data-bind="checked: dpi">Dpi 250</label>
                            <label class="radio-inline"><input type="radio" name="radDPI" value="300" data-bind="checked: dpi" checked>Dpi 300</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <input type="number" class="form-control" placeholder="Quantidade" data-bind="value: quantity">

                            <select
                                class="form-control"
                                data-bind="options: filterListBySize,
                                    {{-- optionsText: function(item) {
                                        if (item.recommend)
                                            return item.width + ' x ' + item.height
                                        else
                                            return item.width + ' x ' + item.height + ' não recomendado'
                                    }, --}}
                                    optionsText: 'description',
                                    value: sizeSelected,
                                    optionsCaption: 'Selecione o tamanho'">
                            </select>

                            <select
                                class="form-control"
                                data-bind="options: $root.printyType,
                                    optionsText: 'description',
                                    value: typeSelected,
                                    optionsCaption: 'Selecione o tipo'">
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" data-bind="click: done">Enviar</button>
                        </div>
                    </div>
                </form>
            </fieldset>
			<!-- /ko -->
		</div>
    </div>
    
</div>
@endsection

@section('custom_scripts')
    
    <script src="{{ asset('cropperjs-master/dist/cropper.js') }}"></script>
    <script src="{{ asset('cropperjs-master/dist/ko/knockout.cropper.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        
        var url_save = "{{ route('image.save') }}";

        function ImageSize(id,width,height,price) {
            var self = this;

            self.id = ko.observable(id);
            self.width = ko.observable(width);
            self.height = ko.observable(height);
            self.price = ko.observable(price);
            self.description = ko.observable();
        }

        function Image(image) {
            var self = this;

            self.id = makeid();
            self.imageURL = ko.observable(image);
            self.dpi = ko.observable('300');
            self.imgHeight = ko.observable();
            self.imgWidth = ko.observable();
            self.ratio = ko.observable(16/9);
            self.visualized = ko.observable(false);
            self.blob;
            self.quantity = ko.observable().extend({
                required: {
                    params: true,
                    message: 'O campo quantidade é obrigatório'
                }
            });
            self.sizeSelected = ko.observable().extend({
                required: {
                    params: true,
                    message: 'O campo tamanho é obrigatório'
                }
            });
            self.typeSelected = ko.observable().extend({
                required: {
                    params: true,
                    message: 'O campo tipo é obrigatório'
                }
            });

            self.erros = ko.validation.group(self);

            self.options = ko.observable({
                viewMode: 3,
                dragMode: 'move',
                autoCropArea: 1,
                restore: false,
                modal: false,
                guides: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: false,
                toggleDragModeOnDblclick: false,
                preview: '#'+self.id,
                crop: function (e) {
                    self.imgHeight(Math.round(e.detail.height));
                    self.imgWidth(Math.round(e.detail.width));
                }
            });

            self.setCroppendImage = function() {
                viewModel.croppendImage(self);
            };

            self.done = function() {

                if (self.erros().length > 0) {
                    globalMsgVm.erros(self.erros());
                    return;
                }

                self.visualized(true);
                globalMsgVm.erros([]);
                cropper.getCroppedCanvas().toBlob(function(blob){
                    self.blob = blob;
                    self.imageURL(URL.createObjectURL(blob));
                });
                viewModel.croppendImage(null);
            };

            self.convertImageInCm = function(width, height) {

                var dpi = parseInt(self.dpi()),
                    widthCm = (width/dpi)*2.54,
                    heightCm = (height/dpi)*2.54;

                return {widthCm: Math.ceil(widthCm), heightCm: Math.ceil(heightCm)}
            };

            self.filterListBySize = ko.computed(function() {
                if (self.imgWidth() && self.imgHeight()) {

                    console.log(self.imgWidth());
                    console.log(self.imgHeight());
                    var size = self.convertImageInCm(self.imgWidth(),self.imgHeight());

                    // return ko.utils.arrayFilter(viewModel.imagesSize(), function(item) {
                    //     if (size.widthCm >= item.width && size.heightCm >= item.height)
                    //         return item;
                    // });
                    return ko.utils.arrayMap(viewModel.imagesSize(), function(item) {
                        
                        if (size.widthCm >= item.width() && size.heightCm >= item.height())
                            item.description(item.width() + ' X ' + item.height());
                        
                        else
                            item.description(item.width() + ' X ' + item.height() + ' não recomendado');

                        return item;
                    });
                }
            });

            self.sizeSelectedComputed = ko.computed(function() {
                if (self.sizeSelected()) {
                    self.ratio(self.sizeSelected().width() / self.sizeSelected().height());
                }
            })
        }
        
        function ViewModel() {
            var self = this;

            self.images = ko.observableArray();
            self.croppendImage = ko.observable();            
            self.imagesSize = ko.observableArray([
            	new ImageSize(1,4, 3 ,1.50),
            	new ImageSize(2,7, 5 ,2.50),
            	new ImageSize(3,10,7 ,3.50),
            	new ImageSize(4,12,9 ,4.50),
            	new ImageSize(5,15,10,5.50),
                new ImageSize(6,16, 9,6.50),
            	new ImageSize(7,18,13,7.50),
            	new ImageSize(8,21,15,8.50),
            	new ImageSize(9,25,18,9.50),
            	new ImageSize(10,25,20,10.50),
            	new ImageSize(11,30,20,11.50),
            	new ImageSize(12,30,24,12.50),
            	new ImageSize(13,36,24,13.50),
            	new ImageSize(14,40,26,14.50),
            	new ImageSize(15,40,30,15.50),
            	new ImageSize(16,42,30,16.50),
            	new ImageSize(17,45,30,17.50),
            	new ImageSize(18,50,34,18.50),
            	new ImageSize(19,54,36,19.50),
            	new ImageSize(20,56,38,20.50)
            ]);
            self.printyType = ko.observableArray([
                {id: 1, description: 'Brilhante'},
                {id: 2, description: 'Fosco'}
            ]);

            self.fileSelected = function(el) {
                
                if (el) {
                    
                    var counter = -1,
                        file,
                        formData = new FormData(),
                        imageCounter = 0;
                    while ( file = el.files[ ++counter ] ) {
                        
                        if(file.size > 10 * 1024 * 1024) {
                            globalMsgVm.erros(['Arquivo grande demais.']);

                        } else {
                            var fileNamePieces = file.name.split('.');
                            var extension = fileNamePieces[fileNamePieces.length - 1];

                            if (extension != 'jpg' && extension != 'png' && extension != 'jpeg') {
                                globalMsgVm.erros(['Tipo de arquivo inválido.']);
                                return;
                            }
                            
                            // var reader = new FileReader();
                            // reader.onload = function(e) {
                            //     self.images.push(new Image(e.target.result));
                            // }
                            // reader.readAsDataURL(file);
                            
                            var blob = new Blob([file]),
                                url = URL.createObjectURL(blob);
                            self.images.push(new Image(url));
                            
                            imageCounter++;
                        }
                    }
                }
            };

            self.sendDataList = function() {

                var formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}'),
                    hasError = false;

                ko.utils.arrayForEach(self.images(), function(img, i) {
                    formData.append('images['+i+']', img.blob);
                    if (!img.visualized()) hasError = true;
                });

                if (hasError) {
                    globalMsgVm.erros(['Existem fotos que não foram visualizadas ainda']);
                    return;
                }

                var callback = function(response) {

                    if (!response.status) {
                        globalMsgVm.erros([response.message])
                    } else {
                        globalMsgVm.showSuccessMessage(response.message);
                        alert('tratar redicionamento');
                    }
                };

                viewModelComum.doPostImage(url_save, formData, callback);
            }

            self.getPriceById = function(id) {
                var obj = ko.utils.arrayFirst(self.imagesSize(), function(item) {
                    return id ? item.id() == id : false;
                });

                return obj ? parseFloat(obj.price()) : 0;
            }

            self.imagesTotal = ko.observable();
            self.imagesCopy = ko.observable();
            self.moneyTotal = ko.observable();
            self.totalCalculate = ko.computed(function() {
                var
                    imagesTotal = 0,
                    imagesCopy = 0,
                    moneyTotal = 0;

                if (self.images().length > 0) {
                    ko.utils.arrayForEach(self.images(), function(item) {
                        imagesTotal += 1;

                        var quantityCopy = item.quantity() ? parseInt(item.quantity()) : 0;
                        imagesCopy  += quantityCopy;
                        moneyTotal  += self.getPriceById(item.sizeSelected() ? item.sizeSelected().id() : null) * quantityCopy;
                    });
                }

                self.imagesTotal(imagesTotal);
                self.imagesCopy(imagesCopy);
                self.moneyTotal(moneyTotal);
            });
        }

        function makeid()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

            for( var i=0; i < 10; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }        
            
        var viewModel;
        $(document).ready(function () {
            viewModel = new ViewModel();
            ko.applyBindings(viewModel, document.getElementById('koImages'));
        });
        
    </script>

@endsection
