<!--begin::Modal-->
<div class="modal fade" id="modal_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengaturan Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="form_profile" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group" id="name_profile">
                        <label for="recipient-name" class="form-control-label">Nama:</label>
                        <input type="text" class="form-control" id="name_profile" name="name_profile" value="{{ @\Auth::user()->name }}">
                        <div id="name_profile_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="form-group" id="password_profile">
                        <label for="message-text" class="form-control-label">Password:</label>
                        <input type="password" class="form-control" id="password_profile" name="password_profile" placeholder="Kosongkan Jika tidak mengganti password">
                        <div id="password_profile_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="form-group" id="email_profile">
                        <label for="recipient-name" class="form-control-label">Email:</label>
                        <input type="email" class="form-control" id="email_profile" name="email_profile" value="{{ @\Auth::user()->email }}">
                        <div id="email_profile_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="form-group" id="phone_profile">
                        <label for="recipient-name" class="form-control-label">Phone:</label>
                        <input type="text" class="form-control" id="phone_profile" name="phone_profile" value="{{ @\Auth::user()->phone }}">
                        <div id="phone_profile_error" class="help-block help-block-error"> </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="saveProfile()" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!--end::Modal-->
