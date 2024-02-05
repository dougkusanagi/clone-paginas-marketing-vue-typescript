<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
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
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                    <Button
                        @click="
                            () => {
                                toast({
                                    title: 'Scheduled: Catch up',
                                    description:
                                        'Friday, February 10, 2023 at 5:57 PM',
                                });
                            }
                        "
                    >
                        Add to calander
                    </Button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
