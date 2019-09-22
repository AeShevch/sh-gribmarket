document.addEventListener('DOMContentLoaded', function() {
    class Form {
        constructor() {
            this.btnSubmit = document.querySelector('.js-submit-form');
            this.events();
        }

        events() {
            this.btnSubmit.addEventListener('click', this.submit);
        }

        submit(e) {
            let form = e.target.parentElement.querySelector('form');
            // console.log(form);
            form.submit();
        }
    }


    setTimeout(
        function () {
            let form = new Form();
        },
        100
    );
});
