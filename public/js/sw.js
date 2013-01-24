var SW = SW || {
    path : null,
    init : function (pathIn) {
        SW.path = pathIn;
        SW.icons = {
                'icon-backward' : '&#xe000;',
                'icon-forward' : '&#xe001;',
                'icon-stop' : '&#xe002;',
                'icon-play' : '&#xe003;',
                'icon-pause' : '&#xe004;',
                'icon-first' : '&#xe005;',
                'icon-last' : '&#xe006;',
                'icon-eject' : '&#xe007;',
                'icon-checkmark' : '&#xe008;',
                'icon-checkmark-circle' : '&#xe009;',
                'icon-cancel-circle' : '&#xe00a;',
                'icon-info' : '&#xe00b;',
                'icon-arrow-right' : '&#xe00c;',
                'icon-arrow-left' : '&#xe00d;'
        };
        var els = document.getElementsByTagName('*');
        for (var i = 0; i < els.length; i += 1) {
            var el = els[i];
            var attr = el.getAttribute('data-icon');
            if (attr) {
                SW.addIcon(el, attr);
            }
            var c = el.className;
            c = c.match(/icon-[^\s'"]+/);
            if (c && SW.icons[c[0]]) {
                SW.addIcon(el, SW.icons[c[0]]);
            }
        }
    },
    addIcon: function (el, entity) {
        var html = el.innerHTML;
        el.innerHTML = '<span style="font-family: \'sw-icons\'">' + entity + '</span>' + html;
    },
    projectCycle : function() {
        setInterval(function() {
            var el = $('#projectSidebarSlider .panel:first');
            var elClone = $(el).clone();
            elClone.insertAfter( '#projectSidebarSlider .panel:last' );
            $(el).slideUp('slow', function() {
                $(el).remove();
            });
        }, 2000);
    },
    projectListAccordion : function () {
        $('.pagination a:first').addClass('active');
        $('.hSlide:first').addClass('active');

        $("#projectList").delegate('.pagination a', 'click', function(e){
            e.preventDefault();
            e.stopPropagation();

            var n = parseInt($(this).attr('href').replace('#', '')) - 1;
            var p = $('#accordionHorizontal').find('.hSlide');
            var active = $('.hSlide.active');
            var panel = p[n];

            if (p.length < n || $(panel).is('.active')) {
                return;
            }

            $(active).animate({width: '0px'}, {queue:false, easing:'linear', duration:300, complete: function () { $(active).removeClass('active') }});
            $(panel).animate({width: '625px'}, {queue:false, easing:'linear', duration:300, complete: function () { $(panel).addClass('active') }});
            $('.pagination a').removeClass('active');
            $(this).addClass('active');
        });
    }
};
