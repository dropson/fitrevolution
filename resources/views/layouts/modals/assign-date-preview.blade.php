<div id="preview-assign-date-modal"
    class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 modal-middle hidden " role="dialog"
    tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100 overlay-open:duration-300">
        <form action="{{ route('clients.schedule.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="workout_title"></h3>
                </div>
                <div class="modal-body p-5">
                    <div class="flex gap-4 items-center">
                        <h4 class="">Assign to</h4>
                        <input class="input max-w-sm" type="date" name="scheduled_date" id="scheduled_date"  placeholder="today">
                    </div>
                    <input type="hidden" name="template_workout_id" id="workout_id">
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-soft btn-secondary preview-assign-date-modal-close">Close</button>

                    <button type="submit" class="btn btn-primary">Assign date</button>
                </div>
            </div>
        </form>
    </div>
</div>
