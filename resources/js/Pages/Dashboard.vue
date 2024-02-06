<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FormClonePage from "@/Components/FormClonePage.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { Button } from "@/components/ui/button";
import { ref } from "vue";
import { onMounted } from "vue";
import axios from "axios";
import { useToast } from "@/components/ui/toast";
const { toast } = useToast();

const props = defineProps({
    id: Number,
    url: String,
});
const page_id = ref(props.id);
const link_url_editor = computed(() => {
    return page_id.value != null
        ? route("cloned-page.edit", page_id.value)
        : "";
});

async function updatePage(html: string) {
    console.log(html);

    const response = await axios.post(route("cloned-page.updateHtml"), {
        _token: usePage().props.csrf,
        html,
    });

    if (response.status === 200) {
        toast({ title: "Página atualizada" });
    }
}

onMounted(() => {
    const bc = new BroadcastChannel("test_channel");
    bc.onmessage = (event) => {
        updatePage(event.data);
    };
});
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
                    <form-clone-page @cloned="(data) => (page_id = data.id)" />
                </div>

                <div class="mt-4" v-if="page_id">
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
                            <a :href="link_url_editor" target="_blank">
                                Editar Página
                            </a>
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
