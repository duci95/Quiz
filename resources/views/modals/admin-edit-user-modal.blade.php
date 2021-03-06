<div class="modal fade" id="{{$r->id}}" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="{{$r->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="admin-edit-user">Izmena korisnika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" method="POST">
                    @method('PUT')
                    <div class="row justify-content-center">
                        <div class="col-6" id="firstname-div">
                            <label for="firstname" class="col-form-label text-muted">Ime</label>
                            <input type="text" class="form-control" id="firstname" value="{{$r->first_name}}">
                        </div>
                        <div class="col-6">
                            <label for="lastname" class="col-form-label text-muted">Prezime</label>
                            <input type="text" class="form-control" id="lastname" value="{{$r->last_name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="email" class="col-form-label text-muted text-muted">Email</label>
                            <input type="text" class="form-control" id="email" value="{{$r->email}}">
                        </div>
                        <div class="col-6">
                            <label for="img" class="col-form-label text-muted">Slika</label>
                            <input type="file" accept="image/gif,image/jpeg,image/png"   class="form-control-file" id="img" data-prev-img="{{$r->picture->id}}" >
                        </div>
                    </div>
                    <div class="row justify-content-between align-content-center">
                        <div class="col-6">
                            <label for="new-password" class="col-form-label text-muted">Nova lozinka</label>
                            <input type="password" class="form-control" id="new-password">
                        </div>
                        <div class="col-6">
                            <label for="new-password-again" class="col-form-label text-muted">Ponovi lozinku</label>
                            <input type="password" class="form-control" id="new-password-again" >
                        </div>
                    </div>
                    <div class="row justify-content-between align-content-center">
                        <div class="col-4">
                            <label for="blocked" class="col-form-label text-muted">Blokiranost</label>
                            <select id="blocked" class="form-control">
                                @if($r->is_blocked === 1)
                                <option selected="selected" value="1">Blokiran</option>
                                <option value="0">Neblokiran</option>
                                @else
                                <option value="1">Blokiran</option>
                                <option selected="selected" value="0">Neblokiran</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="active" class="col-form-label text-muted">Status</label>
                            <select id="active" class="form-control">
                                @if($r->active === 1)
                                <option selected="selected" value="1">Aktivan</option>
                                <option value="0">Neaktivan</option>
                                @else
                                <option value="1">Aktivan</option>
                                <option selected="selected" value="0">Neaktivan</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="role" class="col-form-label text-muted">Uloga</label>
                            <select id="role" class="form-control">
                                <option class="text-capitalize" @if($r->role_id === 1) selected="selected" @endif value="1">Administrator</option>
                                <option class="text-capitalize" @if($r->role_id === 2) selected="selected" @endif value="2">Moderator</option>
                                <option class="text-capitalize" @if($r->role_id === 3) selected="selected" @endif value="3">Regularni</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                <button type="button" data-id="{{$r->id}}" id="modal" class="btn btn-primary save">Sačuvaj</button>
            </div>
        </div>
    </div>
</div>
