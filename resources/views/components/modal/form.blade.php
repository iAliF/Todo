@props([
    "modalId", "formId", "title", "method"
])

<div class="modal fade" id="{{$modalId}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{$title}}</h3>
                </div>

                <x-form.form :$method noBorder="true" id="{{$formId}}">
                    <x-form.input-group
                        id="content"
                        icon="ti-pencil"
                        label="Content"
                        type="text"
                        required
                    />

                    <select class="form-select mb-3" name="status">
                        <option value="todo">Todo</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </x-form.form>
            </div>
        </div>
    </div>
</div>
