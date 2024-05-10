<div class="modal" id="deleteModal{{ $id }}" tabindex="-1" data-action={{ $action }}>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('modal.delete')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>@lang('modal.mess_delete')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('modal.close')</button>
                <form action={{ $action }} method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">@lang('modal.delete')</button>
                </form>
            </div>
        </div>
    </div>
</div>
