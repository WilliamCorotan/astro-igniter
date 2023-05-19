<form id="add-task-form" class="my-3" style="display: none;" method="post">
    <div class="mb-3 ">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control form-control-sm col-auto w-100" name="title" id="title" aria-describedby="titleId" placeholder="Task Title">

    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Description</label>
        <textarea class="form-control form-control-sm" name="body" id="body" rows="3" placeholder="Add task description here..."></textarea>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date" aria-describedby="startDateId" placeholder="">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" name="due_date" id="due_date" aria-describedby="dueDateId" placeholder="">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="mb-3">
            <label for="priority_level" class="form-label">Priority Level</label>
            <select class="form-select fs-6  form-select-lg" name="priority_level" id="priority_level">
                <option value="3">Low</option>
                <option value="2">Moderate</option>
                <option value="1">High</option>
            </select>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>

<script>
    $(document).ready(function() {
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
                        <div class="p-2 text-primary"><i class="fa-solid fa-pencil"></i></div>
                        <div class="p-2 text-danger"><i class="fa-solid fa-trash-can"></i></div>
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
                    console.log(response)
                    $('#task-container').children().remove();
                    response.data.map(task => {
                        return $('#task-container').append(taskBlock(task.id, task.title, task.body, task.start_date, task.due_date, task.priority_level_code, task.status_code));
                    })


                }
            });
        }
        const spinner = `<div class="spinner-border text-secondary" role="status"> <span class = "visually-hidden" > Loading... </span> </div>`;

        $('#add-task-form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                type: "post",
                url: "api/v1/tasks/store",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: () => {
                    $('input, textarea, button[type=submit]').attr('disabled', 'disabled');
                    $('input, textarea, button[type=submit]').addClass('disabled');
                    $('button[type=submit]').html(spinner);
                },
                success: (response) => {
                    fetchTasks()
                    $('input, textarea, button[type=submit]').removeAttr('disabled');
                    $('input, textarea, button[type=submit]').removeClass('disabled');
                    $('button[type=submit]').html('Save');
                    console.log(response);

                    // this = form

                    /**
                     * form
                     *  -input
                     *  -textarea
                     *      .val()
                     */
                    $(this).find('input, textarea').each(function() {
                        $(this).val('');
                    })

                    $(this).find('option[value="3"]').attr('selected', 'selected');
                }
            });
        })
    });
</script>