    <div class="search-panel">
        <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>

            {{ Form::open(array('url' => 'almacen/categoria', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search')) }}
                <div class="form-group">
                    <input type="text" name="searchText" placeholder="Buscar..." value="{{ $searchText }}">
                    <button type="submit" class="submit">Buscar</button>
                </div>
            {{ Form::close() }}

        </div>
    </div>
