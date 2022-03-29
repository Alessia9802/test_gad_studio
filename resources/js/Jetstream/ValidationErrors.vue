<template>
    <div v-if="hasErrors">
        <div
            class="mt-4 bg-red-500 text-white rounded-t px-4 py-2"
            role="alert"
        >
            <span class="font-bold">Errors!</span> Something went wrong.
        </div>
        <ul
            class="list-none border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700"
        >
            <li v-for="(error, key) in errors" :key="key">
                {{ error }}
            </li>
        </ul>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    computed: {
        errors() {
            return this.$page.props.errors;
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0;
        },
    },
});
</script>
