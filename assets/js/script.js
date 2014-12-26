(function ($, root, undefined) {
    $(function(){

        var original_top = 0;

         var closeOverlay = function() {
            $('.overlay').removeClass('on');
            $('.groups').show();
            $(document).unbind("keyup");
            $("html, body").animate({ scrollTop: original_top }, 50);
        };

        $('a[data-class]').on("click", function(event){

            event.preventDefault();

            original_top = $(this).closest('.inside').find('h1').offset().top;

            $('.overlay')

                .html('<i class="spinner loading icon"></i>')
                .addClass('on')
                .load('../classes/'+$(this).data('class') + '.html', function(){

                    $('.overlay')
                        .swipe({ swipeRight: closeOverlay })
                        .find('.close').on("click", closeOverlay );
                });

            // hide all groups as soon as overlay is done animating
            setTimeout(function(){
                $('.groups').hide();
            }, 250);

            // enable esc key to close overlay
            $(document).keyup(function(e) {
                if(e.which == 27) {
                    closeOverlay();
                }
            });

            // scroll to top of overlay
            $("html, body").animate({ scrollTop: 0 }, 200);

        });

        // keyword filter
        $('.prompt').on("keyup", function(){

            // cache query
            var q = $(this).val().toLowerCase();

            // loop through each group
            $('.inside').each(function(){

                var show = false;

                // loop through group title and interface names
                $(this).find('.search').each(function(){
                    if($(this).html().toLowerCase().search(q) !== -1) {
                        show = true;
                    }
                });

                show ? $(this).parent().show() : $(this).parent().hide();

            });

            // highlight query matches
            $('.groups').removeHighlight().highlight(q);
        });
    });
})(jQuery, this);