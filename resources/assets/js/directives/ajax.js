const Vue = require('vue');

export default Vue.directive('ajax', {

    data() {
        return {
            formData: ''
        };
    },

    bind() {
        this.el.addEventListener('submit', this.revealRequest.bind(this));
    },

    update(value) {
        this.formData = value;
    },

    revealRequest(e) {
        e.preventDefault();
        console.log(this.formData);

        this.vm.$http[this.getRequestType()](this.el.action, this.getFormData())
            .then((response) => {
                console.log(response.body);
            }, () => {
                alert('Something went really wrong...');
            });
    },

    getRequestType() {
        let method = this.el.querySelector('input[name="_method"]');

        return (method ? method.value : this.el.method).toLowerCase();
    },

    getFormData() {
        var formData = new FormData();
        let params = this.formData;

        for(let param in params){
            formData.append(param, params[param]);
        }

        return formData;
    }
});
