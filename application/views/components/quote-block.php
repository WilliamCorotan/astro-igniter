    <div id="quote-block" class="drag-block card draggable ui-widget-content bg-dark position-relative" style="max-width: 24rem;">
        <div class="card-header text-end">
            <span class="px-1"><i class="close fa-solid fa-xmark"></i></span>
        </div>
        <div class="card-body text-center">
            <blockquote class="blockquote mb-0">
                <p></p>
                <footer class="blockquote-footer fs-6"></footer>
            </blockquote>
        </div>
        <div class="mx-3 my-2 position-absolute end-0 bottom-0">
            <span id="fetch-quote" class="px-1"><i class="fa-solid fa-rotate-right"></i></span>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function fetchQuote() {
                return $.ajax({
                    type: "get",
                    url: "https://api.quotable.io/random",
                    data: {
                        maxLength: 255,
                    },
                    dataType: "json",
                    success: (response) => {
                        $('.blockquote').children('p').html(response.content)
                        $('.blockquote').children('.blockquote-footer').html(response.author)
                    }
                });
            }
            fetchQuote()
            $('#fetch-quote').on('click', function() {
                fetchQuote();
            })
        });
    </script>