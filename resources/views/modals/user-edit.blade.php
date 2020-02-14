<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog"  aria-labelledby="modalEdit" aria-hidden="true">
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
                            <input type="text" class="form-control" id="firstname" value="{{session()->get('user')->first_name}}">
                        </div>
                        <div class="col-6">
                            <label for="lastname" class="col-form-label text-muted">Prezime</label>
                            <input type="text" class="form-control" id="lastname" value="{{session()->get('user')->last_name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="email" class="col-form-label text-muted text-muted">Email</label>
                            <input type="text" class="form-control" id="email" value="{{session()->get('user')->email}}">
                        </div>
                        <div class="col-6">
                            <label for="img" class="col-form-label text-muted">Slika</label>
                            <input type="file" accept="image/gif,image/jpeg,image/png"   class="form-control-file" id="img" />
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger d" data-id="{{session()->get('user')->id}}"  >Deaktiviraj nalog</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                <button type="button"  data-id="{{session()->get('user')->id}}" class="btn btn-primary save">Sačuvaj</button>
            </div>
        </div>
    </div>
</div>