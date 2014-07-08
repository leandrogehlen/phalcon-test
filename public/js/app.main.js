//= require jquery.min
//= require jquery.inputmask.min
//= require bootstrap/js/bootstrap.min
//= require bootstrap.datepicker
//= require bootstrap.datepicker.pt-BR
//= require bootstrap.typeahead.min
//= require bootstrap-combobox
//= require icheck/js/icheck.min
//= require adminlte
//= require_self

$(function () {
    $('input,select').addClass('input-sm');

    $('.btn').addClass('btn-sm');
    $('form').attr('autocomplete', 'off');

    $('.pagination').each(function () {
        var pag = $(this);
        var ul = $('<ul class="pagination pagination-sm"></ul>');

        pag.children().each(function () {
            var el = $(this);
            var li = $('<li></li>').appendTo(ul);
            li.append(el);

            if (el.hasClass('currentStep')) {
                li.addClass('active');
            }
        });

        pag.empty();
        pag.append(ul);
    });

    $('.col-act-cnt form a').click(function() {
        if (confirm('Confirma a exclusão deste item?'))
            $(this).parent().submit();
    });

    $('.combobox').combobox();

    var input = $('#main-container').find('input:not([type=hidden]),textarea,select').first();
    if (input.length) {
        input.focus();
    }

    var inputs =  $('input[data-type=date]');
    inputs.inputmask("d/m/y");

    inputs.each(function(){
        var group = $('<div class="input-group date">').appendTo($(this).parent());
        group.append($(this));
        group.append('<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>');
    });

    $('.date').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        todayHighlight: true
    });

    $('input[data-type=int]').inputmask("integer",{rightAlign: false});
    $('input[data-type=fone]').inputmask("(99)9999-99999");

    $('input[data-type=autocomplete]').each(function(){
        var $this = $(this),
            $input = $('<input type="hidden"/>').appendTo($this.parent());

        $input.attr("id", $this.attr('id'));
        $input.attr("name", $this.attr('name'));
        $input.val($this.data("id"));

        $this.removeAttr("name");
        $this.removeAttr("id");
        $this.data("target", $input);

        var display = $this.data("display");
        var remote = $this.data("remote");

        if (remote.indexOf('?') > 0){
            var parts = remote.split("?");
            remote = parts[0] + ".json?" + parts[1] + "&";
        } else {
            remote = remote + ".json?";
        }

        var blood = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace(display),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: remote + "q=%QUERY"
            //prefetch: remote.slice(0,-1)
        });

        blood.initialize();
        $this.typeahead({highlight:true}, {
            displayKey: display,
            source: blood.ttAdapter()
        });

        $this.on('typeahead:autocompleted typeahead:selected', function(event, data) {
            var $target = $(this).data("target");
            if($target.length) {
                $target.val(data.id);
                $(this).data("selected", true);
            }
        });

        $this.on('blur', function(event) {
            var $target = $(event.target),
                value = $target.val(),
                initial = $(this).data("initial");

            if (!value){
                $target.data("target").val(value);
            }
            else if (!$(this).data("selected") && value != initial) {
                $(this).val(initial);
            }
        });

        $this.on('focus', function() {
            $(this).data("initial", $(this).val());
            $(this).data("selected", false);
        });
    });

});
