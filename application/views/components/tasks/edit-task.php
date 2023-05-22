<div id="task-edit-modal" class=" position-absolute top-0 start-0 vw-100 vh-100 grid place-items-center">
    <div id="task-edit-modal-overlay" class="bg-dark bg-opacity-75 vw-100 vh-100 position-absolute z-1">

    </div>
    <form id="edit-task-form" class="my-3 z-3 position-relative bg-dark p-3 rounded" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="mb-3 ">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control form-control-sm col-auto w-100" name="title" id="title" value="<?= $title ?>" aria-describedby="titleId" placeholder="Task Title">
        </div>

        <div class="mb-3">
            <div class="mb-3">
                <label for="priority_level" class="form-label">Status</label>
                <select class="form-select fs-6  form-select-lg" name="status_id" id="status_id">
                    <option value="1" <?php ($status_code === 'to do') ? 'selected' : '' ?>>To do</option>
                    <option value="2" <?php ($status_code === 'in progress') ? 'selected' : '' ?>>In progress</option>
                    <option value="3" <?php ($status_code === 'done') ? 'selected' : '' ?>>Done</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <div class="mb-3">
                <label for="priority_level" class="form-label">Priority Level</label>
                <select class="form-select fs-6  form-select-lg" name="priority_level_id" id="priority_level_id">
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
            <button class="modal-close btn btn-outline-danger">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>

</div>

<script>
    $(document).ready(function() {
        //Fetches tasks per user
        function fetchTasks() {
            const taskBlock = (id, title, body, startDate, dueDate, priorityLevel, status) => {
                switch (priorityLevel) {
                    case 'high':
                        priorityLevelStyle = 'text-bg-danger'
                        break;
                    case 'medium':
                        priorityLevelStyle = 'text-bg-success'
                        break;
                    case 'low':
                        priorityLevelStyle = 'text-bg-primary'
                        break;
                }
                return (`
                <div class="task-card w-100 row m-0 px-2 mb-2 border border-secondary ">
                    <div class="col-5 pt-2">
                        <span class="text-break">${title}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center col-7">
                        <div class="mx-2 flex-grow-1">
                            <span>${dueDate}</span>
                        </div>
                        <div id="edit-task" class="p-2 text-primary"><i class="fa-solid fa-pencil"></i></div>
                        <div id="delete-task" class="p-2 text-danger"><i class="fa-solid fa-trash-can"></i></div>
                    </div>
                    <input type="hidden" class="form-control" name="id"  value="${id}">
                    <input type="hidden" class="form-control" name="title"  value="${title}">
                    <input type="hidden" class="form-control" name="body"  value="${body}">
                    <input type="hidden" class="form-control" name="start_date"  value="${startDate}">
                    <input type="hidden" class="form-control" name="due_date"  value="${dueDate}">
                    <input type="hidden" class="form-control" name="priority_level"  value="${priorityLevel}">
                    <input type="hidden" class="form-control" name="status"  value="${status}">
                </?div>
                `)
            };

            $.ajax({
                type: "get",
                url: "api/v1/tasks",
                dataType: "json",
                success: function(response) {
                    if (response.data.length) {
                        $('#task-container').children().remove();
                        response.data.map(task => {
                            return $('#task-container').append(taskBlock(task.id, task.title, task.body, task.start_date, task.due_date, task.priority_level_code, task.status_code));
                        })
                    } else {
                        $('#task-container').children().remove();
                        $('#task-container').append('<div class="text-center text-secondary"> <small> No Tasks! Keep the productivity up!</small> </div>');
                    }

                }
            });
        }
        //End fetchTasks()

        const id = $('[name=id]').val()
        console.log(id)
        //click event for edit modal close
        $('.modal-close').on('click', function() {
            $('#task-edit-modal').remove()
        })

        //click event for edit modal overlay close 
        $('#task-edit-modal-overlay').on('click', function() {
            $('#task-edit-modal').remove()
        })

        //hover event for modal-close
        $('#app').on('mouseenter', '.modal-close', function() {
            $(this).css('cursor', 'pointer')
        })

        const spinner = `<div class="spinner-border text-secondary" role="status"> <span class = "visually-hidden" > Loading... </span> </div>`;

        //submit event for the edit form 
        $('#edit-task-form').on('submit', function() {
            event.preventDefault();

            $.ajax({
                type: "post",
                url: `api/v1/tasks/update/${id}`,
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: () => {
                    $(this).find('input').attr('disabled', 'disabled');
                    $(this).find('textarea').attr('disabled', 'disabled');
                    $(this).find('button[type=submit]').attr('disabled', 'disabled');

                    $(this).find('input').addClass('disabled');
                    $(this).find('textarea').addClass('disabled');
                    $(this).find('button[type=submit]').addClass('disabled');

                    $(this).find('button[type=submit]').html(spinner);
                },
                success: (response) => {
                    console.log(response);
                    $('#task-edit-modal').remove()
                    fetchTasks()

                }
            });
        })
    });
</script>