// ALA custom events for Fathom
($ => {
    $(document).ready(($) => {

        $( ".home .nav-tabs #tab-A" ).on( "click", function() {
            // home page - Researchers tab
            fathom.trackGoal('XKBZK7IS', 0);
        });
        $( ".home .nav-tabs #tab-B" ).on( "click", function() {
            // home page - Government tab
            fathom.trackGoal('QYUMIGCY', 0);
        });
        $( ".home .nav-tabs #tab-C" ).on( "click", function() {
            // home page - Community tab
            fathom.trackGoal('DEHPRPRI', 0);
        });

    }// end document.ready
)(jQuery);
})

