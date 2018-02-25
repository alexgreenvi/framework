var AjaxForm = {
    init: function () {
        // Переменые
        this.$arElements = $('[data-ajax-form]');
        // .....
        this.load();
    },
    load: function () {
        this.$arElements.each(function () {
            var $this = $(this);
            $this.data('ajaxForm',$this.data('ajax-form'));
            $this.data('ajaxFormUrl',$this.data('ajax-form-url'));
            AjaxForm.ajax($this);
        });
    },
    update: function () {
        this.$arElements.each(function () {
            var $this = $(this);

            var $btn = $this.find('button');
            $this.find('input, textarea, select').each(function() {
                $this.data(this.name,$(this).val());
                $this.data('ajaxFormButton','push');
            });

            // console.log($this.data());
            $btn.on('click', function(e){
                e.preventDefault();
                AjaxForm.onClick($this);
            });
        });
    },
    onClick: function ($this) {
        AjaxForm.update();
        AjaxForm.ajax($this);
    },
    ajax: function ($this) {
        $.ajax({
            url: $this.data('ajaxFormUrl'),
            type: 'post',
            data: $this.data(),
            success: function(result) {
                $('[data-ajax-form='+$this.data('ajaxForm')+']').html(result);
                AjaxForm.update();
            }
        });
    }
};