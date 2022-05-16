<template>
    <section>
        <form>
            <div class="row gtr-50">
                <div class="col-6 col-12-small input-group" v-bind:class="{'error': errors.has('name')}">
                    <input type="text" 
                            v-model="form.name"
                            placeholder="Name"
                    >
                    <validation-error :message="errors.get('name')"></validation-error>
                </div>
                <div class="col-6 col-12-small input-group" v-bind:class="{'error': errors.has('email')}">
                    <input type="email"
                            v-model="form.email"
                            placeholder="Email"
                    >
                    <validation-error :message="errors.get('email')"></validation-error>
                </div>
                <div class="col-12 input-group" v-bind:class="{'error': errors.has('content')}">
                    <textarea v-model="form.content"
                            placeholder="Message"
                            rows="4"
                    ></textarea>
                    <validation-error :message="errors.get('content')"></validation-error>
                </div>
                <vue-recaptcha ref="recaptcha"
                    :sitekey="recaptchaSitekey"
                    size="invisible"
                    @verify="onCaptchaVerify"
                />
                <div class="col-12">
                    <ul class="actions">
                        <li v-if="loading"><button type="button" class="style1 buttonload">
                                <i class="fas fa-circle-notch fa-spin"></i> Loading
                        </button></li>
                        <li v-else><button type="button" class="style1" @click="send">Send</button></li>
                        <li><button type="button" class="style2" @click="reset">Reset</button></li>
                        <li><div v-show="success" class="submit-success">Sent ✓</div></li>
                    </ul>
                </div>
            </div>
        </form>
    </section>
</template>

<script>
    import { VueRecaptcha } from 'vue-recaptcha';

    export default {
        components: { VueRecaptcha },
        data() {
            return {
                loading: false,
                success: false,
                errors: new ValidationError(),
                form: new FormInput({
                    name: '',
                    email: '',
                    content: '',
                    recaptcha: null,
                })
            }
        },
        methods: {
            send() {
                this.loading = true;
                NProgress.start();
                this.$refs.recaptcha.execute();
            },
            reset() {
                this.form.reset();
                this.errors.reset();
                setTimeout(() => this.success = false, 5000)
            },
            onCaptchaVerify(token) {
                this.$refs.recaptcha.reset();
                this.form.recaptcha = token;

                axios.post(route('contact'), this.form.data())
                .then(response => {
                    if (response.data.errors) {
                        this.errors.setErrors(response.data.errors);
                    } else {
                        this.success = true;
                        this.reset();
                    }
                })
                .catch(error => {
                    // console.log('Oops!!!');
                })
                .finally(() => {
                    NProgress.done();
                    this.loading = false;
                })
            },
        },
        computed: {
            recaptchaSitekey: function () {
                return process.env.MIX_RECAPTCHA_SITEKEY;
            }
        }
    }
</script>
