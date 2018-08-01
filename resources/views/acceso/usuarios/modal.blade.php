
        <div id="modal-delete-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                                    {!! Form::Open(array('action' => array('UsuarioController@destroy', $user->id), 'method' => 'delete')) !!}
                                    <div role="document" class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Eliminar Usuario</strong>
                                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Confirme si desea eliminar al usuario: {{$user->name}}.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>