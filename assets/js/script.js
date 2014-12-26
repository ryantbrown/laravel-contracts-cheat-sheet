(function ($, root, undefined) {
    $(function(){
        var $groups = $('.column.group');
        var $toggle_int = $('.toggle-ints');
        $toggle_int.on("click", function(){
            if($groups.hasClass('expand')) {
                $groups.removeClass('expand');
                $toggle_int.html('<i class="tasks icon"></i> Show Interfaces');
            } else {
                $groups.addClass('expand');
                $toggle_int.html('<i class="tasks icon"></i> Hide Interfaces');
            }
        });

    });
})(jQuery, this);