<div id="task-modal" class=" position-absolute top-0 start-0 vw-100 vh-100 grid place-items-center">
    <div id="task-modal-overlay" class="bg-dark bg-opacity-75 vw-100 vh-100 position-absolute z-1">

    </div>
    <div class="card bg-dark z-3" style="min-width: 18rem; max-width: 24rem">
        <div class="card-header text-end">
            <span class="px-1"><i class="modal-close fa-solid fa-xmark"></i></span>
        </div>
        <div class="card-body">
            <div class="card-title">
                <h5 class="task-title"><?= $title ?></h5>
                <span class="badge rounded-pill text-bg-primary"><?= $priority_level_code ?></span>
                <div id="status-dropdown" class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="task-status"><?= $status_code ?></span>
                    </button>
                    <ul id="status-dropdown-menu" class="dropdown-menu">
                    </ul>
                </div>
            </div>
            <span class="badge rounded-pill text-bg-primary task-priority-level"></span>
            <p class="card-text task-start-date">Start date: <?= $start_date ?></p>
            <p class="card-text task-due-date">Due date: <?= $due_date ?></p>
            <div>
                <h5>Description</h5>
                <p class="card-text task-body"> <?= $body ?></p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-close').on('click', function() {
            $('#task-modal').remove()
        })

        $('#task-modal-overlay').on('click', function() {
            $('#task-modal').remove()
        })

        $('#app').on('mouseenter', '.modal-close', function() {
            $(this).css('cursor', 'pointer')
        })

        $(document).on('click', '#status-dropdown', function() {
            $('#status-dropdown-menu').children().remove()

            const statusArray = ['to do', 'in progress', 'done'];
            const statusDropdownArray = statusArray.filter(el => el != $('.task-status').html())

            statusDropdownArray.map(el => {
                return $('#status-dropdown-menu').append(`<li> <a class = "dropdown-item"href = "#"> ${el} </a></li>`)
            })


        })

    });
</script>