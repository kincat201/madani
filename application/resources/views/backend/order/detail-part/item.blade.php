<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Daftar Item</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div id="add">
                <div class="row">
                    <div class="col-sm-6" style="margin-bottom: 20px;padding-left: 31px;">
                        <button class="btn btn-sm btn-success" type="button" onclick="addItem(0)">Tambah Item</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center">Produk</th>
                            <th style="text-align: center">Qty</th>
                            <th style="text-align: center">Harga</th>
                            <th style="text-align: center">Total</th>
                            <th style="text-align: center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody id="listItem"></tbody>
                        <input type="hidden" name="items" value="{{ @$model->prices }}">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div id="add">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="category">Kategori</label>
                            <div class="col-sm-12" id="category0">
                                <select name="category0" class="form-control" onchange="setProduct()">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" data-object="{{ $category }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div id="category0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="types">Produk</label>
                            <div class="col-sm-12" id="product0">
                                <select name="product0" class="form-control" onchange="setPrice()">
                                    <option value="">Pilih Produk</option>
                                </select>
                                <div id="product0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="price">Harga</label>
                            <div class="col-sm-12" id="price0">
                                <select name="price0" class="form-control">
                                    <option value="">Pilih</option>
                                </select>
                                <div id="price0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="qty">Jumlah</label>
                            <div class="col-sm-12" id="qty0">
                                <input type="text" class="form-control autonumeric" name="qty0" placeholder="Jumlah">
                                <div id="qty0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="saveItem(0)" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-default" onclick="resetItem(0)" data-dismiss="modal">Batal</button>
            </div>
        </div>

    </div>
</div>
<!-- End Modal -->


@push('customJs')
    <script type="text/javascript">
        var dataItem = {!! !empty(@$model->orderDetail) ? json_encode(@$model->orderDetail) : '[]' !!};
        var currentIndex = dataItem.length > 0 ? dataItem.length : 1;
        var priceTypes = {!! json_encode(\App\Util\Constant::PRODUCT_TYPE_PRICE_LIST) !!};

        dataItem.forEach(function (data,index) {
            var no = (index+1);
            currentIndex++;
            var row = '<tr id="ds_'+no+'">\n' +
                '                    <td style="text-align: center">'+data.product.name + ' - ' + data.remark + ' ('+priceTypes[data.price_types]+')' + '</td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(data.qty,0).toLocaleString('de-DE')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(data.price,0).toLocaleString('de-DE')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(data.total_price,0).toLocaleString('de-DE')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      <button class="btn btn-sm btn-warning" onclick="deleteItem('+no+')" type="button"><i class="fa fa-trash"></i></button>\n' +
                '                    </td>\n' +
                '                  </tr>';

            calculateTotalItem(parseInt(data.price,0) * parseInt(data.qty,0));

            $('#listItem').append(row);
        });

        function addItem(id) {
            $('#myModal').modal('show');
            $('.modal-title').text('Tambah Item');
        }

        function saveItem() {
            if($('[name=product0]').val() == '' || $('[name=price0]').val() == '' || $('[name=qty0]').val() == ''){
                $('#myModal').modal('hide');
                return swal({
                    title: 'Gagal Simpan Data',
                    text: 'Produk, Harga dan Qty tidak boleh kosong!',
                    icon: 'error',
                    timer: '3000'
                });
            }
            var product = JSON.parse($('[name=product0]').val());
            var price = JSON.parse($('[name=price0]').val());
            var qty = $('[name=qty0]').val();
            var total = parseInt(price.price,0) * parseInt(qty,0);
            var total_hpp = parseInt(price.hpp,0) * parseInt(qty,0);

            calculateTotalItem(total);

            var row = '<tr id="ds_'+currentIndex+'">\n' +
                '                    <td style="text-align: center">'+product.name+ ' - ' + price.remark + ' ('+priceTypes[price.types]+')' +'</td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(qty).toLocaleString('de-De')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(price.price).toLocaleString('de-De')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+total.toLocaleString('de-De')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      <button class="btn btn-sm btn-warning" onclick="deleteItem('+currentIndex+')" type="button"><i class="fa fa-trash"></i></button>\n' +
                '                    </td>\n' +
                '                  </tr>';
            $('#listItem').append(row);

            dataItem.push({
                product: $('[name=price0]').val(),
                qty: $('[name=hpp0]').val(),
                price: $('[name=types0]').val(),
                total: total,
                total_hpp: total_hpp,
            });

            currentIndex++;

            resetItem(0)

            $('[name=items]').val(JSON.stringify(dataItem));

            $('#myModal').modal('hide');
        }

        function resetItem(id) {
            $('[name=category'+id+']').val('');
            $('[name=product'+id+']').val('');
            $('[name=qty'+id+']').val(0);
            $('[name=price'+id+']').val('');
            $('[name=product0]').empty();
            $('[name=price0]').empty();
        }

        function deleteItem(id) {
            $('#ds_'+id).remove();
            var total = parseInt(dataItem[id-1].total,0);
            calculateTotalItem(-total);
            dataItem.splice(id-1,1);
            $('[name=items]').val(JSON.stringify(dataItem));
        }

        function setProduct() {
            if($('[name=category0]').val() =='') return $('[name=product0]').empty().append('<option value="">Pilih Produk</option>');
            $('[name=product0]').empty().append('<option value="">Pilih Produk</option>');
            $('[name=category0] option:selected').data('object').products.forEach(function(product){
                $('[name=product0]').append("<option value='"+JSON.stringify(product)+"' data-object='"+JSON.stringify(product)+"'>"+product.name+"</option>");
            });
        }

        function setPrice() {
            if($('[name=product0]').val() =='') return $('[name=price0]').empty().append('<option value="">Pilih Harga</option>');
            $('[name=price0]').empty().append('<option value="">Pilih Harga</option>');
            $('[name=product0] option:selected').data('object').variants.forEach(function(price){
                $('[name=price0]').append("<option value='"+JSON.stringify(price)+"'>Rp. "+parseInt(price.price,0).toLocaleString('de-DE') + " - " + price.remark + " ("+priceTypes[price.types]+")" + "</option>");
            });
        }

        function calculateTotalItem(amount){
            total_item = parseInt(total_item,0) + parseInt(amount,0);
            calculate();
        }
    </script>
@endpush
