<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import BsDropdown from "@/Components/BsDropdown.vue";
import Endpoint from "@/Components/Endpoint.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import { usePage, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    site: Object,
    sites: Object,
    endpoints: Object,
});

const page = usePage();
const endpointForm = useForm({
    location: null,
    frequency: page.props.value.endpointFrequencies.data[0].frequency,
});

const storeEndpoint = () => {
    endpointForm.post(`/sites/${props.site.data.id}/endpoints`, {
        preserveScroll: true,
        onSuccess: () => {
            endpointForm.reset();
        },
    });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white px-4 py-2 rounded-md md:flex md:items-center md:justify-between mb-6"
                >
                    <div class="min-w-0 flex-1">
                        <h2
                            class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
                        >
                            {{ site.data.domain }}
                        </h2>
                    </div>
                    <div class="mt-4 flex md:mt-0 md:ml-4">
                        <BsDropdown :sites="sites.data" />
                    </div>
                </div>
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-2"
                >
                    <h2
                        class="font-semibold text-lg text-gray-800 leading-tight"
                    >
                        Nuevo endpoint
                    </h2>

                    <form
                        @submit.prevent="storeEndpoint"
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center p-3 mt-4 space-x-2"
                    >
                        <div class="grow">
                            <InputLabel
                                for="location"
                                value="Location"
                                class="sr-only"
                            />
                            <TextInput
                                id="location"
                                type="text"
                                class="block w-full h-9 text-sm"
                                placeholder="e.j. /dashboard"
                                v-model="endpointForm.location"
                            />
                            <InputError
                                class="mt-2"
                                :message="endpointForm.errors.location"
                            />
                        </div>
                        <div>
                            <InputLabel
                                for="frequency"
                                value="Frecuencia"
                                class="sr-only"
                            />
                            <select
                                name="frequency"
                                id="frequency"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm"
                                v-model="endpointForm.frequency"
                            >
                                <option
                                    :value="frequency.frequency"
                                    v-for="frequency in page.props.value
                                        .endpointFrequencies.data"
                                    :key="frequency.frequency"
                                >
                                    {{ frequency.label }}
                                </option>
                            </select>
                        </div>
                        <PrimaryButton> Agregar </PrimaryButton>
                    </form>
                </div>

                <div class="mt-8 flex flex-col">
                    <h2
                        class="font-semibold text-lg text-gray-800 leading-tight"
                    >
                        Endpoints en monitoreo ({{ endpoints.data.length }})
                    </h2>
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
                                                endpoint
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                frecuencia
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                último barrido
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                estado anterior
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                tiempo de actividad
                                            </th>
                                            <th
                                                scope="col"
                                                class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                            >
                                                <span class="sr-only"
                                                    >Edit</span
                                                >
                                            </th>
                                            <th
                                                scope="col"
                                                class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                            >
                                                <span class="sr-only"
                                                    >Delete</span
                                                >
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white"
                                    >
                                        <Endpoint
                                            v-for="endpoint in endpoints.data"
                                            :key="endpoint.id"
                                            :endpoint="endpoint"
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
