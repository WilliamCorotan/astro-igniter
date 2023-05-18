<ul class="list-group position-absolute m-4 fs-5">
    <li id="side-navbar-toggle" class="list-group-item d-inline-block text-bg-dark"><i class="fa-solid fa-bars"></i></li>
    <li class="list-group-item d-inline-block text-bg-dark"><i class="fa-solid fa-clipboard-list"></i></li>
    <li class="list-group-item d-inline-block text-bg-dark"><i class="fa-solid fa-note-sticky"></i></li>
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
        if ($('#quote-block').is(':visible')) {
            console.log('me heree')
            $('#side-navbar-quote-toggle').addClass('text-bg-success')
            $('#side-navbar-quote-toggle').removeClass('text-bg-dark')
        } else {
            console.log('is mee')
            $('#side-navbar-quote-toggle').addClass('text-bg-dark')
            $('#side-navbar-quote-toggle').removeClass('text-bg-success')
        }
    });
</script>