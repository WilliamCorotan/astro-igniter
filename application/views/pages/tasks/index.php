<?php

$this->load->view('components/quote-block');
?>


<script>
    $(document).ready(function() {
        $("#quote-block").draggable({
            containment: "#app",
            scroll: false
        });
        $

        $('.close').on('click', function() {
            $(this).parents('.drag-block').hide();
        })
    });
</script>