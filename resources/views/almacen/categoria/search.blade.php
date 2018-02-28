            {!! Form::open(array('url' => 'almacen/categoria', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search')) !!}
            <div class="form-group pull-left">
                <div class="input-group">
                    <input type="text" class="form-control" name="searchText" Placeholder="Categoria a buscar" value="{{ $searchText }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="icon-magnifying-glass-browser"></i> Buscar...</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}