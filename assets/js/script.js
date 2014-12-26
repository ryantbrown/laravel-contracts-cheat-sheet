(function ($, root, undefined) {
    $(function(){

        $('.ui.checkbox').checkbox();

        var $groups = $('.column.group');
        var expanded = true;

        $('.interfaces').on("click", function(){
            if($('input[name=interfaces]').is(':checked')) {
                $groups.addClass('expand');
                expanded = true;
            } else {
                $groups.removeClass('expand');
                expanded = false;
            }
        });

        $('.data-link').on("click", function(event){

            event.preventDefault();

            if($(this).data('type') == 'group') {

                // group

                $('.column').addClass('dim');
                $(this).closest('.column.group').removeClass('dim')
                if( ! expanded) {
                    $(this).closest('.column.group').addClass('expand');
                }
                $(this).find('span.title').addClass('active');
                $(this).parent().find('.count span').hide();
                $(this).parent().find('.count .close').show().on("click", function(){
                    $('.column').removeClass('dim');
                    $(this).hide();
                    $(this).closest('h1').find('span.title').removeClass('active');
                    $(this).closest('.count').find('span').show();
                    if( ! expanded) {
                        $(this).closest('.column.group').removeClass('expand');
                    }
                    $(this).off("click");
                });

            } else {

                // class
                var class_overlay = $(this).data('name');
                $('.overlay[data-class="'+class_overlay+'"]').addClass('on');

            }

        });

        $('.prompt').on("keyup", function(){
            var q = $(this).val().toLowerCase();
            $('.inside').each(function(){

                var show = false;
                var title = $(this).find('.title').html().toLowerCase();
                var $files = $(this).find('.file');

                if(title.search(q) !== -1) {
                    show = true;
                }

                $files.each(function(){
                    var name = $(this).html().toLowerCase();
                    if(name.search(q) !== -1) {
                        show = true;
                    }
                });

                if(show) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }

            });
        });

    });
})(jQuery, this);