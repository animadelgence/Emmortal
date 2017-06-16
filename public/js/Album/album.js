 var colour = [
            "rgb(142, 68, 173)",
            "rgb(243, 156, 18)",
            "rgb(211, 84, 0)",
            "rgb(0, 106, 63)",
            "rgb(41, 128, 185)",
            "rgb(192, 57, 43)",
            "rgb(135, 0, 0)",
            "rgb(39, 174, 96)"
        ];

        $(".free-wall .size320").each(function() {
            var backgroundColor = colour[colour.length * Math.random() << 0];
            var bricks = $(this).find(".brick");
            !bricks.length && (bricks = $(this));
            bricks.css({
                backgroundColor: backgroundColor
            });
        });

        $(function() {
            $(".free-wall").each(function() {
                var wall = new Freewall(this);
                wall.reset({
                    selector: '.size320',
                    cellW: 320,
                    cellH: 320,
                    fixSize: 0,
                    gutterY: 20,
                    gutterX: 20,
                    onResize: function() {
                        wall.fitWidth();
                    }
                })
                wall.fitWidth();
            });
            $(window).trigger("resize");
        });