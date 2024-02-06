<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FormClonePage from "@/Components/FormClonePage.vue";
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";
import { Button } from "@/components/ui/button";

const props = defineProps({
    id: Number,
    url: String,
});
const link_url_editor = computed(() =>
    !props.id ? "" : route("cloned-page.edit", props.id)
);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white p-6 text-gray-900 shadow-sm dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg"
                >
                    <form-clone-page />
                </div>
            </div>
        </div>

        <div class="py-12" v-if="props.id">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white p-6 text-gray-900 shadow-sm dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg"
                >
                    <h3
                        class="mb-4 text-xl font-semibold leading-tight text-gray-800"
                    >
                        Página Clonada
                    </h3>

                    <p class="mb-4">
                        {{ props.url }}
                    </p>

                    <Button as-child>
                        <a href="{{ link_url_editor }}" target="_blank">
                            Editar Página
                        </a>
                    </Button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
