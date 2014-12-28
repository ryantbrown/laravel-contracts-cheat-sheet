(function ($) {
    $(function(){

        // store top position so we can revert back
        // to the original when the overlay is closed
        var original_top = 0;

        // handle the interface click event
        $('a[data-class]').on("click", function(event){

            // disable the hash jump
            event.preventDefault();

            // set the location
            window.location.href = $(this).attr('href');

            // store the offset so we can revert back
            original_top = Math.abs(($(this).closest('.inside').find('h1').offset().top) - 30);

            // enable overlay
            $('.overlay')

                // set loading icon
                .html('<i class="spinner loading icon"></i>')

                // animate in
                .addClass('on')

                // load the static html interface file
                .load('./classes/'+$(this).data('class') + '.html', function(){

                    // bind close events
                    $('.overlay')

                        // bind escape key
                        .swipe({ swipeRight: closeOverlay })

                        // bind the close button
                        .find('.close').on("click", closeOverlay );
                });

            // when overlay is done animating
            setTimeout(function(){

                // hide all groups
                $('.groups').hide();

            }, 250);

            // watch for keyboard events
            $(document).keyup(function(e) {

                // check for escape key
                if(e.which == 27) {

                    // if escape was pressed then close the overlay
                    closeOverlay();
                }
            });

            // scroll to top of overlay
            $("html, body").animate({ scrollTop: 0 }, 200);

        });

        // after we set the click handler we need to
        // check the location to see if we need to
        // load a specific interface right form the start
        var segments = location.href.split('#');

        // if we have a "group-class" segment
        if(segments.length === 2 && segments[1] !== '')
        {
            var url_parts = segments[1].split('/');
            $('a[data-class='+(url_parts[1] + '-' + url_parts[2])+']').click();
        }

        // close the overlay
        var closeOverlay = function() {

            // set the location
            window.location.href = '#';

            // animate it out
            $('.overlay').removeClass('on');

            // unhide the contract groups
            $('.groups').show();

            // unbind the escape key
            $(document).unbind("keyup");

            // revert the document back to the original position
            $("html, body").animate({ scrollTop: original_top }, 50);

        };

        // keyword filter
        $('.prompt').on("keyup", function(){

            // cache query
            var q = $(this).val().toLowerCase();

            // loop through each group
            $('.inside').each(function(){

                // default visilibty to hidden
                var show = false;

                // loop through group title and interface names
                $(this).find('.search').each(function(){

                    // search against query
                    if($(this).html().toLowerCase().search(q) !== -1) {

                        // if query matches then set visiblity to true
                        show = true;
                    }
                });

                // set visiblity based on show parameter
                show ? $(this).parent().removeClass('hide') : $(this).parent().addClass('hide');

            });

            // highlight query matches
            $('.search').removeHighlight().highlight(q);

        });

    });
})(jQuery);