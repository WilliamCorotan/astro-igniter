<?php

$this->load->view('components/auth/auth-side-navbar');
$this->load->view('components/quote-block');
$this->load->view('components/tasks/task-block');
?>

<script>
    $(document).ready(function() {
        $(".draggable").draggable({
            containment: "#app",
            scroll: false
        });
        $

        $('.close').on('click', function() {
            $(this).parents('.drag-block').hide();
            $('#side-navbar-quote-toggle').addClass('text-bg-dark')
            $('#side-navbar-quote-toggle').removeClass('text-bg-success')
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
    });
</script>