<div class="modal fade" id="m_modal_<?= $value->no_akun ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= $value->no_akun ?> (<?= $value->type ?>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <tr>
                        <td>Password Trader</td>
                        <td><code><?= $value->password_trade ?></code></td>
                    </tr>
                    <tr>
                        <td>Password Investor</td>
                        <td><code><?= $value->password_investor ?></code></td>
                    </tr>
                    <tr>
                        <td>Server</td>
                        <td><code><?= $value->ip ?></code></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>