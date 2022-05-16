import { cloneDeep } from "lodash";

export default class {
    constructor (data = {}) {
        this.setInitialValues(data);
        this.setData(data);
    }

    setData(data) {
        Object.assign(this, cloneDeep(data));

        return this;
    }

    setInitialValues(values) {
        this._initial = cloneDeep(values);
    }

    reset() {
        Object.assign(this, cloneDeep(this._initial));
    }

    data() {
        const data = {};

        for (const property in this._initial) {
            data[property] = cloneDeep(this[property]);
        }

        return data;
    }
}
