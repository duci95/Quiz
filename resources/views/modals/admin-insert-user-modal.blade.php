<div class="modal fade" id="insert" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="insert" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="admin-edit-user">Dodavanje korisnika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" method="POST" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-6" id="firstname-div">
                            <label for="firstname" class="col-form-label text-muted">Ime</label>
                            <input type="text" class="form-control" id="firstname"/>
                        </div>
                        <div class="col-6">
                            <label for="lastname" class="col-form-label text-muted">Prezime</label>
                            <input type="text" class="form-control" id="lastname" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="email" class="col-form-label text-muted text-muted">Email</label>
                            <input type="text" class="form-control" id="email"/>
                        </div>
                        <div class="col-6">
                            <label for="image" class="col-form-label text-muted">Slika</label>
                            <input type="file" accept="image/gif,image/jpeg,image/png" class="form-control-file" id="image"/>
                        </div>
                    </div>
                    <div class="row justify-content-between align-content-center">
                        <div class="col-6">
                            <label for="new-password" class="col-form-label text-muted">Lozinka</label>
                            <input type="password" class="form-control" id="new-password"/>
                        </div>
                        <div class="col-6">
                            <label for="new-password-again" class="col-form-label text-muted">Ponovi lozinku</label>
                            <input type="password" class="form-control" id="new-password-again"/>
                        </div>
                    </div>
                    <div class="row justify-content-between align-content-center">
                        <div class="col-4">
                            <label for="blocked" class="col-form-label text-muted">Blokiranost</label>
                            <select id="blocked" class="form-control">
                                    <option value="null">Izaberite...</option>
                                    <option value="1">Blokiran</option>
                                    <option value="0">Neblokiran</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="active" class="col-form-label text-muted">Status</label>
                            <select id="active" class="form-control">
                                    <option value="null">Izaberite...</option>
                                    <option value="1">Aktivan</option>
                                    <option value="0">Neaktivan</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="role" class="col-form-label text-muted">Uloga</label>
                            <select id="role" class="form-control">
                                <option class="text-capitalize" value="null">Izaberite...</option>
                                <option class="text-capitalize" value="1">Administrator</option>
                                <option class="text-capitalize" value="2">Moderator</option>
                                <option class="text-capitalize" value="3">Regularni</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                <button type="button" id="modal" class="btn btn-primary add">Dodaj</button>
            </div>
        </div>
    </div>
</div>
