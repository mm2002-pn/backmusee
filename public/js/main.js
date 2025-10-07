+function ($)
{
    "use strict";

    $(function()
    {
        $.fn.removeClassStartingWith = function (filter) {
            $(this).removeClass(function (index, className) {
                return (className.match(new RegExp("\\S*" + filter + "\\S*", 'g')) || []).join(' ')
            });
            return this;
        };

        // ext inputs options
        // webshims.setOptions('forms-ext', {
        //     replaceUI: 'auto',
        //     types: 'number'
        // });
        // webshims.polyfill('forms forms-ext');

        /*--
            serialize form to send data json
        -----------------------------------*/
        $.fn.serializeObject = function()
        {
            var o = {};
            var a = this.serializeArray();

            console.log('have file in form', this.find('[id^="fichier_"]').val());

            $.each(a, function()
            {
                if (o[this.name])
                {
                    if (!o[this.name].push)
                    {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                }
                else
                {
                    o[this.name] = this.value || '';
                }
            });


            if (this.find('[id^="fichier_"]').val())
            {
                var fichier = document.getElementById(this.find('[id^="fichier_"]').attr('id'));
                var fileReader = new FileReader();
                fileReader.onload = function() {
                    o['fichier'] = fileReader.result;
                };
                fileReader.readAsDataURL(fichier.files[0]);
            }
            // o['fichier'] = "successfull";

            return o;
        };


        $.fn.validate = function()
        {
            var prefixeForm = $(this).attr('id').substr(8, $(this).attr('id').length-1);

            var o = {};
            var a = this.serializeArray();
            var is_validate = true;
            $.each(a, function()
            {
                var itemValue = this.name + '_' + prefixeForm;
                var itemId = '#' + itemValue;
                var displayField = $('[for="'+ itemValue +'"]').html() ? $('[for="'+ itemValue +'"]').html() : this.name;

                try
                {
                    $(itemId).removeClass('border-danger');
                    if ($(itemId).hasClass('required') && !this.value)
                    {
                        $(itemId).addClass('border-danger');
                        iziToast.error({
                            title: "Formulaire",
                            message: "Renseignez le champ <span class=\"font-weight-bold text-capitalize\">" + displayField + "</span>",
                            position: 'topRight'
                        });
                        is_validate = false;
                    }
                }
                catch (e)
                {
                    console.log('validate =', e);
                }

                return is_validate;
            });


            if (is_validate)
                $.each(this.find('[id^="fichier_"]'), function () {
                    var itemValue = this.name + '_' + prefixeForm;
                    console.log(itemValue);
                    var itemId = '#' + itemValue;
                    var displayField = $('[for="'+ itemValue +'"]').html() ? $('[for="'+ itemValue +'"]').html() : this.name;
                    $(itemId).removeClass('border-danger');
                    if ($(itemId).hasClass('required') && !this.value)
                    {
                        $(itemId).addClass('border-danger');
                        iziToast.error({
                            title: "Formulaire",
                            message: "Choisir un fichier pour le champ <span class=\"font-weight-bold\">" + displayField + "</span>",
                            position: 'topRight'
                        });
                        is_validate = false;
                    }
                    return is_validate;
                });

            return is_validate;
        };




        /*--
                class
        -----------------------------------*/
        $(document).on('click', '[data-toggle^="class"]', function (e)
        {
            e && e.preventDefault();
            var $this = $(e.target), $class, $target, $tmp, $classes, $targets;
            !$this.data('toggle') && ($this = $this.closest('[data-toggle^="class"]'));
            $class = $this.data()['toggle'];
            $target = $this.data('target') || $this.attr('href');
            $class && ($tmp = $class.split(':')[1]) && ($classes = $tmp.split(','));
            $target && ($targets = $target.split(','));
            $classes && $classes.length && $.each($targets, function (index, value) {

                //$($targets[index]).toggleClass($classes[index]);

                if ($classes[index].indexOf('*') !== -1) {
                    var patt = new RegExp('\\s' +
                        $classes[index].replace(/\*/g, '[A-Za-z0-9-_]+').split(' ').join('\\s|\\s') +
                        '\\s', 'g');
                    $($this).each(function (i, it) {
                        var cn = ' ' + it.className + ' ';
                        while (patt.test(cn)) {
                            cn = cn.replace(patt, ' ');
                        }
                        it.className = $.trim(cn);
                    });
                }
                ($targets[index] != '#') && $($targets[index]).toggleClass($classes[index]) || $this.toggleClass($classes[index]);
            });
            $this.toggleClass('active');
        });

        $(".side-menu").click(function () {
           // alert("hoo")
            $(".side-menu").removeClass("side-menu--active");
            // $(".tab").addClass("active"); // instead of this do the below
            $(this).addClass("side-menu--active");
        });

        /*--
                blockUI
        -----------------------------------*/
        $.fn.blockUI_start = function ()
        {
            $(this).block({
                message: '<i class="fa fa-lg fa-refresh fa-spin" aria-hidden="true"></i> <span>Merci de patientez !</span>' ,
                css: {
                    border: 'none',
                    backgroundColor: 'transparent',
                    color: '#fff',
                    margin: '0 auto',
                    width: '100%'
                },
                overlayCSS:  {
                    backgroundColor:	'#000',
                    opacity:			0.5
                }
            });
        };

        $.fn.blockUI_stop = function ()
        {
            $(this).unblock();
        };


        // Format options
      /*  $('.datedropper').pickadate({
            format: 'dd/mm/yyyy',
            formatSubmit: 'dd/mm/yyyy',
            monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
            monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
            weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
            today: 'aujourd\'hui',
            clear: 'clair',
            close: 'Fermer'
        });

        $('.timedropper').pickatime({
            format: 'H:i A',
            //format: 'h:i A',
            formatSubmit: 'H:i',
            //  formatLabel: undefined,
            //  hiddenPrefix: undefined,
            //  hiddenSuffix: '_submit',
            clear: 'clair',
            close: 'Fermer',
        })*/


    });


}(window.jQuery);
