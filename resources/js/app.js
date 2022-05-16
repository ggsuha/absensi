/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.ValidationError = require('./models/ValidationError').default;
window.FormInput = require('./models/FormInput').default;

import Vue from "vue";
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';

Vue.use(ZiggyVue, Ziggy);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('validation-error', () => import(/* webpackChunkName: "validation-error" */ './components/ValidationError.vue'));
Vue.component('contact-component', () => import(/* webpackChunkName: "contact-component" */ './components/ContactComponent.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
