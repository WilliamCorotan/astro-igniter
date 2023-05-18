<div id="task-modal" class="bg-dark bg-opacity-75 position-absolute vw-100 vh-100 top-0 start-0 grid place-items-center" style="display: none;">
    <div class="card bg-dark w-75">
        <div class="card-header text-end">
            <span class="px-1"><i class="modal-close fa-solid fa-xmark"></i></span>
        </div>
        <div class="card-body">
            <div class="card-title">
                <h5 class="task-title"></h5>
                <span class="task-status"></span>
            </div>
            <span class="badge rounded-pill text-bg-primary task-priority-level"></span>
            <p class="card-text task-start-date">Start date: </p>
            <p class="card-text task-due-date">Due date: </p>
            <div>
                <h5>Description</h5>
                <p class="card-text task-body"></p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-close').on('click', function() {
            $('#task-modal').toggle()
        })
    });
</script>