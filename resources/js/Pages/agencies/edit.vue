<template>
    <app-layout title="Agencies">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit
            </h2>
        </template>
        <div class="overflow-x-auto">
            <div class="w-full lg:w-8/12 mx-auto">
                <validation-errors class="mb-4" />
            </div>
        </div>
        <!-- component -->
        <div class="overflow-x-auto">
            <div
                class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden"
            >
                <div class="w-full lg:w-5/6">
                    <!-- component -->
                    <link
                        rel="stylesheet"
                        href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css"
                    />
                    <link
                        rel="stylesheet"
                        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"
                    />

                    <section>
                        <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
                            <!-- buttons -->
                            <div class="flex mb-2">
                                <Link
                                    href="/agencies"
                                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded"
                                    >Back</Link
                                >
                            </div>
                            <div
                                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
                            >
                                <div class="rounded-t bg-white mb-0 px-6 py-6">
                                    <div
                                        class="text-center flex justify-between"
                                    >
                                        <h6
                                            class="text-blueGray-700 text-xl font-bold"
                                        >
                                            Dati anagrafici
                                        </h6>
                                    </div>
                                </div>
                                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                    <form @submit.prevent="update">
                                        <h6
                                            class="text-blueGray-600 text-sm mt-3 mb-6 font-bold uppercase"
                                        >
                                            Informazioni
                                        </h6>
                                        <div class="flex flex-wrap">
                                            <!-- Ragione sociale -->
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="ragione_sociale"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Ragione sociale
                                                    </label>

                                                    <input
                                                        id="ragione_sociale"
                                                        v-model="
                                                            form.ragione_sociale
                                                        "
                                                        type="text"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Inserisci nome attività"
                                                    />
                                                    <div
                                                        class="text-red-500"
                                                        v-if="
                                                            form.errors
                                                                .ragione_sociale
                                                        "
                                                    >
                                                        {{
                                                            form.errors
                                                                .ragione_sociale
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Email -->
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="email"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Indirizzo Email
                                                    </label>
                                                    <input
                                                        type="email"
                                                        id="email"
                                                        required
                                                        v-model="form.email"
                                                        class="border-0 focus:outline-none focus:shadow-outline px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full transition-all duration-100"
                                                        placeholder="email@example.com"
                                                    />
                                                </div>
                                                <div
                                                    class="text-red-500"
                                                    v-if="form.errors.email"
                                                >
                                                    {{ form.errors.email }}
                                                </div>
                                            </div>
                                        </div>

                                        <hr
                                            class="mt-6 border-b-1 border-blueGray-300"
                                        />
                                        <!-- Seconda sezione -->
                                        <h6
                                            class="text-blueGray-600 text-sm mt-3 mb-6 font-bold uppercase"
                                        >
                                            Contatti
                                        </h6>
                                        <div class="flex flex-wrap">
                                            <!-- Indirizzo -->
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="indirizzo"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Indirizzo
                                                    </label>
                                                    <input
                                                        type="text"
                                                        required
                                                        id="indirizzo"
                                                        v-model="form.indirizzo"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. Via Roma, 2"
                                                    />
                                                    <div
                                                        class="text-red-500"
                                                        v-if="
                                                            form.errors
                                                                .indirizzo
                                                        "
                                                    >
                                                        {{
                                                            form.errors
                                                                .indirizzo
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Provincia -->
                                            <div class="w-full lg:w-6/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="provincia"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Provincia
                                                    </label>
                                                    <input
                                                        type="text"
                                                        required
                                                        id="provincia"
                                                        v-model="form.provincia"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. Milano"
                                                    />
                                                    <div
                                                        class="text-red-500"
                                                        v-if="
                                                            form.errors
                                                                .provincia
                                                        "
                                                    >
                                                        {{
                                                            form.errors
                                                                .provincia
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Città -->
                                            <div class="w-full lg:w-4/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="città"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Città
                                                    </label>
                                                    <input
                                                        type="text"
                                                        required
                                                        id="città"
                                                        v-model="form.città"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. Milano(MI)"
                                                    />
                                                    <div
                                                        class="text-red-500"
                                                        v-if="form.errors.città"
                                                    >
                                                        {{ form.errors.città }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Regione -->
                                            <div class="w-full lg:w-4/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="regione"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        Regione
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="regione"
                                                        v-model="form.regione"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. Lombardia"
                                                    />
                                                    <div
                                                        class="text-red-500"
                                                        v-if="
                                                            form.errors.regione
                                                        "
                                                    >
                                                        {{
                                                            form.errors.regione
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Postal code -->
                                            <div class="w-full lg:w-4/12 px-4">
                                                <div
                                                    class="relative w-full mb-3"
                                                >
                                                    <label
                                                        for="codice_postale"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                        htmlfor="grid-password"
                                                    >
                                                        CAP
                                                    </label>
                                                    <input
                                                        type="text"
                                                        required
                                                        id="codice_postale"
                                                        v-model="
                                                            form.codice_postale
                                                        "
                                                        class="border-0 px-3 py-3 placeholder-blueGray-400 text-blueGray-600 bg-white rounded text-sm shadow w-full ease-linear transition-all"
                                                        placeholder="Es. 20081"
                                                    />
                                                    <div
                                                        class="text-red-500"
                                                        v-if="
                                                            form.errors
                                                                .codice_postale
                                                        "
                                                    >
                                                        {{
                                                            form.errors
                                                                .codice_postale
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button create -->
                                        <div class="flex p-2">
                                            <button
                                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded"
                                                type="submit"
                                                :disabled="form.processing"
                                            >
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Modal from "../../Jetstream/Modal.vue";

export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        Link,
        Modal,
    },
    props: {
        agency: Object,
        errors: Object,
    },
    remember: "form",
    data() {
        return {
            form: this.$inertia.form({
                ragione_sociale: this.agency.ragione_sociale,
                indirizzo: this.agency.indirizzo,
                provincia: this.agency.provincia,
                città: this.agency.città,
                regione: this.agency.regione,
                codice_postale: this.agency.codice_postale,
                email: this.agency.email,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(`/agencies/${this.agency.id}`);
        },
        destroy() {
            if (confirm("Are you sure you want to delete this organization?")) {
                this.$inertia.delete(`/agencies/${this.agency.id}`);
            }
        },
    },
});
</script>
