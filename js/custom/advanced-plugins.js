$(function () {
    "use strict";

    $('#datetimepicker12').datetimepicker({
        inline: true,
        sideBySide: true,
        icons: {
            time: 'zmdi zmdi-time',
            date: 'zmdi zmdi-calendar',
            up: 'zmdi zmdi-chevron-up zmdi-hc-2x',
            down: 'zmdi zmdi-chevron-down zmdi-hc-2x',
            previous: 'zmdi zmdi-chevron-left zmdi-hc-2x',
            next: 'zmdi zmdi-chevron-right zmdi-hc-2x',
            today: 'zmdi zmdi-gps-dot zmdi-hc-2x',
            clear: 'zmdi zmdi-delete zmdi-hc-2x',
            close: 'zmdi zmdi-close zmdi-hc-2x'
        }
    });

    $('#datetimepicker1').datetimepicker({
        icons: {
            time: 'zmdi zmdi-time',
            date: 'zmdi zmdi-calendar',
            up: 'zmdi zmdi-chevron-up zmdi-hc-2x',
            down: 'zmdi zmdi-chevron-down zmdi-hc-2x',
            previous: 'zmdi zmdi-chevron-left zmdi-hc-2x',
            next: 'zmdi zmdi-chevron-right zmdi-hc-2x',
            today: 'zmdi zmdi-gps-dot zmdi-hc-2x',
            clear: 'zmdi zmdi-delete zmdi-hc-2x',
            close: 'zmdi zmdi-close zmdi-hc-2x'
        }
    });

    $('#datetimepicker10').datetimepicker({
        viewMode: 'years',
        format: 'MM/YYYY',
        icons: {
            time: 'zmdi zmdi-time',
            date: 'zmdi zmdi-calendar',
            up: 'zmdi zmdi-chevron-up zmdi-hc-2x',
            down: 'zmdi zmdi-chevron-down zmdi-hc-2x',
            previous: 'zmdi zmdi-chevron-left zmdi-hc-2x',
            next: 'zmdi zmdi-chevron-right zmdi-hc-2x',
            today: 'zmdi zmdi-gps-dot zmdi-hc-2x',
            clear: 'zmdi zmdi-delete zmdi-hc-2x',
            close: 'zmdi zmdi-close zmdi-hc-2x'
        }
    });

    //$('.colorpicker').colorpicker();

    // Colorpicker
    if ($.isFunction($.fn.colorpicker)) {
        $(".colorpicker").each(function (i, el) {
            var $this = $(el);
            var opts = {
                //format: attrDefault($this, 'format', false)
            };
            var $nextEle = $this.next();
            var $prevEle = $this.prev();
            var $colorPreview = $this.siblings('.input-group-addon').find('.icon-color-preview');

            $this.colorpicker(opts);

            if ($nextEle.is('.input-group-addon') && $nextEle.has('span')) {
                $nextEle.on('click', function (ev) {
                    ev.preventDefault();
                    $this.colorpicker('show');
                });
            }

            if ($prevEle.is('.input-group-addon') && $prevEle.has('span')) {
                $prevEle.on('click', function (ev) {
                    ev.preventDefault();
                    $this.colorpicker('show');
                });
            }

            if ($colorPreview.length) {
                $this.on('changeColor', function (ev) {

                    $colorPreview.css('background-color', ev.color.toHex());
                });

                if ($this.val()) {
                    $colorPreview.css('background-color', $this.val());
                }
            }
        });
    }

    $(".select2").select2();
    $(".select2-placeholer").select2({
        allowClear: true
    });

    var dragFixed = document.getElementById('drag-fixed');
    noUiSlider.create(dragFixed, {
        start: [40, 60],
        behaviour: 'drag-fixed',
        connect: true,
        range: {
            'min': 20,
            'max': 80
        }
    });

    var basicSlider = document.getElementById('basic-slider');
    noUiSlider.create(basicSlider, {
        start: 40,
        behaviour: 'tap',
        connect: 'upper',
        range: {
            'min': 20,
            'max': 80
        }
    });

    var rangeSlider = document.getElementById('range-slider');
    noUiSlider.create(rangeSlider, {
        start: [40, 60],
        behaviour: 'drag',
        connect: true,
        range: {
            'min': 20,
            'max': 80
        }
    });
});