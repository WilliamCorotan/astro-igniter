<div id="task-edit-modal" class=" position-absolute top-0 start-0 vw-100 vh-100 grid place-items-center">
    <div id="task-edit-modal-overlay" class="bg-dark bg-opacity-75 vw-100 vh-100 position-absolute z-1">

    </div>
    <form id="add-task-form" class="my-3 z-3 position-relative bg-dark p-3 rounded" method="post">
        <div class="mb-3 ">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control form-control-sm col-auto w-100" name="title" id="title" value="<?= $title ?>" aria-describedby="titleId" placeholder="Task Title">

        </div>

        <div class="mb-3">
            <div class="mb-3">
                <label for="priority_level" class="form-label">Status</label>
                <select class="form-select fs-6  form-select-lg" name="priority_level" id="priority_level">
                    <option value="1" <?php ($status_code === 'to do') ? 'selected' : '' ?>>To do</option>
                    <option value="2" <?php ($status_code === 'in progress') ? 'selected' : '' ?>>In progress</option>
                    <option value="3" <?php ($status_code === 'done') ? 'selected' : '' ?>>Done</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <div class="mb-3">
                <label for="priority_level" class="form-label">Priority Level</label>
                <select class="form-select fs-6  form-select-lg" name="priority_level" id="priority_level">
                    <option value="3" <?php ($priority_level_code === 'low') ? 'selected' : '' ?>>Low</option>
                    <option value="2" <?php ($priority_level_code === 'medium') ? 'selected' : '' ?>>Moderate</option>
                    <option value="1" <?php ($priority_level_code === 'high') ? 'selected' : '' ?>>High</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="<?= $start_date ?>" aria-describedby="startDateId" placeholder="">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" class="form-control" name="due_date" id="due_date" value="<?= $due_date ?>" aria-describedby="dueDateId" placeholder="">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Description</label>
            <textarea class="form-control form-control-sm" name="body" id="body" rows="3" placeholder="Add task description here..."><?= $body ?></textarea>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>

</div>

<script>
    $(document).ready(function() {
        $('.modal-close').on('click', function() {
            $('#task-edit-modal').remove()
        })


        $('#task-edit-modal-overlay').on('click', function() {
            $('#task-edit-modal').remove()
        })

        $('#app').on('mouseenter', '.modal-close', function() {
            $(this).css('cursor', 'pointer')
        })

    });
</script>