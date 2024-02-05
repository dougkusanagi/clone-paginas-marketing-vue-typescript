<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FormClonePage from "@/Components/FormClonePage.vue";
import { Head } from "@inertiajs/vue3";
import { useToast } from "@/components/ui/toast/use-toast";
const { toast } = useToast();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
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
    </AuthenticatedLayout>
</template>
