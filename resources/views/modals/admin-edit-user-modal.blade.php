<div class="modal fade" id="{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$r->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="admin-edit-user">Izmena korisnika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  class="form-group" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-6">
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
                            <input type="file" accept="image/gif,image/jpeg,image/png"  class="form-control-file" id="img" value="${response.results.picture.image_name}">
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
                                <option  value="0">Neaktivan</option>
                                @else
                                <option  value="1">Aktivan</option>
                                <option selected="selected" value="0">Neaktivan</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="active" class="col-form-label text-muted">Uloga</label>
                            <select id="active" class="form-control">
                                @foreach($roles as $rl)
                                    @switch($r->role_id)
                                        @case(1)
                                        <option class="text-capitalize" selected="selected" value="{{$rl->id}}">Administrator</option>
                                        @break
                                        @case(2)
                                        <option class="text-capitalize" selected="selected" value="{{$rl->id}}">Moderator</option>
                                        @break
                                        @case(3)
                                        <option class="text-capitalize" selected="selected" value="{{$rl->id}}">Regularni</option>

                                        @break
                                    @endswitch
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
