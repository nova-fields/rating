<template>
    <default-field :field="field">
        <template slot="field">
            <input :id="field.name" type="hidden"
                   class="w-full form-control form-input form-input-bordered"
                   :class="errorClasses"
                   :placeholder="field.name"
                   v-model="value"
            />

            <div>
                <i v-for="n in field.max" style="cursor: pointer">
                    <span @mouseover="mouseover" @mouseleave="mouseleave" @click="click" :data-value="n"
                          v-if="n <= stars">★</span>
                    <span @mouseover="mouseover" @mouseleave="mouseleave" @click="click" :data-value="n" v-else>☆</span>
                </i>
            </div>

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    let $ = require('jquery');

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data() {
            return {
                stars: 0
            }
        },

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || 0;
                this.stars = this.value;
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || '')
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
                this.stars = this.value;
            },

            mouseover(event) {
                let me = $(event.target);
                this.stars = me.data('value');
            },

            mouseleave(event) {
                this.stars = this.value;
            },

            click(event) {
                let me = $(event.target);
                this.handleChange(me.data('value'));
            }
        }
    }
</script>
