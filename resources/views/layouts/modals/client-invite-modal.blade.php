<div id="preview-invite-client-modal"
    class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 modal-middle hidden " role="dialog"
    tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100 overlay-open:duration-300">
        <form action="{{ route('send_invitation') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title items-center">Invite <span id="client_name"></span> </h3>
                    <button type="button"
                        class="btn btn-text btn-circle btn-sm absolute end-3 top-3 preview-invite-client-close">
                        <span class="icon-[tabler--x] size-4"></span>
                    </button>
                </div>
                <div class="modal-body p-5">
                    Send a welcome email to invite him to set up his password and visit his client profile.
                    <div class="flex gap-4 items-center mb-5 mt-2">
                        <input type="hidden" name="client_id" id="client_id" value="">
                        <x-forms.input-group label="Email" class="w-full" name="email" value="{{ old('email') }}"
                            :errors="$errors" />
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                    <div class="mb-4"> Or you can copy and send the invitation link directly:</div>

                    <div class="rounded-box inline-flex items-center gap-1 p-1 shadow-base-300/90 shadow-sm">
                        <code id="clipboard-basic" class="px-2 text-base-content text-xs font-medium"><span
                                id="client_token">sdsds</span></code>
                        <button type="button" class="js-clipboard btn btn-square btn-text"
                            aria-label="Copy text to clipboard" data-clipboard-target="#clipboard-basic"
                            data-clipboard-action="copy">
                            <span class="js-clipboard-default icon-[tabler--clipboard] size-5 transition"></span>
                            <span
                                class="js-clipboard-success icon-[tabler--clipboard-check] text-primary hidden size-5"></span>
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
