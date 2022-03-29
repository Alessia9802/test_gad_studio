<template>
    <app-layout title="Agencies">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Aziende
            </h2>
        </template>

        <!-- Flash messages -->
        <div
            v-if="$page.props.flash.message"
            role="alert"
            class="w-full mx-auto lg:w-10/12 bg-green-100 border-l-4 border-green-500 text-green-700 p-4"
        >
            {{ $page.props.flash.message }}
        </div>

        <!-- component -->
        <div class="overflow-x-auto">
            <div
                class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden"
            >
                <div class="w-full lg:w-5/6">
                    <div class="flex flex-row-reverse justify-between">
                        <!-- buttons -->
                        <div class="flex justify-end m-2 p-2">
                            <Link
                                href="/agencies/create"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded"
                                >Create</Link
                            >
                        </div>
                    </div>

                    <div class="bg-white shadow-md rounded my-4">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr
                                    class="bg-slate-800 text-gray-100 uppercase text-sm leading-normal"
                                >
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-left">
                                        Ragione sociale
                                    </th>
                                    <th class="py-3 px-6 text-center">CAP</th>
                                    <th class="py-3 px-6 text-center">Città</th>
                                    <th class="py-3 px-6 text-center">Email</th>
                                    <th class="py-3 px-6 text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                <tr
                                    v-for="agency in agencies.data"
                                    :key="agency.id"
                                    class="border-b border-gray-200 hover:bg-gray-100"
                                >
                                    <td
                                        class="py-3 px-6 text-left whitespace-nowrap"
                                    >
                                        <div class="flex items-center">
                                            <span class="font-medium">{{
                                                agency.id
                                            }}</span>
                                        </div>
                                    </td>
                                    <td
                                        class="py-3 px-6 text-left whitespace-nowrap"
                                    >
                                        <div class="flex items-center">
                                            <span class="font-medium">{{
                                                agency.ragione_sociale
                                            }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div
                                            class="flex items-center justify-center"
                                        >
                                            <span>{{
                                                agency.codice_postale
                                            }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span>{{ agency.città }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span>{{ agency.email }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div
                                            class="flex item-center justify-center"
                                        >
                                            <div
                                                class="w-4 mr-2 transform hover:text-indigo-600 hover:scale-110"
                                            >
                                                <Link
                                                    :href="`/agencies/${agency.id}`"
                                                    class=""
                                                    ><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                        />
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                        />
                                                    </svg>
                                                </Link>
                                            </div>
                                            <div
                                                class="w-4 mr-2 transform hover:text-indigo-600 hover:scale-110"
                                            >
                                                <Link
                                                    :href="`/agencies/${agency.id}/edit`"
                                                    class=""
                                                    ><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                                        /></svg
                                                ></Link>
                                            </div>
                                            <div
                                                class="w-4 mr-2 transform hover:text-indigo-600 hover:scale-110"
                                            >
                                                <button
                                                    class="border-none w-4"
                                                    @click="
                                                        ModalOpen = true;
                                                        selectedAgency = agency;
                                                    "
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                        />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Modal -->
        <Jet-dialog-modal :show="ModalOpen">
            <template #title>
                <h1 class="font-bold">Elimina elemento</h1>
            </template>
            <template v-slot:content>
                <p v-if="selectedAgency">
                    Sicuro di voler l'elemento
                    <strong>"{{ selectedAgency.ragione_sociale }}"</strong>
                    ?
                </p>
                <p>
                    Una volta effettuata l'operazione non puoi tornare indietro.
                </p>
            </template>
            <template v-slot:footer>
                <Danger-button class="mx-2" @click="deleteElement()">
                    Elimina
                </Danger-button>
                <SecondaryButton @click="ModalOpen = false">
                    Annulla
                </SecondaryButton>
            </template>
        </Jet-dialog-modal>
        <!-- Pagination links -->
        <div class="mt-3 pb-6 overflow-x-auto flex items-center justify-center">
            <Pagination :links="agencies.links" />
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import Pagination from "@/Jetstream/Pagination.vue";
import Notification from "@/Jetstream/Notification.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import DangerButton from "@/Jetstream/DangerButton.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        Link,
        Inertia,
        JetSectionBorder,
        Pagination,
        DangerButton,
        JetDialogModal,
        Notification,
        SecondaryButton,
    },
    props: {
        agencies: Object,
    },
    remember: "form",
    data() {
        return {
            form: this.$inertia.form({
                file: "",
            }),
            ModalOpen: false,
            selectedAgency: Object,
        };
    },
    methods: {
        deleteElement: function () {
            /* if (!confirm("Sicuro di voler eliminare questo elemento?")) return; */
            Inertia.delete(
                route("agencies.destroy", { agency: this.selectedAgency })
            );

            this.ModalOpen = false;
        },
        Excel() {
            this.form.post("/agencies");
        },
    },
});
</script>
