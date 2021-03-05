class Inset {
    constructor({ data, api, config }) {
        this.data = data;
        this.wrapper = undefined;
        this.api = api;
        this.config = config || {};
    }
    render() {

        var wrapper = document.createElement('div');
        var inputInBlock = document.createElement('textarea');

        wrapper.classList.add('ce-preview');
        wrapper.innerHTML = '';
        inputInBlock.placeholder = 'Анонс публикации';
        inputInBlock.setAttribute('id', 'ce-preview_text');
        inputInBlock.value = this.data && this.data.value ? this.data.value : ''
        wrapper.appendChild(inputInBlock);

        return wrapper;
    }
    save(blockContent) {

        const caption = blockContent.querySelector('textarea'); 

        return {
            value: caption.value
          }
    }
    validate(savedData) {

        var inputAlert;

        if (savedData == '') {
            inputAlert = document.querySelector('.ce-preview textarea');
            inputAlert.classList.add('alert-danger');

            return false;
        }

        inputAlert = document.querySelector('.ce-preview textarea');
        inputAlert.classList.remove('alert-danger');
        return true;
    }
}