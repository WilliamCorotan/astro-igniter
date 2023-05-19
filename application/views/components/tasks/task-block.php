<div class="m-2">
    <div id="task-block" class="drag-block card draggable ui-widget-content bg-dark  position-relative" style="max-width: 24rem;">
        <div class="card-header text-end">
            <span class="px-1"><i class="close fa-solid fa-xmark"></i></span>
        </div>
        <div class="card-body">
            <div class="card-title fw-bold d-flex justify-content-between align-items-center">
                <span>Task tracker</span>
                <a name="add-task" id="add-task" class="btn btn-primary fs-6" role="button">Add</a>
            </div>
            <?php $this->load->view('components/tasks/add-task') ?>
            <div id="task-container">

            </div>
        </div>


    </div>
</div>


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
                <div class="task-card w-100 d-flex p-2 mb-2 border border-secondary justify-content-between">
                    <div class="grid">
                        <span>${title}</span>
                        <div>
                            <span class="badge rounded-pill ${priorityLevelStyle}">${priorityLevel}</span>
                        </div>
                    </div>
                    <div>
                    <span>${dueDate}</span>
                    </div>

                    <input type="hidden" class="form-control" name="id"  value="${id}">
                    <input type="hidden" class="form-control" name="title"  value="${title}">
                    <input type="hidden" class="form-control" name="body"  value="${body}">
                    <input type="hidden" class="form-control" name="start_date"  value="${startDate}">
                    <input type="hidden" class="form-control" name="due_date"  value="${dueDate}">
                    <input type="hidden" class="form-control" name="priority_level"  value="${priorityLevel}">
                    <input type="hidden" class="form-control" name="status"  value="${status}">

                </div>
                `)
            };
            $.ajax({
                type: "get",
                url: "api/v1/tasks",
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    if (response.data.length) {
                        response.data.map(task => {
                            return $('#task-container').append(taskBlock(task.id, task.title, task.body, task.start_date, task.due_date, task.priority_level_code, task.status_code));
                        })
                    } else {
                        $('#task-container').append('<div class="text-center text-secondary"> <small> No Tasks! Keep the productivity up!</small> </div>');
                    }

                }
            });
        }
        fetchTasks();

        $('#app').on('mouseenter', '.task-card', function() {
            $(this).css('cursor', 'pointer')
        })

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

    });
</script>