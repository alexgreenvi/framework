// var AjaxForm = {
//     init: function () {
//         // Переменые
//         this.$arElements = $('[data-ajax-form]');
//         // .....
//         this.load();
//     },
//     load: function () {
//         this.$arElements.each(function () {
//             var $this = $(this);
//             $this.data('ajaxForm',$this.data('ajax-form'));
//             $this.data('ajaxFormUrl',$this.data('ajax-form-url'));
//             AjaxForm.ajax($this);
//         });
//     },
//     update: function () {
//         this.$arElements.each(function () {
//             var $this = $(this);
//             var $btn = $this.find('button');
//
//             $this.find('input, textarea, select').each(function() {
//                 $this.data(this.name,$(this).val());
//                 $this.data('ajaxFormButton','push');
//             });
//             $btn.on('click', function(e){
//                 e.preventDefault();
//                 AjaxForm.onClick($this);
//             });
//         });
//     },
//     onClick: function ($this) {
//         AjaxForm.update();
//         AjaxForm.ajax($this);
//     },
//     ajax: function ($this) {
//         $.ajax({
//             url: $this.data('ajaxFormUrl'),
//             type: 'post',
//             data: $this.data(),
//             success: function(result) {
//                 $('[data-ajax-form='+$this.data('ajaxForm')+']').html(result);
//                 AjaxForm.update();
//             }
//         });
//     }
// };

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
            AjaxForm.ajax($this);
        });
    },
    update: function () {
        this.$arElements.each(function () {
            var $this = $(this);

            var $btn = $this.find('button');
            $btn.on('click', function(e){
                e.preventDefault();

                // Кнопка отправить
                $this.data('ajaxFormButton',$(this).attr('name'));
                AjaxForm.onClick($this);
            });
        });
    },
    onClick: function ($this) {
        AjaxForm.ajax($this);
    },
    ajax: function ($this) {
        // Создаем экземпляр, тут будем хранить всю информацию для отправки
        var formData = new FormData();
        // Переберам все data переменные
        $.each($this.data(), function(key, value) {
            formData.append(key, value);
        });
        // Присоединяем все файлы
        if($this.find('[type=file]').is('input')){ // Если нашки хоть один
            $.each($('[type=file]'), function(key, file) {
                formData.append($(file).attr('name'), $(file)[0].files[0]);
            });
        }
        // Перебираем все поля
        $this.find('input, textarea, select').each(function() {
            formData.append(this.name, $(this).val());

            if($($this).is('[type=file]')) {
                formData.append(this.name, $(this).attr('value'));
            }
            if($(this).is('[type=checkbox]')){
                formData.append(this.name, $(this).is(':checked'));
            }
        });


        // console.log($(formData));
        $.ajax({
            url: $this.data('ajax-form-url'),
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                $('[data-ajax-form='+$this.data('ajax-form')+']').html(result);
                AjaxForm.update();
            }
        });
    }
};