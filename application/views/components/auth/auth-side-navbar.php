<ul class="list-group position-absolute m-4 fs-5">
    <li id="side-navbar-toggle" class="list-group-item d-inline-block text-bg-dark"><i class="fa-solid fa-bars"></i></li>
    <li id="side-navbar-task-toggle" class="list-group-item d-inline-block text-bg-dark"><i class="fa-solid fa-clipboard-list"></i></li>
    <li id="side-navbar-sticky-add" class="list-group-item d-inline-block text-bg-dark"><i class="fa-solid fa-note-sticky"></i></li>
    <li id="side-navbar-quote-toggle" class="list-group-item d-inline-block text-bg-dark"><i class="fa-solid fa-quote-right"></i></li>
</ul>


<script>
    $(document).ready(function() {
        $('#side-navbar-toggle').on('click', function() {
            $(this).siblings().toggleClass('d-none')
        })

        $('#side-navbar-quote-toggle').on('click', function() {
            $('#quote-block').toggle()
            if ($('#quote-block').is(':visible')) {
                console.log('me heree')
                $('#side-navbar-quote-toggle').addClass('text-bg-success')
                $('#side-navbar-quote-toggle').removeClass('text-bg-dark')
            } else {
                console.log('is mee')
                $('#side-navbar-quote-toggle').addClass('text-bg-dark')
                $('#side-navbar-quote-toggle').removeClass('text-bg-success')
            }
        })

        $('#side-navbar-task-toggle').on('click', function() {
            $('#task-block').toggle()
            if ($('#task-block').is(':visible')) {
                console.log('me heree')
                $('#side-navbar-task-toggle').addClass('text-bg-success')
                $('#side-navbar-task-toggle').removeClass('text-bg-dark')
            } else {
                console.log('is mee')
                $('#side-navbar-task-toggle').addClass('text-bg-dark')
                $('#side-navbar-task-toggle').removeClass('text-bg-success')
            }
        })

        $('#side-navbar-sticky-add').on('click', function() {
            const stickyNote = `<?php $this->load->view('components/sticky/sticky-block') ?>`
            $('#app').append(stickyNote)

            $(".draggable").draggable({
                containment: "#app",
                scroll: false
            });


            $(".sticky-close").on('click', function() {
                $(this).parents('.drag-block').remove();
            })


        })


        if ($('#quote-block').is(':visible')) {
            console.log('me heree')
            $('#side-navbar-quote-toggle').addClass('text-bg-success')
            $('#side-navbar-quote-toggle').removeClass('text-bg-dark')
        } else {
            console.log('is mee')
            $('#side-navbar-quote-toggle').addClass('text-bg-dark')
            $('#side-navbar-quote-toggle').removeClass('text-bg-success')
        }
        if ($('#task-block').is(':visible')) {
            console.log('me heree')
            $('#side-navbar-task-toggle').addClass('text-bg-success')
            $('#side-navbar-task-toggle').removeClass('text-bg-dark')
        } else {
            console.log('is mee')
            $('#side-navbar-task-toggle').addClass('text-bg-dark')
            $('#side-navbar-task-toggle').removeClass('text-bg-success')
        }
    });
</script>