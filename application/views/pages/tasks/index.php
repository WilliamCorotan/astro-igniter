<?php

$this->load->view('components/auth/auth-side-navbar');
$this->load->view('components/quote-block');
$this->load->view('components/tasks/task-block');
$this->load->view('components/tasks/view-task');
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
        })
    });
</script>