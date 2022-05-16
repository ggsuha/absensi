export default class {
    constructor () {
        this.errors = {};
    }

    setErrors(data) {
        this.errors = data;
    }

    reset() {
        this.errors = {};
    }

    has(field) {
        return this.errors[field] !== undefined;
    }

    get(field) {
        if (this.has(field)) {
            return this.errors[field][0];
        }
    }
}
