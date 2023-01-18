<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import BsDropdown from "@/Components/BsDropdown.vue";
import Check from "@/Components/Check.vue";
import Endpoint from "@/Components/Endpoint.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import { usePage, useForm, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    endpoint: Object,
    sites: Object,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sitio: <span class="font-bold">{{ endpoint.data.url }}</span>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="flex justify-between">
                        <div>
                            <Link
                                :href="`/dashboard/${endpoint.data.site.id}`"
                                class="font-semibold text-lg text-gray-800 leading-tight"
                                >Volver</Link
                            >
                        </div>

                        <div class="mt-4 flex md:mt-0 md:ml-4">
                            <BsDropdown :sites="sites.data" />
                        </div>
                    </div>

                    <div
                        class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 mt-3"
                    >
                        <div
                            class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                        >
                            <div
                                class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                            >
                                <table
                                    class="min-w-full table-fixed divide-y divide-gray-300"
                                >
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="min-w-[12rem] pl-4 py-3.5 px-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Checked at
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Response code
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Response body
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white"
                                    >
                                        <Check
                                            v-for="check in endpoint.data
                                                .checks"
                                            :key="check.id"
                                            :check="check"
                                        />
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
