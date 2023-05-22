<div class="m-2">
    <div id="task-block" class="drag-block card draggable ui-widget-content bg-dark  position-relative" style="max-width: 24rem; max-height: calc(100vh - 56px) !important;"">
        <div class=" card-header text-end">
        <span class="px-1"><i class="close fa-solid fa-xmark"></i></span>
    </div>
    <div class="card-body ">
        <div class="card-title fw-bold d-flex justify-content-between align-items-center">
            <span>Task tracker</span>
            <a name="clear-tasks" id="clear-tasks" class="btn btn-outline-danger fs-6" role="button">Clear tasks</a>
            <a name="add-task" id="add-task" class="btn btn-primary fs-6" role="button">Add</a>
        </div>
        <?php $this->load->view('components/tasks/add-task') ?>
        <div id="task-container" class="overflow-hidden">

        </div>
    </div>


</div>
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

        fetchTasks();

        //hover effect for each task card
        $('#app').on('mouseenter', '.task-card', function() {
            $(this).css('cursor', 'pointer')
        })

        // click event for each task card
        $(document).on('click', '.task-card', function() {
            const id = $(this).children('input[name="id"]').val()
            const title = $(this).children('input[name="title"]').val()
            const body = $(this).children('input[name="body"]').val()
            const startDate = $(this).children('input[name="start_date"]').val()
            const dueDate = $(this).children('input[name="due_date"]').val()
            const priorityLevel = $(this).children('input[name="priority_level"]').val()
            const status = $(this).children('input[name="status"]').val()

            $.ajax({
                type: "get",
                url: `api/v1/tasks/${id}`,
                dataType: "html",
                success: function(response) {
                    console.log(response)
                    $('#app').append(response)
                }
            });
        })

        //click event for adding task
        $('#add-task').on('click', function() {
            $('#add-task-form').toggle()
            if ($('#add-task-form').is(':visible')) {
                $(this).html('Close');
                $(this).addClass('btn-danger');
                $(this).removeClass('btn-primary');
            } else {
                $(this).html('Add');
                $(this).removeClass('btn-danger');
                $(this).addClass('btn-primary');
            }
        });

        //click event for editing task
        $(document).on('click', '#edit-task', function(event) {
            const id = $(this).parent().siblings('input[name="id"]').val()
            event.stopPropagation();
            $.ajax({
                type: "get",
                url: `api/v1/tasks/edit/${id}`,
                dataType: "html",
                success: function(response) {
                    $('#app').append(response)
                }
            });
        })

        //click event for clearing all tasks
        $(document).on('click', '#clear-tasks', function() {
            const userId = '<?= $this->session->userdata('id') ?>';

            $.ajax({
                type: "delete",
                url: `api/v1/tasks/clear/${userId}`,
                success: function(response) {
                    fetchTasks();
                },
                error: function(error) {
                    console.log(error.responseText)
                }
            });
        });

    });
</script>