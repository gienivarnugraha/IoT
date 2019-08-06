import Errors from './Error'

/* eslint-disable no-alert */
class Form {
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
        this.originalData = data;
        
        for (let field in data) {
            this[field] = data[field];
        } 

        this.errors = new Errors();
    }


    /**
     * Fetch all relevant data for the form, and passed it to FormData Class, then return the Form Data result
     */
    data() {
        var form = new FormData();

        for (let property in this.originalData) {
            form.append(property, this[property]);
        }
        return form;
    }

    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
        this.reset();
    }


    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     */
    onFail(errors) {
        this.errors.record(errors);
    }
}

export default Form